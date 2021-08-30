<?php
    require APPROOT . '/views/includes/head.php';
?>

<div class="login-main">
	<img class="login-logo" src="<?php echo URLROOT ?>/public/img/logo.png" alt="logo">
	<div class="login-back"></div>
	<div class="login-cont text-white text-center">
		<img src="<?php echo URLROOT ?>/public/img/sapiens1.svg" alt="Illustration">
			<div class="login-form">
			<h1 class="fs-1">Welcome to Register!</h1>
			<p class="fs-4">Please Make an Account!</p>
			<form action="<?php echo URLROOT; ?>/users/register" method="POST" class="signin-form text-start col-12">
                    <div class="form-group mb-3">
                        <label class="label fs-4" for="name">Username</label>
                        <input type="text" name="username" class="form-control fs-4 <?php if($data['usernameError']!= ''){ echo 'is-invalid';} ?>" placeholder="Username" required>
                        <span class="invalid-feedback">
                            <?php echo $data['usernameError']; ?>
                        </span>  
                    </div>
                    <div class="form-group mb-3">
                        <label class="label fs-4" for="name">Date of birth</label>
                        <input type="date" name="dateofbirth" class="form-control fs-4 <?php if($data['dateError']!= ''){ echo 'is-invalid';} ?>" placeholder="Date Of birth" required>
                        <span class="invalid-feedback">
                            <?php echo $data['dateError']; ?>
                        </span>  
                    </div>
				<div class="form-group mb-3 fs-4">
					<label class="label" for="email">Email</label>
					<input type="email" name="email" class="form-control fs-4 <?php if($data['emailError']!= ''){ echo 'is-invalid';} ?>" placeholder="Email" required>
					<span class="invalid-feedback">
						<?php echo $data['emailError']; ?>
					</span>
				</div>
                <div class="form-group mb-3 fs-4">
					<label class="label" for="telephone">Telephone number</label>
					<input type="tel" name="telephone" class="form-control fs-4 <?php if($data['telephoneError']!= ''){ echo 'is-invalid';} ?>" placeholder="Telephone number" required>
					<span class="invalid-feedback">
						<?php echo $data['telephoneError']; ?>
					</span>
				</div>
                <div class="form-group mb-3 fs-4">
					<label class="label" for="password">Password</label>
					<input type="password" name="password" class="form-control fs-4 <?php if($data['passwordError']!= ''){ echo 'is-invalid';} ?>" placeholder="Password" required>
					<span class="invalid-feedback">
						<?php echo $data['passwordError']; ?>
					</span>
				</div>
                <div class="form-group mb-3 fs-4">
					<label class="label" for="confirmPassword">Confirm Password</label>
					<input type="password" name="confirmPassword" class="form-control fs-4 <?php if($data['confirmPasswordError']!= ''){ echo 'is-invalid';} ?>" placeholder="Confirm Password" required>
					<span class="invalid-feedback">
						<?php echo $data['confirmPasswordError']; ?>
					</span>
				</div>
                
				<div class="form-group">
					<button type="submit" class="mt-4 form-control btn login-btn submit fs-4 px-3">Sign In</button>
				</div>
			</form>
			<div class="text w-100">
				<p class="fs-5 pb-0 mb-0 pt-3">Already have an Account?</p>
				<a href="<?php echo URLROOT?>/users/login" class="btn login-switch fs-5 pt-0">Log into it</a>
			</div>	
		</div>
	</div>
</div>

<?php
    require APPROOT . '/views/includes/footer.php';
?>