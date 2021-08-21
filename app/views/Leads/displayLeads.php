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
            <table class="table table-hover table-borderless table-responsive">
                <thead class="thead-inverse">
                    <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Joined</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tbody>
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr>
                <td><?php echo implode('</td><td>', $row); ?></td>
                <td> <form action="<?php echo URLROOT . '/leads/editLeadContr'?>" method="post">
                        <input type = "hidden" name = "leadsId" value = "<?php echo $row['id']; ?>" />
                        <button type="submit" class="btn btn-outline">Edit</button>
                    </form>
                </td>
                <td> <form action="<?php echo URLROOT . '/leads/deleteLead'?>" method="post">
                        <input type = "hidden" name = "leadsId" value = "<?php echo $row['id']; ?>" />
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
                    </tbody>
            </table>
            </div>
<?php endif; ?>

<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';