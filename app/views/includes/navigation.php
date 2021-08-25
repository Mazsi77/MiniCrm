<nav class="col-12 navbar navbar-expand-lg navbar-light bg-white sticky-top">
  <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>/index">
      <img src="<?php echo URLROOT ?>/public/img/logo.png" alt="Logo" height="24">    
    </a>
      <button class="navbar-toggler hidden-lg-up" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
          aria-expanded="false" aria-label="Toggle navigation">Menu</button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav me-auto mt-2 mt-lg-0" width="100%">
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URLROOT; ?>/leads/displayLeads">Leads </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URLROOT; ?>/opportunitys/displayOpportunities">Opportunities</a>
          </li>
          <?php if(isset($_SESSION['roll'])) :
              if($_SESSION['roll']=='Manager') :
            ?>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo URLROOT; ?>/dashboard/displayDashboard">Dashboard</a>
          </li>
          <?php endif; endif; ?>
          <li class="nav-item ms-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
                  <a class="btn btn-primary" href="<?php echo URLROOT; ?>/users/logout" >Logout</a>
              <?php else : ?>
                  <a class="btn btn-primary" href="<?php echo URLROOT; ?>/users/login" >Log in</a>
              <?php endif; ?>
              </li>
        </ul>
      </div>
    </div>
</nav>
