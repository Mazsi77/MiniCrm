<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
        
    <?php else : ?>
    <div class="container-fluid">
        <h1>Your Opportunities</h1>
        <a name="" id="" class="btn btn-light" href="<?php echo URLROOT . '/Opportunitys/displayOpportunities' ?>" role="button">Change View</a>
        <a href="<?php echo URLROOT . '/Opportunitys/addOpportunity' ?>" class="btn btn-primary">Add New Opportunity</a>
            <div class="row">
        <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>

            <div class="col-xl-3">
                <h2><?php echo $row['name']; ?></h2>
                <?php foreach ($datas as $ops): $ops= (array) $ops; array_map('htmlentities', $ops); 
                    if($row['id']==$ops['stage_id']) :
                ?>
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $ops['opname']; ?></h4>
                        <div class="d-flex justify-content-between">
                            <p class="card-text">$<?php echo $ops['amount']; ?></p>
                            <p class="card-text"><?php echo $ops['prob']; ?>%</p>
                        </div>
                        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                        <p class="card-text text-muted">Lead Info:</p>
                        <h5 class=card-text"><?php echo $ops['lead_name']==''? '-' :$ops['lead_name']; ?></h4>
                            <p class="card-text"><?php echo $ops['telephone']; ?></p>
                            <p class="card-text"><?php echo $ops['email']; ?></p>
                        <form action="<?php echo URLROOT . '/opportunitys/deleteOpportunity'?>" method="post">
                            <input type = "hidden" name = "opportunitysId" value = "<?php echo $ops['opid']; ?>" >
                            <input type = "hidden" name = "url" value = "<?php echo URLROOT . '/opportunitys/displayOpportunityCards'; ?>" >
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <p>Due: <?php echo $ops['close_date'] ?></p>
                    </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        <?php endforeach; endif; ?>
        </div>
    </div>
<?php 
    require APPROOT . '/views/includes/footer.php';