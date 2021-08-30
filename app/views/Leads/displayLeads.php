<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else : ?>
        <div class="container-fluid pt-5">
        <h1 class="mt-4 mb-2">Your Leads</h1>
        <!-- Button trigger modal -->
        <button type="button" class="my-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#newLead">
          Add new lead
        </button>
		
        <!-- Modal -->
        <div class="modal fade" id="newLead" tabindex="-1" aria-labelledby="newLeadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="newLeadLabel">New Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-secondary">
              <div class="container">
                  <form action="<?php echo URLROOT; ?>/leads/newLead" method="POST"> 
                      <div class="mb-3 row">
                          <label for="name" class="col-sm-12 col-form-label ">Name of the Lead</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="email" class="col-sm-12 col-form-label">Email</label>
                          <div class="col-sm-12">
                              <input type="email" class="form-control border" name="email" id="email" placeholder="Email">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="telephone" class="col-sm-12 col-form-label">Telephone</label>
                          <div class="col-sm-12">
                              <input type="tel" class="form-control border" name="telephone" id="telephone" placeholder="Telephone">
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary m-auto d-block col-sm-6">Submit</button>
                  </form>
              </div>
            </div>
            </div>
        </div>
        </div>
        <div class="modal fade" id="editLead" tabindex="-1" aria-labelledby="editLeadLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="editLeadLabel">New Lead</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-secondary">
              <div class="container">
                  <form action="<?php echo URLROOT; ?>/leads/editLead" method="POST"> 
                      <input type = "hidden" id="editId" name = "leadsId" value = "<?php echo $row['id']; ?>" />
                      <div class="mb-3 row">
                          <label for="editName" class="col-sm-12 col-form-label ">Name of the Lead</label>
                          <div class="col-sm-12">
                              <input type="text" class="form-control" name="name" id="editName" placeholder="Name">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="editEmail" class="col-sm-12 col-form-label">Email</label>
                          <div class="col-sm-12">
                              <input type="email" class="form-control border" name="email" id="editEmail" placeholder="Email">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="editTelephone" class="col-sm-12 col-form-label">Telephone</label>
                          <div class="col-sm-12">
                              <input type="tel" class="form-control border" name="telephone" id="editTelephone" placeholder="Telephone">
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
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(1)">Email</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(2)">Telephone</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#F5F5FB'" style="cursor: pointer;" onclick="sortTable(3)">Added</th>
                    <th></th>
                    <th></th>  
                  </tr>
                    </thead>
                    <tbody class="bg-light">
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr onclick="editLead(<?php echo $row['id']; ?>)">
                <td><?php echo implode('</td><td>',array_filter($row, function($k) {
                      return $k != 'id';
                    }, ARRAY_FILTER_USE_KEY)); ?></td>
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
  const leads = <?php echo json_encode($data); ?>;

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
      td3 = tr[i].getElementsByTagName("td")[4]; 
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

  const editLead = id => {
    const lead = leads.find( x => x['id'] == id);

    $('#editId').val(lead['id']);
    $('#editName').val(lead['name']);
    $('#editEmail').val(lead['email']);
    $('#editTelephone').val(lead['telephone']);

    $('#editLead').modal("show");
  }
</script>


<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';