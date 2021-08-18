<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
        
<?php else : ?>

<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';