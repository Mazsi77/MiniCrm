<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else :
        if(!isset($data)) : ?>
            <h1>Something went wrong! </h1>
    <?php else :  ?>
        <div class="container">
            <form action="<?php echo URLROOT; ?>/leads/editLead" method="POST"> 
                <input type = "hidden" name = "leadsId" value = "<?php echo $data->id; ?>" />
                <div class="mb-3 row">
                    <label for="name" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $data->name ?>" >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $data->email ?>" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="telephone" class="col-sm-1-12 col-form-label"></label>
                    <div class="col-sm-1-12">
                        <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="Telephone" value="<?php echo $data->telephone ?>" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Edit Lead</button>
                <a name="" id="" class="btn btn-secondary" href="<?php echo URLROOT . '/leads/displayLeads' ?>" role="button">Cancel</a>
            </form>
        </div>
    <?php 
    endif;
endif;
require APPROOT . '/views/includes/footer.php';