
<?php

    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
		
		
    <?php else : ?>
        <h1>Dashboard</h1>
        
        <br><br>
		
		
				
				

<canvas id="myChart" style="width:100%;max-width:600px; height:200px;"></canvas>
 
 <?php foreach ($janWon as $JanWon): $JanWon= (array) $JanWon; array_map('htmlentities', $JanWon); ?> 
 <?php foreach ($janLost as $JanLost): $JanLost= (array) $JanLost; array_map('htmlentities', $JanLost); ?>
 <?php foreach ($janPros as $JanPros): $JanPros= (array) $JanPros; array_map('htmlentities', $JanPros); ?>
 <?php foreach ($janNeg as $JanNeg): $JanNeg= (array) $JanNeg; array_map('htmlentities', $JanNeg); ?>	
 <?php foreach ($febWon as $FebWon): $FebWon= (array) $FebWon; array_map('htmlentities', $FebWon); ?> 
 <?php foreach ($febLost as $FebLost): $FebLost= (array) $FebLost; array_map('htmlentities', $FebLost); ?>
 <?php foreach ($febPros as $FebPros): $FebPros= (array) $FebPros; array_map('htmlentities', $FebPros); ?>
 <?php foreach ($febNeg as $FebNeg): $FebNeg= (array) $FebNeg; array_map('htmlentities', $FebNeg); ?>	
 <?php foreach ($marWon as $MarWon): $MarWon= (array) $MarWon; array_map('htmlentities', $MarWon); ?> 
 <?php foreach ($marLost as $MarLost): $MarLost= (array) $MarLost; array_map('htmlentities', $MarLost); ?>
 <?php foreach ($marPros as $MarPros): $MarPros= (array) $MarPros; array_map('htmlentities', $MarPros); ?>
 <?php foreach ($marNeg as $MarNeg): $MarNeg= (array) $MarNeg; array_map('htmlentities', $MarNeg); ?>	
 <?php foreach ($aprWon as $AprWon): $AprWon= (array) $AprWon; array_map('htmlentities', $AprWon); ?> 
 <?php foreach ($aprLost as $AprLost): $AprLost= (array) $AprLost; array_map('htmlentities', $AprLost); ?>
 <?php foreach ($aprPros as $AprPros): $AprPros= (array) $AprPros; array_map('htmlentities', $AprPros); ?>
 <?php foreach ($aprNeg as $AprNeg): $AprNeg= (array) $AprNeg; array_map('htmlentities', $AprNeg); ?>	
 <?php foreach ($mayWon as $MayWon): $MayWon= (array) $MayWon; array_map('htmlentities', $MayWon); ?> 
 <?php foreach ($mayLost as $MayLost): $MayLost= (array) $MayLost; array_map('htmlentities', $MayLost); ?>
 <?php foreach ($mayPros as $MayPros): $MayPros= (array) $MayPros; array_map('htmlentities', $MayPros); ?>
 <?php foreach ($mayNeg as $MayNeg): $MayNeg= (array) $MayNeg; array_map('htmlentities', $MayNeg); ?>	
 <?php foreach ($junWon as $JunWon): $JunWon= (array) $JunWon; array_map('htmlentities', $JunWon); ?> 
 <?php foreach ($junLost as $JunLost): $JunLost= (array) $JunLost; array_map('htmlentities', $JunLost); ?>
 <?php foreach ($junPros as $JunPros): $JunPros= (array) $JunPros; array_map('htmlentities', $JunPros); ?>
 <?php foreach ($junNeg as $JunNeg): $JunNeg= (array) $JunNeg; array_map('htmlentities', $JunNeg); ?>	
 <?php foreach ($julWon as $JulWon): $JulWon= (array) $JulWon; array_map('htmlentities', $JulWon); ?> 
 <?php foreach ($julLost as $JulLost): $JulLost= (array) $JulLost; array_map('htmlentities', $JulLost); ?>
 <?php foreach ($julPros as $JulPros): $JulPros= (array) $JulPros; array_map('htmlentities', $JulPros); ?>
 <?php foreach ($julNeg as $JulNeg): $JulNeg= (array) $JulNeg; array_map('htmlentities', $JulNeg); ?>	
 <?php foreach ($augWon as $AugWon): $AugWon= (array) $AugWon; array_map('htmlentities', $AugWon); ?> 
 <?php foreach ($augLost as $AugLost): $AugLost= (array) $AugLost; array_map('htmlentities', $AugLost); ?>
 <?php foreach ($augPros as $AugPros): $AugPros= (array) $AugPros; array_map('htmlentities', $AugPros); ?>
 <?php foreach ($augNeg as $AugNeg): $AugNeg= (array) $AugNeg; array_map('htmlentities', $AugNeg); ?>	
 <?php foreach ($sepWon as $SepWon): $SepWon= (array) $SepWon; array_map('htmlentities', $SepWon); ?> 
 <?php foreach ($sepLost as $SepLost): $SepLost= (array) $SepLost; array_map('htmlentities', $SepLost); ?>
 <?php foreach ($sepPros as $SepPros): $SepPros= (array) $SepPros; array_map('htmlentities', $SepPros); ?>
 <?php foreach ($sepNeg as $SepNeg): $SepNeg= (array) $SepNeg; array_map('htmlentities', $SepNeg); ?>	
				
			
			
			
