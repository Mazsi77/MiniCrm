<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
        
<?php else : ?>
    <h1>Dashboard</h1>
    <div class="chart-container" style="position: relative; height:80vh; width:80vw">
        <canvas id="chart"></canvas>
    </div>
    <div class="chart-container" style="position: relative; height:30vh; width:30vw">
        <canvas id="chart2"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const ops = <?php echo json_encode($data); ?>;
    const leads = <?php echo json_encode($datas); ?>;
    const stages = <?php echo json_encode($data1); ?>;

    const chart = $("#chart");
    const chart2= $("#chart2");

    /// chart.js chart making function
    //args: chart= canvas for the chart.js
    const chartByWonLost = (chart) =>{
        const won = ops.filter( op => op['is_finished']==1 && op['is_won']==1).length;
        const lost = ops.filter( op=> op['is_finished']==1 && op['is_won']==0).length;

        const labels= ['Won', 'Lost'];
        const data={
            labels : labels,
            datasets : [{
                backgroundColor: ['green', 'red'],
                data: [won, lost]
            },
            ]
        }
        const config ={
            type: 'pie',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title:{
                        display: true,
                        text: 'Finished opportunities by won or lost'
                    },
                    subtitle: {
                        display: true,
                        text: `Win rate ${won/(lost+ won)*100}%`
                    }

                }
            }
        }
        //making the chart
        var myChart = new Chart(chart, config);
    }

    //args: chart= canvas, fromYear= starting year in yyyy format, toYear= ending year
    const stackedChartByStages = (chart, fromYear, toYear) => {
        const labels = [];
        const datasets = [];
        

        //minden stage
        stages.forEach( stage => {
            let dataset= {
                label: stage['name'],
                backgroundColor: '#' + (Math.floor(Math.random()*16777215).toString(16)),
                data: []
            };
            for(let i= fromYear; i<=toYear; i++){
                for(let j= 1; j<=12; j++){

                let count = ops.filter( op => {
                    //splitting the date string to array of nums
                   let date = op['close_date'].split('-').map(x =>+x);

                   if(date[0]==i && date[1]==j && op['stage_id']== stage['id']){
                        return true;
                   } 
                   return false;
                }).length;
                dataset['data'].push(count);
            }
            }
            datasets.push(dataset);
        });

        for(let i= fromYear; i<=toYear; i++){
            for(let j=1; j<=12; j++){
                labels.push(`${i}-${monthNames[j-1]}`);
            }
        }
        console.log(labels);
        const data={
            labels: labels,
            datasets: datasets
        }

        const config ={
            type: 'bar',
            data: data,
            options: {
                plugins: {
                title: {
                    display: true,
                    text: 'Chart.js Bar Chart - Stacked'
                },
                },
                responsive: true,
                interaction: {
                intersect: false,
                },
                scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true
                }
                }
            }
        }
        console.log(data)
        var myChart = new Chart(chart, config);
    }

    //chart építő függvények meghívása
    stackedChartByStages(chart,2021, 2021);
    chartByWonLost(chart2);
    </script>
<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';