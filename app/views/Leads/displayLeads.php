<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else : ?>
        <h2> You are logged in </h2>
        <?php endif;
?>


<?php require APPROOT . '/views/includes/footer.php';