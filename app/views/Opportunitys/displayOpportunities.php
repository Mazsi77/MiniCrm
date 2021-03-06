<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1 class="pt-5">Please Log in first</h1>
        
    <?php else : ?>
        <div class="container-fluid pt-5">
       <h1 class="mt-4 mb-2">Your Opportunities</h1>

       <!-- Button trigger modal -->
        <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOpportunity">
        Add new Opportunity
        </button> -->
        
        <a name="" id="" class="btn btn-outline-primary me-2" href="<?php echo URLROOT . '/Opportunitys/displayOpportunityCards' ?>" role="button">Change View</a>
        <a name="" id="" class="btn btn-outline-success me-2" href="<?php echo URLROOT . '/Stages/displayStages' ?>" role="button">Manage Stages</a>
        <a href="<?php echo URLROOT . '/Opportunitys/addOpportunity' ?>" class="btn btn-primary">Add New Opportunity</a>
        <!-- Modal -->
        <div class="modal fade" id="newOpportunity" tabindex="-1" aria-labelledby="newOpportunityLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOpportunityLabel">New Opportunity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                  <form action="<?php echo URLROOT; ?>/opportunitys/newOpportunity" method="POST"> 
                      <div class="mb-3 row">
                          <label for="lead_id" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="number" class="form-control" name="lead_id" id="lead_id" placeholder="Lead ID">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="stage_id" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="number" class="form-control" name="stage_id" id="stage_id" placeholder="Stage ID">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="name" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                          </div>
                      </div>
                       <div class="mb-3 row">
                          <label for="amount" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="prob" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="number" class="form-control" name="prob" id="prob" placeholder="Probability">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="close_date" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="date" class="form-control" name="close_date" id="close_date" placeholder="Close Date">
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Action</button>
                  </form>
              </div>
            </div>
            </div>
        </div>
        </div>
       
	   <input type="text" id="myInput" class="form-control form-control mb-2 mt-3" onkeyup="myFunction()" placeholder=" Search...">
		
       

        <?php if (count($data) > 0): ?>
            <table id="myTable" class="table table-hover table-responsive mt-4">
                <thead class="thead-inverse">
                    <tr>
                  
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(0)">Opportunity Name</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(1)">Lead Name</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(2)">Stage Name</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(3)">Amount $</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(4)">Probability %</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(5)">Close date</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="bg-light">
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr>
                <td><?php echo $row["opname"]; ?></td>
             	<td><?php echo $row["lead_name"]; ?></td>
                 <?php 
                    $class= "";
                    if($row['is_finished'] == 1){
                        if($row['is_won'] == 1){
                            $class = "success";
                        }
                        else{
                            $class = "danger";
                        }
                    }
                    else{
                        $class = "primary";
                    }
                 
                 ?>
             	<td><span class="badge fs-6 fw-normal badge-pill bg-<?php echo $class ?>" ><?php echo $row["stage_name"]; ?></span></td>
                 
       			<td><?php echo $row["amount"]; ?></td>
				<td><?php echo $row["prob"]; ?></td>
				<td><?php echo $row["close_date"]; ?></td>
				
                <td>
                    <a name="" id="edit<?php echo $row['opid']; ?>" class="btn btn-outline-dark" href="#" onclick="editOpportunity(<?php echo $row['opid']; ?>)" role="button">Edit</a>
                </td>
                <td>
              	  <a name="deleteOp" id="delete<?php echo $row['opid']; ?>" class="btn btn-outline-danger" href="#" onclick="deleteOpportunity(<?php echo $row['opid']; ?>)" role="button">Delete</a>
                </td>
              
               <td> <form action="<?php echo URLROOT . '/activities/open_activities_contr'?>" method="post">
                        <input type = "hidden" name = "OpId" value = "<?php echo $row['opid']; ?>" />
                        <input type = "hidden" name = "OpName" value = "<?php echo $row['opname']; ?>" />
                        <button type="submit" class="btn btn-outline-success">Activities</button>
                    </form>
                </td>
                                
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            </div>
            <form action="<?php echo URLROOT . '/opportunitys/changeStage'?>" method="post" id="stageChange">
                <input type = "hidden" name = "opid" id="sChangeOpId" value = "" >
                <input type = "hidden" name = "stageid" id="sChangeStageId" value = "" >
                <input type = "hidden" name = "url" value = "<?php echo URLROOT . '/opportunitys/displayOpportunities'; ?>" >
            </form>
            <form action="<?php echo URLROOT . '/opportunitys/editOpportunityContr' ?>" method="post" id="updateOp">
                <input type = "hidden" name= "opid" id="updateOpId" value = "" >
                <input type = "hidden" name = "url" value = "<?php echo URLROOT . '/opportunitys/displayOpportunities'; ?>" >
            </form>
            <form action="<?php echo URLROOT . '/opportunitys/deleteOpportunity'?>" method="post" id="deleteOp">
                <input type = "hidden" name = "opportunitysId" id="deleteOpportunityId" value = "" >
                <input type = "hidden" name = "url" value = "<?php echo URLROOT . '/opportunitys/displayOpportunities'; ?>" >
            </form>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>

function sortTable(n) {
	  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	  table = document.getElementById("myTable");
	  switching = true;
	
	  dir = "asc"; 
	 
	  while (switching) {
	   
	    switching = false;
	    rows = table.rows;
	   
	    for (i = 1; i < (rows.length - 1); i++) {
	    
	      shouldSwitch = false;
	   
	      x = rows[i].getElementsByTagName("TD")[n];
	      y = rows[i + 1].getElementsByTagName("TD")[n];
	      var cmpX=isNaN(parseInt(x.innerHTML))?x.innerHTML.toLowerCase():parseInt(x.innerHTML);
          var cmpY=isNaN(parseInt(y.innerHTML))?y.innerHTML.toLowerCase():parseInt(y.innerHTML);
		cmpX=(cmpX=='-')?0:cmpX;
		cmpY=(cmpY=='-')?0:cmpY;
	  
	      if (dir == "asc") {
	    	  if (cmpX > cmpY) {
	                shouldSwitch= true;
	                break;
	            }
	      } else if (dir == "desc") {
	    	  if (cmpX < cmpY) {
	                shouldSwitch= true;
	                break;
	            }
	      }
	    }
	    if (shouldSwitch) {

	      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
	      switching = true;
	      switchcount ++;      
	    } else {
	    
	      if (switchcount == 0 && dir == "asc") {
	        dir = "desc";
	        switching = true;
	      }
	    }
	  }
	}
    function editOpportunity(id){
        $('#updateOpId').val(id);
        $('#updateOp').submit();

    }

    function deleteOpportunity(id){
        $('#deleteOpportunityId').val(id);
        $('#deleteOp').submit();
    }
</script>



<script>
function myFunction() {
var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
     td = tr[i].getElementsByTagName("td")[0]; 
     td1 = tr[i].getElementsByTagName("td")[1]; 
	 td2 = tr[i].getElementsByTagName("td")[2]; 
     td3 = tr[i].getElementsByTagName("td")[3]; 
	 td4 = tr[i].getElementsByTagName("td")[4]; 
     td5 = tr[i].getElementsByTagName("td")[5]; 
/* ADD columns here that you want you to filter to be used on */
    if (td) {
      if ( (td.innerHTML.toUpperCase().indexOf(filter) > -1) || (td1.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1) || (td4.innerHTML.toUpperCase().indexOf(filter) > -1) || (td5.innerHTML.toUpperCase().indexOf(filter) > -1))  {            
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
} 
</script>

<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';