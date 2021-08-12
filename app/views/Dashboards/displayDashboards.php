
<?php

    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
		
		
    <?php else : ?>
        <h1>Dashboard</h1>
        
        <br><br>
       
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
      text: "Opportunities by stages"
    }
  }
});
</script>	
		 
			   <?php endforeach; ?>
			  <?php endforeach; ?>
			 <?php endforeach; ?>
			<?php endforeach; ?>
  			
		<?php endif; ?>
	 
	 <br><br><br><br><br>
	 
	 
	 <canvas id="myChart2" style="width:100%;max-width:500px; height:500px;"></canvas>
	 	 
	  <?php if (count($data) > 0): ?>	  
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