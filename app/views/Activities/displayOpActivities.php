<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1 class="pt-5">Please Log in first</h1>
        
    <?php else : ?>
        <div class="container-fluid pt-5">
        
       <h1 class="mt-4 mb-2"><?php echo $data1; ?></h1>
        
       <h4 class="mt-4 mb-2">The activities in the selected opportunity:</h4>
 
 		
 
       
       <!-- Button trigger modal -->
        <button type="button" class="my-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#newLead">
          Add new activity
        </button>
		
        <!-- Modal -->
        <div class="modal fade" id="newLead" tabindex="-1" aria-labelledby="newActivityLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newActivityLabel">New Activity</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                  <form action="<?php echo URLROOT; ?>/activities/newActivity" method="POST"> 
                      <div class="mb-3 row">
                          <label for="name" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="email" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="text" class="form-control" name="type" id="type" placeholder="Type">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="telephone" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="datetime-local" class="form-control" name="deadline" id="deadline" placeholder="Deadline">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="telephone" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="number" class="form-control" name="is_done" id="is_done" placeholder="Done"  min="0" max="1">
                          </div>
                      </div>
                      
                   
          				    <input type="hidden" class="form-control" name="opport_id" id="opport_id" value="<?php echo $datas; ?>">
                                    
          			
                      
                      <button type="submit" class="btn btn-primary">Action</button>
                  </form>
              </div>
            </div>
            </div>
        </div>
        </div>
		
      
      
       
	   <input type="text" id="myInput" class="form-control form-control mb-2 mt-3" onkeyup="myFunction()" placeholder=" Search...">
		
       

       
            <table id="myTable" class="table table-hover table-responsive mt-4">
                <thead class="thead-inverse">
                    <tr>
                  
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(0)">Description</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(1)">Type</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(2)">Deadline</th>
                        <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(3)">Done</th>
                    
                    </tr>
                </thead>
                <tbody class="bg-light">
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr>
                
             	<td><?php echo $row["description"]; ?></td>
             	<td><?php echo $row["type"]; ?></td>
             	<td><?php echo $row["deadline"]; ?></td>
             	<td><?php echo $row["is_done"]; ?></td>
             	
             	<td> <form action="<?php echo URLROOT . '/activities/deleteActivity'?>" method="post">
                        <input type = "hidden" name = "ActivityId" value = "<?php echo $row['id']; ?>" />
                        <button type="submit" class="btn btn-outline-danger" >Delete</button>
                    </form>
                </td>
       		           
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            </div>
        

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

/* ADD columns here that you want you to filter to be used on */
    if (td) {
      if ( (td.innerHTML.toUpperCase().indexOf(filter) > -1) || (td1.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1) || (td3.innerHTML.toUpperCase().indexOf(filter) > -1))  {            
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