<script>
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
		
   type: 'bar',
  data: {
  labels: ["January","February","March","April","May","June","July","August","September","October","November","December"],
  datasets: [
    {
      label: 'Won',
      data: [<?php echo $JanWon["COUNT(opportunities.id)"]; ?>,<?php echo $FebWon["COUNT(opportunities.id)"]; ?>,<?php echo $MarWon["COUNT(opportunities.id)"]; ?>,<?php echo $AprWon["COUNT(opportunities.id)"]; ?>,<?php echo $MayWon["COUNT(opportunities.id)"]; ?>,<?php echo $JunWon["COUNT(opportunities.id)"]; ?>,<?php echo $JulWon["COUNT(opportunities.id)"]; ?>,<?php echo $AugWon["COUNT(opportunities.id)"]; ?>,<?php echo $SepWon["COUNT(opportunities.id)"]; ?>],
      backgroundColor: "green",
    },
    {
        label: 'Lost',
        data: [<?php echo $JanLost["COUNT(opportunities.id)"]; ?>,<?php echo $FebLost["COUNT(opportunities.id)"]; ?>,<?php echo $MarLost["COUNT(opportunities.id)"]; ?>,<?php echo $AprLost["COUNT(opportunities.id)"]; ?>,<?php echo $MayLost["COUNT(opportunities.id)"]; ?>,<?php echo $JunLost["COUNT(opportunities.id)"]; ?>,<?php echo $JulLost["COUNT(opportunities.id)"]; ?>,<?php echo $AugLost["COUNT(opportunities.id)"]; ?>,<?php echo $SepLost["COUNT(opportunities.id)"]; ?>],
        backgroundColor: "#e30505",
      },
  	{
        label: 'Prospecting',
        data: [<?php echo $JanPros["COUNT(opportunities.id)"]; ?>,<?php echo $FebPros["COUNT(opportunities.id)"]; ?>,<?php echo $MarPros["COUNT(opportunities.id)"]; ?>,<?php echo $AprPros["COUNT(opportunities.id)"]; ?>,<?php echo $MayPros["COUNT(opportunities.id)"]; ?>,<?php echo $JunPros["COUNT(opportunities.id)"]; ?>,<?php echo $JulPros["COUNT(opportunities.id)"]; ?>,<?php echo $AugPros["COUNT(opportunities.id)"]; ?>,<?php echo $SepPros["COUNT(opportunities.id)"]; ?>],
        backgroundColor: "#e3d005",
      },
      {
        label: 'Negotiation',
        data: [<?php echo $JanNeg["COUNT(opportunities.id)"]; ?>,<?php echo $FebNeg["COUNT(opportunities.id)"]; ?>,<?php echo $MarNeg["COUNT(opportunities.id)"]; ?>,<?php echo $AprNeg["COUNT(opportunities.id)"]; ?>,<?php echo $MayNeg["COUNT(opportunities.id)"]; ?>,<?php echo $JunNeg["COUNT(opportunities.id)"]; ?>,<?php echo $JulNeg["COUNT(opportunities.id)"]; ?>,<?php echo $AugPros["COUNT(opportunities.id)"]; ?>,<?php echo $SepPros["COUNT(opportunities.id)"]; ?>],
        backgroundColor: "#2b5797",
      },
   
  ]
},
  options: {
    plugins: {
      title: {
        display: true,
        text: 'Opportunities'
      },
    },
    responsive: true,
    scales: {
      x: {
        stacked: true,
      },
      y: {
        stacked: true
      }
    }
  }
  
  
  
  
});


