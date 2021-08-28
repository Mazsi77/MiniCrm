<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else :
        if(!isset($data)) : ?>
            <h1>Something went wrong! </h1>
    <?php else :  ?>
        <div class="container pt-5 mt-4">
            <form action="<?php echo URLROOT; ?>/activities/editActivity" method="POST"> 
                <input type = "hidden" name = "ActivityId" value = "<?php echo $data->id; ?>" />
                <div class="mb-3 row">
                    <label for="description" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $data->description ?>" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="type" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="type" id="type" placeholder="Type" value="<?php echo $data->type ?>" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="deadline" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="datetime-local" class="form-control" name="deadline" id="deadline" placeholder="Deadline" value="<?php echo $data->deadline ?>" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="is_done" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="number" class="form-control" name="is_done" id="is_done" placeholder="Is Done" value="<?php echo $data->is_done ?>" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Lead</button>
                <a name="" id="" class="btn btn-secondary" href="<?php echo URLROOT . '/opportunitys/displayOpportunities' ?>" role="button">Cancel</a>
            </form>
        </div>
    <?php 
    endif;
endif;
require APPROOT . '/views/includes/footer.php';