<nav class="col-12 navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand" href="<?php echo URLROOT; ?>/index">MiniCRM</a>
    <button class="navbar-toggler hidden-lg-up" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">Menu</button>
    <div class="collapse navbar-collapse bg-light" id="collapsibleNavId">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0">
        <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT; ?>/leads/displayLeads">Leads </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT; ?>/pages/tasks">Opportunities</a>
        </li>
        <?php if(isset($_SESSION['roll'])) :
            if($_SESSION['roll']=='Manager') :
          ?>
        <li class="nav-item ">
          <a class="nav-link" href="<?php echo URLROOT; ?>/pages/dashboard">Dashboard</a>
        </li>
        <?php endif; endif; ?>
        <li class="nav-item ">
        <?php if(isset($_SESSION['user_id'])) : ?>
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout" >Logout</a>
            <?php else : ?>
                <a class="nav-link" href="<?php echo URLROOT; ?>/users/login" >Log in</a>
            <?php endif; ?>
        </li>
        
      </ul>
    </div>
</nav>
