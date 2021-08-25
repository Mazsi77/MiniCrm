<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1 class="mt-4 mb-2">Please Log in first</h1>
        
    <?php else : ?>
    <div class="container-fluid pt-5">
        <h1 class="mt-4 mb-2">Your Opportunities</h1>
        <a name="" id="" class="btn btn-outline-primary me-2" href="<?php echo URLROOT . '/Opportunitys/displayOpportunities' ?>" role="button">Change View</a>
        <a href="<?php echo URLROOT . '/Opportunitys/addOpportunity' ?>" class="btn btn-primary">Add New Opportunity</a>
            <div class="overflow-y ">
        <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?>

            <div class="col-xl-4 col-sm-10" id="div<?php echo $row['id'] ?>" ondrop="drop(event)" ondragover="allowDrop(event)">
                <h2 class="m-4"><?php echo $row['name']; ?></h2>
                <?php foreach ($datas as $ops): $ops= (array) $ops; array_map('htmlentities', $ops); 
                    if($row['id']==$ops['stage_id']) :
                ?>
                    <div class="card m-4" id="drag<?php echo $ops['opid'] ?>" draggable="true" ondragstart="drag(event)" ondrop="" ondragover="">
                    <div class="card-body">
                        <h4 class="card-title m-0"><?php echo $ops['opname']; ?></h4>
                        <div class="d-flex justify-content-between">
                            <p class="card-text mb-1">$<?php echo $ops['amount']; ?></p>
                            <p class="card-text mb-1"><?php echo $ops['prob']; ?>%</p>
                        </div>
                        <!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                        <p class="card-text text-muted m-0">Lead Info:</p>
                        <h5 class="card-text mt-0"><?php echo $ops['lead_name']==''? '-' :$ops['lead_name']; ?></h4>
                        <div class="d-flex justify-content-between">
                            <p class="card-text mb-0"><?php echo $ops['telephone']; ?></p>
                            <p class="card-text mb-0"><?php echo $ops['email']; ?></p>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <a name="" id="edit<?php echo $ops['opid']; ?>" class="btn btn-outline-dark" href="#" onclick="editOpportunity(<?php echo $ops['opid']; ?>)" role="button">Edit</a>
                            <a name="deleteOp" id="delete<?php echo $ops['opid']; ?>" class="btn btn-outline-danger" href="#" onclick="deleteOpportunity(<?php echo $ops['opid']; ?>)" role="button">Delete</a>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <p class="mb-0">Due: <?php echo $ops['close_date'] ?></p>
                    </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        <?php endforeach; endif; ?>
        </div>
        <form action="<?php echo URLROOT . '/opportunitys/changeStage'?>" method="post" id="stageChange">
            <input type = "hidden" name = "opid" id="sChangeOpId" value = "" >
            <input type = "hidden" name = "stageid" id="sChangeStageId" value = "" >
            <input type = "hidden" name = "url" value = "<?php echo URLROOT . '/opportunitys/displayOpportunityCards'; ?>" >
        </form>
        <form action="<?php echo URLROOT . '/opportunitys/editOpportunityContr' ?>" method="post" id="updateOp">
            <input type = "hidden" name= "opid" id="updateOpId" value = "" >
            <input type = "hidden" name = "url" value = "<?php echo URLROOT . '/opportunitys/displayOpportunityCards'; ?>" >
        </form>
        <form action="<?php echo URLROOT . '/opportunitys/deleteOpportunity'?>" method="post" id="deleteOp">
            <input type = "hidden" name = "opportunitysId" id="deleteOpportunityId" value = "" >
            <input type = "hidden" name = "url" value = "<?php echo URLROOT . '/opportunitys/displayOpportunityCards'; ?>" >
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script>
        
            function allowDrop(ev) {
                ev.preventDefault();
            }

            function drag(ev) {
                ev.dataTransfer.setData("text", ev.target.id);
            }

            function drop(ev) {
                ev.preventDefault();
                var data = ev.dataTransfer.getData("text");
                var stage = ev.target.closest(`[id^=div]`);
                stage.appendChild(document.getElementById(data));
                makeRequest(stage, data);
            }

            function makeRequest(stage, op){
                const opId= op.replace("drag", '');
                const stageId = $(stage).attr('id').replace('div', '');
                
                $('#sChangeOpId').val(opId);
                $('#sChangeStageId').val(stageId);

                $('#stageChange').submit();
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
<?php 
    require APPROOT . '/views/includes/footer.php';