</script>

   

<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>





		
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
		
       
       
	 
	 <br><br><br><br><br>
	 
	 
	 <canvas id="myChart2" style="width:100%;max-width:500px; height:500px;"></canvas>
	 	 
	
            <?php foreach ($data5 as $row5): $row5= (array) $row5; array_map('htmlentities', $row5); ?>
			 <?php foreach ($data6 as $row6): $row6= (array) $row6; array_map('htmlentities', $row6); ?>
	 			
	 
	 <script>
var xValues = ["Finished", "Not finished"];
var yValues = [<?php echo $row5["COUNT(opportunities.id)"]; ?>, <?php echo $row6["COUNT(opportunities.id)"]; ?>, 0,];
var barColors = ["green", "red"];

new Chart("myChart2", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Finished opportunities"
    }
  }
});
</script>
	 
	 
	 
	  <?php endforeach; ?>
	<?php endforeach; ?>
>
	

	   
	   
	   <br><br><br><br><br>
	   
	   <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
       
       <?php if (count($data) > 0): ?>	  
            <?php foreach ($data1 as $row1): $row1= (array) $row1; array_map('htmlentities', $row1); ?>
			 <?php foreach ($data2 as $row2): $row2= (array) $row2; array_map('htmlentities', $row2); ?>
			  <?php foreach ($data3 as $row3): $row3= (array) $row3; array_map('htmlentities', $row3); ?>
			   <?php foreach ($data4 as $row4): $row4= (array) $row4; array_map('htmlentities', $row4); ?>
		
		
		
	<script>
var xValues = ["Won", "Lost", "Prospecting", "Negotiation"];
var yValues = [<?php echo $row1["COUNT(opportunities.id)"]; ?>, 
			   <?php echo $row2["COUNT(opportunities.id)"]; ?>,
			   <?php echo $row3["COUNT(opportunities.id)"]; ?>,
			   <?php echo  $row4["COUNT(opportunities.id)"]; ?>];
			   
var barColors = [
  "green",
  "#e30505",
  "#e3d005",
  "#2b5797",
  
  
];

new Chart("myChart1", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "All Opportunities by stages"
    }
  }
});
</script>	
		 
			   <?php endforeach; ?>
			  <?php endforeach; ?>
			 <?php endforeach; ?>
			<?php endforeach; ?>
  			
		<?php endif; ?>
	   
	   
	   
	   
	   
        <?php if (count($data) > 0): ?>	  
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
			
			   <br><br><br><br>
               <h3>The Sum of all amounts:</h3>
               
                 <h2><?php echo "$ " . $row["SUM(amount)"]; ?></h2>
				
            <?php endforeach; ?>
                        
		<?php endif; ?>
		
		
        <?php if (count($datas) > 0): ?>	  
            <?php foreach ($datas as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
			
			   <br><br><br><br>
               <h3>The Average of probabilities:</h3>
               
                <h2><?php echo $row["AVG(prob)"] . " %"; ?></h2>
				
            <?php endforeach; ?>
                        
		<?php endif; ?>
			
				
		
        





<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';