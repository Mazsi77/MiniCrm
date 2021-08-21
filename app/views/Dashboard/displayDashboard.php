<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
        
<?php else : ?>
    <div class="container-fluid">
        <h1>Dashboard</h1>
        <div class="container">
            <form id="stackedForm">
                <h2>Chart settings</h2>
                <div class="d-md-flex justify-content-between">
                    <div class="mb-3">
                    <label for="fromYear" class="form-label">From</label>
                    <input type="month" class="form-control" name="fromYear" id="fromYear" required>
                    </div>
                    <div class="mb-3">
                    <label for="toYear" class="form-label">To</label>
                    <input type="month" class="form-control" name="toYear" id="toYear" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="selectedRow" class="form-label">Data</label>
                    <select class="form-control" name="selectedRow" id="selectedRow">
                        <option value="close_date" selected>Close date</option>
                        <option value="date">Add date</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="selectedStyle" class="form-label">Chart style</label>
                    <select class="form-control" name="selectedStyle" id="selectedStyle">
                        <option value="bar" selected>Stacked bars</option>
                        <option value="line">Lines</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">See chart</button>
            </form>
        </div>
        <div class="chart-container col-xxl-8">
            <canvas id="chart"></canvas>
        </div>
        <div class="chart-container col-xxl-4">
            <canvas id="chart2"></canvas>
        </div>
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

    let chartCanvas1;
    let chartCanvas2;
    /// chart.js chart making function
    //args: chart= canvas for the chart.js
    const chartByWonLost = (chart, fromYear, toYear, fromMonth = 1, toMonth = 12, row = "close_date") =>{
        
        const filter = (op, isWon = 1) => {
            if(op['is_finished']==0 || op['is_won']!=isWon) return false;

            let date = op[row].split('-');
            console.log(date[0]>=fromYear && date[0]<=toYear && !(date[0]==fromYear && date[1]<fromMonth) && !(date[0]==toYear && date[1]>toMonth))
            
            return (date[0]>=fromYear && date[0]<=toYear && !(date[0]==fromYear && date[1]<fromMonth) && !(date[0]==toYear && date[1]>toMonth))
        }

        const won = ops.filter( op => filter(op, 1)).length;
        const lost = ops.filter( op=> filter(op, 0)).length;

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
       return new Chart(chart, config);
    }

    //args: chart= canvas, fromYear= starting year in yyyy format, toYear= ending year from month= 1 - 12 row= string-> name of the row (eg: close_date or date), style= line or bar
    const stackedChartByStages = (chart, fromYear, toYear, fromMonth = 1, toMonth = 12, row = 'close_date', style = 'bar') => {
        const labels = [];
        const datasets = [];
        
        //minden stage
        stages.forEach( stage => {
            
            const color='#' + (Math.floor(Math.random()*16777215).toString(16))

            let dataset= {
                label: stage['name'],
                backgroundColor: color,
                borderColor: color,
                data: []
            };
            for(let i = fromYear; i<=toYear; i++){
                const from= (i===fromYear) ? fromMonth : 1;
                const to = (i===toYear) ? toMonth : 12;
                for(let j= from; j<= to; j++){
                let count = ops.filter( op => {
                    //splitting the date string to array of nums
                   let date = op[row].split('-').map(x =>+x);

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
            const from= (i===fromYear) ? fromMonth : 1;
                const to = (i===toYear) ? toMonth : 12;
            for(let j=from; j<=to; j++){
                labels.push(`${i}-${monthNames[j-1]}`);
            }
        }
        console.log(labels);
        const data={
            labels: labels,
            datasets: datasets
        }

        const config ={
            type: style,
            data: data,
            options: {
                plugins: {
                title: {
                    display: true,
                    text: `Chart by number of opportunities by stages and months from ${fromYear} to ${toYear}`
                },
                },
                responsive: true,
                interaction: {
                intersect: false,
                },
                scales: {
                x: {
                    stacked: style==="bar",
                },
                y: {
                    stacked: style=="bar"
                }
                }
            }
        }
        console.log(data)
        return new Chart(chart, config);
    }


    //------Jquery functions

    $('#stackedForm').submit( e => {
        e.preventDefault();

        let fromDate = $('#fromYear').val().split('-');
        let toDate = $('#toYear').val().split('-');
        let row = $('#selectedRow').val();
        let style = $('#selectedStyle').val();
        if(fromDate==="" || toDate==="" || row==="" || style===""){
            alert("Plese fill in all the data areas!")
        }
        else if((fromDate[0]>toDate[0]) || (fromDate[0]==toDate[0] && fromDate[1]>toDate[1])){
            alert("Please select an earlier date for from date than the to date!");
        }
        else if(fromDate!="" && toDate!="" && row && style){
            chartCanvas1.destroy();
            chartCanvas1=stackedChartByStages(chart, fromDate[0], toDate[0], fromDate[1], toDate[1], row, style);

            chartCanvas2.destroy();
            chartCanvas2=chartByWonLost(chart2, fromDate[0], toDate[0], fromDate[1], toDate[1], row);
        }
    })


    //-------initializing dashboard
    chartCanvas1= stackedChartByStages(chart, 2021, 2021);
    chartCanvas2 = chartByWonLost(chart2, 2021, 2021);


    </script>
<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';