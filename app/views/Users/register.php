<?php
    require APPROOT . '/views/includes/head.php';
?>


    <?php require APPROOT . '/views/includes/navigation.php';
    ?>



<section class="ftco-section center-section">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10 ">
					<div class="wrap d-md-flex justify-content-center">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last bg-dark bg-gradient text-light">
							<div class="text w-100">
								<h2 class="fs-1">Welcome to register</h2>
								<p class="fs-5">Allready have an account?</p>
								<a href="<?php echo URLROOT?>/users/login" class="btn btn-primary fs-5">Register an account</a>
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="fs-3 mb-4" class="mb-4">Sign In</h3>
			      		</div>
			      	</div>
					<form action="<?php echo URLROOT; ?>/users/register" method="POST" class="signin-form">
                        <div class="form-group mb-3 fs-5">
                            <label class="label" for="name">Username</label>
                            <input type="text" placeholder="UserName *" name="username">
                            <span class="invalidFeedBack">
                                <?php echo $data['usernameError']; ?>
                            </span>  
                        </div>
                        <div class="form-group mb-3 fs-5">
                            <label class="label" for="email">Email</label>
                            <input type="email" placeholder="Email *" name="email">
                            <span class="invalidFeedBack">
                                <?php echo $data['emailError']; ?>
                            </span>  
                        </div>
                        <div class="form-group mb-3 fs-5">
                            <label class="label" for="tel">Telephone</label>
                            <input type="tel" placeholder="Telephone *" name="telephone">
                            <span class="invalidFeedBack">
                                <?php echo $data['telephoneError']; ?>
                            </span> 
                        </div>
                        <div class="form-group mb-3 fs-5">
                            <label class="label" for="date">Date of Birth</label>
                            <input type="date" name="dateofbirth" max="<?php echo date('Y-m-d') ?>">
                            <span class="invalidFeedBack">
                                <?php echo $data['dateError']; ?>
                            </span>
                        </div>
                        <div class="form-group mb-3 fs-5">
                            <label class="label" for="password">Password</label>
                            <input type="password" placeholder="Password *" name="password">
                            <span class="invalidFeedBack">
                                <?php echo $data['passwordError']; ?>
                            </span>
                        </div>
                        <div class="form-group mb-3 fs-5">
                            <label class="label" for="password">Password</label>
                            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
                            <span class="invalidFeedBack">
                                <?php echo $data['confirmPasswordError']; ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit fs-5 px-3">Register</button>
                        </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>
<?php
    require APPROOT . '/views/includes/footer.php';
?>