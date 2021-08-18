<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
        
    <?php else : ?>
 
       <h1>Your Opportunities</h1>

       <!-- Button trigger modal -->
        <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newOpportunity">
        Add new Opportunity
        </button> -->
        <a href="<?php echo URLROOT . '/Opportunitys/addOpportunity' ?>" class="btn btn-primary">Add New Opportunity</a>
        <a name="" id="" class="btn btn-light" href="<?php echo URLROOT . '/Opportunitys/displayOpportunityCards' ?>" role="button">Change View</a>
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
       
       

        <?php if (count($data) > 0): ?>
            <table class="table table-hovrt table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                  
                 	<th>Opportunity Name</th>
                    <th>Lead Name</th>
                    <th>Stage Name</th>
                    <th>Finished</th>
                    <th>Won</th>             
                    <th>Amount</th>
                    <th>Probability</th>
                    <th>Close date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tbody>
            <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr>
                <td><?php echo $row["opname"]; ?></td>
             	<td><?php echo $row["lead_name"]; ?></td>
             	<td><?php echo $row["stage_name"]; ?></td>
             	<td><?php echo $row["is_finished"]; ?></td>
             	<td><?php echo $row["is_won"]; ?></td>
       			<td><?php echo $row["amount"]; ?></td>
				<td><?php echo $row["prob"]; ?></td>
				<td><?php echo $row["close_date"]; ?></td>
				<td><?php echo $row["opid"]; ?></td>
                                
                <td> <form action="<?php echo URLROOT . '/opportunitys/deleteOpportunity'?>" method="post">
                        <input type = "hidden" name = "opportunitysId" value = "<?php echo $row['opid']; ?>" />
                        <input type="hidden" name="url" value="<?php echo URLROOT . '/opportunitys/displayOpportunities' ?>">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
                                
                </tr>
            <?php endforeach; ?>
            </tbody>
                    </tbody>
            </table>
            
       
<?php endif; ?>

<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';