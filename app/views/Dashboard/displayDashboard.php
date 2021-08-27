<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
        
<?php else : ?>
    <div class="container-fluid pt-5 mt-4">
        <h1 class="">Dashboard</h1>
        <div class="container-fluid bg-light mt-4 pb-4">
            <h3 class="py-4">Worth of opportinities in all stages</h3>
            <div class="row row-cols-2 row-cols-lg-4 g-4 justify-content-center" id="cards-container">
                <?php foreach ($data1 as $row): $row= (array) $row; array_map('htmlentities', $row); 
                    $sum = 0;
                    foreach ($data as $ops): $ops= (array) $ops; array_map('htmlentities', $ops);
                        if($row['id']==$ops['stage_id']) {
                            $sum += $ops['amount'];
                        }
                    endforeach; ?>
                    <div class="col">
                        <div class="card text-center bg-secondary bg-gradient text-dark border-light">
                            <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name'] ?></h5>
                            <h4 class="card-title">$<?php echo $sum ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="container-sm bg-light mt-4 text-center rounded-2">
            
            <!-- Button trigger modal -->
            <div class="container text-end pt-4"><button type="button" class="btn btn-outline-dark " data-bs-toggle="modal" data-bs-target="#modal1">...</button></div>
            
            <!-- Modal -->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modelTitle1" aria-hidden="true">
                <div class="modal-dialog modal-lg .modal-fullscreen-sm-down" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">Chart Settings</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        <div class="modal-body text-start">
                            <div class="container-fluid">
                            <form id="stackedForm" class="container-sm">
                                    <div class="d-lg-flex justify-content-between">
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
                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">See chart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                      
            <h3 class="mt-lg-n4">Chart by number of opportunities by stages and months </h3>
            <canvas class="my-2" id="chart"></canvas>
        </div>
        <div class="container d-sm-flex mt-4 text-center justify-content-between ps-0">
            <div class="col-sm-6 bg-light rounded-2 mt-2 me-sm-2">
            <div class="container text-end pt-4"><button type="button" class="btn btn-outline-dark " data-bs-toggle="modal" data-bs-target="#modalWon">...</button></div>
            
            <!-- Modal -->
            <div class="modal fade" id="modalWon" tabindex="-1" role="dialog" aria-labelledby="modelTitle1" aria-hidden="true">
                <div class="modal-dialog modal-lg .modal-fullscreen-sm-down" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">Chart Settings</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        <div class="modal-body text-start">
                            <div class="container-fluid">
                            <form id="WonLostForm" class="container-sm">
                                    <div class="d-lg-flex justify-content-between">
                                        <div class="mb-3">
                                        <label for="fromYearWon" class="form-label">From</label>
                                        <input type="month" class="form-control" name="fromYearWon" id="fromYearWon" required>
                                        </div>
                                        <div class="mb-3">
                                        <label for="toYearWon" class="form-label">To</label>
                                        <input type="month" class="form-control" name="toYearWon" id="toYearWon" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="selectedRowWon" class="form-label">Data</label>
                                        <select class="form-control" name="selectedRowWon" id="selectedRowWon">
                                            <option value="close_date" selected>Close date</option>
                                            <option value="date">Add date</option>
                                        </select>
                                    </div>
                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">See chart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <h3 class="mt-mg-n4">Finished opportunities Won/lost</h3>
                <canvas id="chart2"></canvas>
            </div>
            <div class="col-sm-6 bg-light rounded-2 mt-2 ms-sm-2">
            <div class="container text-end pt-4"><button type="button" class="btn btn-outline-dark " data-bs-toggle="modal" data-bs-target="#modalAmmount">...</button></div>
            
            <!-- Modal -->
            <div class="modal fade" id="modalAmmount" tabindex="-1" role="dialog" aria-labelledby="modelTitle1" aria-hidden="true">
                <div class="modal-dialog modal-lg .modal-fullscreen-sm-down" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">Chart Settings</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        <div class="modal-body text-start">
                            <div class="container-fluid">
                            <form id="ammountForm" class="container-sm">
                                    <div class="mb-3">
                                        <label for="isExcepted" class="form-label">Data</label>
                                        <select class="form-control" name="selectedRowWon" id="isExcepted">
                                            <option value="0" selected>Amount</option>
                                            <option value="1">Expected ammount</option>
                                        </select>
                                    </div>
                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">See chart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <h3 class="mt-mg-n4">Ammount of $ in each state</h3>
                <canvas id="chart3"></canvas>
            </div>
        </div>
    </div>
    <div class="container-sm bg-light mt-4 text-center rounded-2">
            
            <!-- Button trigger modal -->
            <div class="container text-end pt-4"><button type="button" class="btn btn-outline-dark " data-bs-toggle="modal" data-bs-target="#modalLeads">...</button></div>
            
            <!-- Modal -->
            <div class="modal fade" id="modalLeads" tabindex="-1" role="dialog" aria-labelledby="modelTitle1" aria-hidden="true">
                <div class="modal-dialog modal-lg .modal-fullscreen-sm-down" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                    <h5 class="modal-title">Chart Settings</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                        <div class="modal-body text-start">
                            <div class="container-fluid">
                            <form id="LeadsForm" class="container-sm">
                                    <div class="d-lg-flex justify-content-between">
                                        <div class="mb-3">
                                        <label for="fromYear" class="form-label">From</label>
                                        <input type="month" class="form-control" name="fromYear" id="fromYearLeads" required>
                                        </div>
                                        <div class="mb-3">
                                        <label for="toYear" class="form-label">To</label>
                                        <input type="month" class="form-control" name="toYear" id="toYearLeads" required>
                                        </div>
                                    </div>
                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">See chart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                      
            <h3 class="mt-lg-n4">Newly added Leads</h3>
            <canvas class="my-2" id="chart4"></canvas>
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
    const chart3= $("#chart3"); 
    const chart4= $("#chart4");

    let chartCanvas1;
    let chartCanvas2;
    let chartCanvas3;
    let chartCanvas4;
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
                backgroundColor: ['#52C41A', '#F5222D'],
                data: [won, lost]
            },
            ]
        }
        const config ={
            type: 'doughnut',
            data: data,
            options: {
                plugins: {
                    title:{
                        display: true,
                        text: `From ${fromYear}-${monthNames[fromMonth-1]} to ${toYear}-${monthNames[toMonth-1]}`
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
        const datasets =[];

        
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
                    text: `From ${fromYear}-${monthNames[fromMonth-1]} to ${toYear}-${monthNames[toMonth-1]}`
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
        return new Chart(chart, config);
    }

    const chartByAmmountInStages = (chart, expected = false) => {
        let labels = [];
        let dataset = [];
        let bg = [];

        //minden stage
        stages.forEach( stage => {
            
            const color='#' + (Math.floor(Math.random()*16777215).toString(16)) ;
            let amount = 0;
            //console.log("\n\n\n" + stage['name'] + " " + stage['id'])  
            ops.forEach(op =>{
                if(op['stage_id'] === stage['id']){ 
                    let am = parseInt(op['amount']);
                    if(expected == 1) am *= op['prob'] == 0 ? 0 : (parseInt(op['prob'])/100);
                    amount += am;
                }
            });

            labels.push(stage['name']);
            bg.push(color);
            dataset.push(amount);
        })

        const data={
            labels : labels,
            datasets : [{
                backgroundColor: bg,
                data: dataset
            },
            ]
        }
        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Doughnut Chart'
                }
                }
            },
        };
        return new Chart(chart, config);
    }

    const chartByAdded = (chart, fromYear = 2021, toYear = 2021, fromMonth = 1, toMonth = 12) => {
        const dataset = [];
        const labels = [];

        for(let i= fromYear; i<=toYear; i++){
            const from= (i===fromYear) ? fromMonth : 1;
            const to = (i===toYear) ? toMonth : 12;
            for(let j=from; j<=to; j++){
                labels.push(`${i}-${monthNames[j-1]}`);
                let num = leads.filter( x => {
                    date= x['join_date'].split('-');
                    return (date[0] == i && date[1] == j);
                }).length;
                console.log(num);
                dataset.push(num);
            }
        }
        
        const data={
            labels : labels,
            datasets : [{
                label: "New Leads",
                backgroundColor: '#722ED1',
                borderColor: '#722ED1',
                data: dataset
            },
            ]
        }
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Doughnut Chart'
                }
                }
            },
        };

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

        }
    })

    $('#WonLostForm').submit( e => {
        e.preventDefault();

        let fromDate = $('#fromYearWon').val().split('-');
        let toDate = $('#toYearWon').val().split('-');
        let row = $('#selectedRowWon').val();

        if(fromDate==="" || toDate==="" || row===""){
            alert("Plese fill in all the data areas!")
        }
        else if((fromDate[0]>toDate[0]) || (fromDate[0]==toDate[0] && fromDate[1]>toDate[1])){
            alert("Please select an earlier date for from date than the to date!");
        }
        else if(fromDate!="" && toDate!="" && row){
            chartCanvas2.destroy();
            chartCanvas2 = chartByWonLost(chart2, fromDate[0], toDate[0], fromDate[1], toDate[1], row);
        }
    })

    $('#ammountForm').submit(e => {
        e.preventDefault();

        let expected = $('#isExcepted').val();

        chartCanvas3.destroy();
        chartCanvas3 = chartByAmmountInStages(chart3, expected);
    })

    $('#LeadsForm').submit(e => {
        e.preventDefault();

        let fromDate = $('#fromYearLeads').val().split('-');
        let toDate = $('#toYearLeads').val().split('-');
        if(fromDate==="" || toDate===""){
            alert("Plese fill in all the data areas!")
        }
        else if((fromDate[0]>toDate[0]) || (fromDate[0]==toDate[0] && fromDate[1]>toDate[1])){
            alert("Please select an earlier date for from date than the to date!");
        }
        else if(fromDate!="" && toDate!=""){
            chartCanvas4.destroy();
            chartCanvas4=chartByAdded(chart4, fromDate[0], toDate[0], fromDate[1], toDate[1]);

        }
    })
    
    //-------initializing dashboard
    chartCanvas1= stackedChartByStages(chart, 2021, 2021);
    chartCanvas2 = chartByWonLost(chart2, 2021, 2021);
    chartCanvas3 = chartByAmmountInStages(chart3);
    chartCanvas4 = chartByAdded(chart4);

    </script>
<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';