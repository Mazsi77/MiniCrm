<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1 class="pt-5 mt-4">Please Log in first</h1>
        
<?php else : ?>
    <div class="container pt-5 mt-4">
                  <form action="<?php echo URLROOT; ?>/opportunitys/editOpportunity" method="POST">
                    <input type="hidden" name="currentId" value="<?php echo $data1->id; ?>">
                    <input type="hidden" name="url" value= "<?php echo $data2; ?>" >
                    <div class="form-check">
                        <input class="form-check-input" name="new_lead" type="checkbox" value="true" id="new_lead_check">
                        <label class="form-check-label" for="flexCheckDefault">
                            New lead?
                        </label>
                    </div>
                    <div id="new_lead">
                        <div class="mb-3 row">
                            <label for="lead_name" class="col-sm-1-12 col-form-label"></label>
                            <div class="col-sm-1-12">
                                <input type="text" class="form-control" name="lead_name" id="lead_name" placeholder="Lead name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lead_email" class="col-sm-1-12 col-form-label"></label>
                            <div class="col-sm-1-12">
                                <input type="email" class="form-control" name="lead_email" id="lead_email" placeholder="Lead email">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="lead_phone" class="col-sm-1-12 col-form-label"></label>
                            <div class="col-sm-1-12">
                                <input type="tel" class="form-control" name="lead_phone" id="lead_phone" placeholder="Lead telephone">
                            </div>
                        </div>
                    </div>
                    <div id="old_lead">
                        <select class="form-select form-select-lg mb-3" id="lead_select" name='lead_id' aria-label="Lead name" required>
                            <option disabled selected>Please select a lead name</option>
                        </select>
                        <div class="d-flex justify-content-between">
                            <p id='info_telephone'>-</p>
                            <p id='info_email'>-</p>
                        </div>
                    </div>
                    
                      <div class="mb-3 row">
                          <label for="name" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="text" class="form-control" name="name" id="name" value="<?php echo $data1->name; ?>" placeholder="Name">
                          </div>
                      </div>
                       <div class="mb-3 row">
                          <label for="amount" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="number" class="form-control" name="amount" id="amount" value="<?php echo $data1->amount; ?>" placeholder="Amount">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="close_date" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="date" class="form-control" name="close_date" value="<?php echo $data1->close_date; ?>" id="close_date" placeholder="Close Date">
                          </div>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="new_stage" value="true" id="new_stage_check">
                        <label class="form-check-label" for="new_stage_check">
                            New Stage?
                        </label>
                    </div>
                    <div id="new_stage">
                        <div class="mb-3 row">
                            <label for="stage_name" class="col-sm-1-12 col-form-label"></label>
                            <div class="col-sm-1-12">
                                <input type="text" class="form-control" name="stage_name" id="stage_name" placeholder="Lead name">
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="is_completed">
                            <label class="form-check-label" for="is_completed">
                                Is Completed?
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="true" id="is_won">
                            <label class="form-check-label" for="is_won">
                                Is won?
                            </label>
                        </div>
                    </div>
                    <div id="old_stage">
                        <select class="form-select form-select-lg mb-3" id="stage_select" name='stage_id' aria-label="Lead name" required>
                            <option disabled selected>Please select a stage name</option>
                        </select>
                    </div>
                    <div class="mb-3 row">
                          <label for="prob" class="col-sm-1-12 col-form-label"></label>
                          <div class="col-sm-1-12">
                              <input type="number" class="form-control" name="prob" id="prob" placeholder="Probability">
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Action</button>
                  </form>
                  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script>
        const leads = <?php echo json_encode($data); ?>;
        const stages = <?php echo json_encode($datas); ?>;
        const current = <?php echo json_encode($data1); ?>;
        $(document).ready( x => {

            //event listeners            
            $('#new_lead_check').on('click', function() {
                if($(this).is(':checked')) {
                    $('#new_lead').show();
                    $('#old_lead').hide();
                }
                else{
                    $('#new_lead').hide();
                    $('#old_lead').show();
                }
            })

            $('#new_stage_check').on('click', function() {
                if($(this).is(':checked')) {
                    $('#new_stage').show();
                    $('#old_stage').hide();
                }
                else{
                    $('#new_stage').hide();
                    $('#old_stage').show();
                }
            })

            $('#lead_select').change(function(){
                let id=$(this).val();

                let lead=leads.find( x => x['id']== id);

                $('#info_telephone').text(lead['telephone']);
                $('#info_email').text(lead['email']);
            })

            $('#stage_select').change(function(){
                let id=$(this).val();

                let stage=stages.find( x => x['id'] == id);

                $('#prob').val(stage['def_prob']);
            })
            
            //setting up default values

            if($('#new_lead_check').is(':checked')){  
                $('#new_lead').show();
                $('#old_lead').hide(); 
            } 
            else{ 
                $('#new_lead').hide();
                $('#old_lead').show();
            }

            if($('#new_stage_check').is(':checked')){  
                $('#new_stage').show();
                $('#old_stage').hide(); 
            } 
            else{ 
                $('#new_stage').hide();
                $('#old_stage').show();
            }

            $.each(leads, function (i, lead) {
                $('#lead_select').append($('<option>', { 
                    value: lead['id'],
                    text : lead['name'] 
                }));
            });

            $('#lead_select').val(current['lead_id']).change();
            
            $.each(stages, function (i, stage) {
                $('#stage_select').append($('<option>', { 
                    value: stage['id'],
                    text : stage['name'] 
                }));
            });

            $('#stage_select').val(current['stage_id']).change();
            $('#prob').val(current['prob']);

        })
    </script>
<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';