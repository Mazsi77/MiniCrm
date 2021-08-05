<?php
    require APPROOT . '/views/includes/head.php';
?>


    <?php require APPROOT . '/views/includes/navigation.php';
    ?>


<div class="container-login">
    <div class="wrapper-login">
        <h2>Register</h2>

        <form action="<?php echo URLROOT; ?>/users/register" method="POST">
            <input type="text" placeholder="UserName *" name="username">
            <span class="invalidFeedBack">
                <?php echo $data['usernameError']; ?>
            </span>
            <input type="email" placeholder="Email *" name="email">
            <span class="invalidFeedBack">
                <?php echo $data['emailError']; ?>
            </span>
            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedBack">
                <?php echo $data['passwordError']; ?>
            </span>
            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            <span class="invalidFeedBack">
                <?php echo $data['confirmPasswordError']; ?>
            </span>

            <button type="submit" id="submit" value="submit">
                Submit
            </button>

            <p class="options">Allready have an account? <a href="<?php echo URLROOT?>/users/login">Login into it</a></p>
    </form>
    </div>
</div>
<?php
    require APPROOT . '/views/includes/footer.php';
?>