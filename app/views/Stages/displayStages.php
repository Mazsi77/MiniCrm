<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else : ?>
        <div class="container-fluid pt-5">
        <h1 class="mt-4 mb-2">Manage Stages</h1>
        <!-- Button trigger modal -->
        <button type="button" class="my-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#newStage">
          Add New Stage
        </button>
		
        <!-- Modal -->
        <div class="modal fade" id="newStage" tabindex="-1" aria-labelledby="newStageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="newStageLabel">New Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-secondary">
              <div class="container">
                  <form action="<?php echo URLROOT; ?>/Stages/newStage" method="POST"> 
                        <div class="mb-3 row">
                            <label for="stage_name" class="col-sm-1-12 col-form-label">Name of the Stage</label>
                            <div class="col-sm-1-12">
                                <input type="text" class="form-control" name="name" id="stage_name" placeholder="Lead name" required>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="is_completed" type="checkbox" value="true" id="is_completed">
                            <label class="form-check-label" for="is_completed">
                                Is Finished?
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="is_won"  type="checkbox" value="true" id="is_won">
                            <label class="form-check-label" for="is_won">
                                Is won?
                            </label>
                        </div>
                        <div class="mb-3 row">
                          <label for="prob" class="col-sm-1-12 col-form-label">Probability of success</label>
                          <div class="col-sm-1-12">
                              <input type="number" min="0" max="100" class="form-control" name="prob" id="prob" placeholder="Probability" required>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary m-auto d-block col-sm-6">Submit</button>
                  </form>
              </div>
            </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="editStage" tabindex="-1" aria-labelledby="editStageLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="editStageLabel">Edit Stage</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-secondary">
              <div class="container">
                  <form action="<?php echo URLROOT; ?>/stages/editStage" method="POST"> 
                      <input type = "hidden" id="editId" name = "stageId" value = "" />
                      <div class="mb-3 row">
                            <label for="editName" class="col-sm-1-12 col-form-label">Name of the Stage</label>
                            <div class="col-sm-1-12">
                                <input type="text" class="form-control" name="name" id="editName" placeholder="Lead name" required>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="is_completed" type="checkbox" value="true" id="editCompleted">
                            <label class="form-check-label" for="editCompleted">
                                Is Finished?
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="is_won"  type="checkbox" value="true" id="editWon">
                            <label class="form-check-label" for="editWon">
                                Is won?
                            </label>
                        </div>
                        <div class="mb-3 row">
                          <label for="editProb" class="col-sm-1-12 col-form-label">Probability of success</label>
                          <div class="col-sm-1-12">
                              <input type="number" min="0" max="100" class="form-control" name="prob" id="editProb" placeholder="Probability" required>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary m-auto d-block col-sm-6">Submit</button>
                  </form>
              </div>
            </div>
            </div>
        </div>
        </div>
		
		<input type="text" id="myInput" class="form-control form-control mb-1 mt-1" onkeyup="myFunction()" placeholder=" Search...">
		
		
		
		
        <?php if (count($data) > 0): ?>
            <table id="myTable" class="table table-hover table-responsive mt-4 align-middle">
                <thead class="thead-inverse">
                    <tr>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(0)">Name</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(1)">State</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(2)">Default Probability</th>
                    <th></th>
  
                  </tr>
                    </thead>
                    <tbody class="bg-light">
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr onclick="editStage(<?php echo $row['id']; ?>)">
                <td><?php echo $row['name']; ?></td>
                <?php 
                    $text = "";
                    $class= "";
                    if($row['is_finished'] == 1){
                        if($row['is_won'] == 1){
                            $text = "Won";
                            $class = "success";
                        }
                        else{
                            $text = "Lost";
                            $class = "danger";
                        }
                    }
                    else{
                        $text = "In progress";
                        $class = "primary";
                    } ?>
                <td><span class="badge badge-pill bg-<?php echo $class; ?>" ><?php echo $text; ?></span></td>
                <td><?php echo $row['def_prob']; ?>%</td>
                <td>
                <form action="<?php echo URLROOT . '/Stages/deleteStage'?>" method="post">
                        <input type = "hidden" name = "stageId" value = "<?php echo $row['id']; ?>" />
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('If you remove <?php echo $row['name']; ?>, all opportunities which connects to this stage, will be removed.  Are you sure?');">Delete</button>
                    </form>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            
            
            </div>
<?php endif; ?>



            
<script>
  const stages = <?php echo json_encode($data); ?>;

  function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc"; 
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
      //start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /*Loop through all table rows (except the
      first, which contains table headers):*/
      for (i = 1; i < (rows.length - 1); i++) {
        //start by saying there should be no switching:
        shouldSwitch = false;
        /*Get the two elements you want to compare,
        one from current row and one from the next:*/
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /*check if the two rows should switch place,
        based on the direction, asc or desc:*/
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /*If a switch has been marked, make the switch
        and mark that a switch has been done:*/
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        //Each time a switch is done, increase this count by 1:
        switchcount ++;      
      } else {
        /*If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again.*/
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
  }
  function myFunction() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]; 
      td1 = tr[i].getElementsByTagName("td")[2]; 
    td2 = tr[i].getElementsByTagName("td")[3]; 
  /* ADD columns here that you want you to filter to be used on */
      if (td) {
        if ( (td.innerHTML.toUpperCase().indexOf(filter) > -1) || (td1.innerHTML.toUpperCase().indexOf(filter) > -1) || (td2.innerHTML.toUpperCase().indexOf(filter) > -1))  {            
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  } 

  const editStage = id => {
    const stage = stages.find( x => x['id'] == id);
    console.log(stage['is_won']);
    $('#editId').val(stage['id']);
    $('#editName').val(stage['name']);
    $('#editWon').prop("checked", stage['is_won'] == 1);
    $('#editCompleted').prop("checked", stage['is_finished'] == 1);
    $('#editProb').val(stage['def_prob']);

    $('#editStage').modal("show");
  }
</script>


<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';