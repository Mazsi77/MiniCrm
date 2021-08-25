<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else : ?>
        <div class="container-fluid">
        <h1 class="my-2">Your Leads</h1>
        <!-- Button trigger modal -->
        <button type="button" class="my-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#newLead">
        Add new lead
        </button>

        <!-- Modal -->
        <div class="modal fade" id="newLead" tabindex="-1" aria-labelledby="newLeadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newLeadLabel">New Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                  <form action="<?php echo URLROOT; ?>/leads/newLead" method="POST"> 
                      <div class="mb-3 row">
                          <label for="name" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="email" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="telephone" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Telephone">
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Action</button>
                  </form>
              </div>
            </div>
            </div>
        </div>
        </div>
        <?php if (count($data) > 0): ?>
            <table id="myTable" class="table table-hover table-responsive">
                <thead class="thead-inverse">
                    <tr>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(0)">Id</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(1)">Name</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(2)">Email</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(3)">Telephone</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(4)">Joined</th>
                    </tr>
                    </thead>
                    <tbody class="bg-light">
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr>
                <td><?php echo implode('</td><td>', $row); ?></td>
                <td> <form action="<?php echo URLROOT . '/leads/editLeadContr'?>" method="post">
                        <input type = "hidden" name = "leadsId" value = "<?php echo $row['id']; ?>" />
                        <button type="submit" class="btn btn-outline-dark">Edit</button>
                    </form>
                </td>
                <td> <form action="<?php echo URLROOT . '/leads/deleteLead'?>" method="post">
                        <input type = "hidden" name = "leadsId" value = "<?php echo $row['id']; ?>" />
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('If you remove <?php echo $row['name']; ?>, all opportunities which connects to him, would be deleted.  Are you sure?');">Delete</button>
                    </form>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            
            
            </div>
<?php endif; ?>



            
<script>
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
</script>


<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';