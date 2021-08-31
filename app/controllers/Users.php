<?php

class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){
        $data =[
            'username' => '',
            'email' => '',
            'telephone' => '',
            'dateofbirth' => '',
            'password' => '',
            'confirmPassword' => '',
            'emailError' => '',
            'usernameError' => '',
            'telephoneError' => '',
            'dateError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'telephone' =>trim($_POST['telephone']),
                'dateofbirth' => trim($_POST['dateofbirth']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'emailError' => '',
                'usernameError' => '',
                'telephoneError' => '',
                'dateError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            $passwordValidation = "/^(.{0,7}| [^a-z]*[^\d]*)$/i";
            //Validate username on letters/numbers
            if(empty($data['username'])){
                $data['usernameError'] = 'Please enter username';
            }elseif (!preg_match($nameValidation, $data['username'])){
                $data['usernameError']= 'Name can only contain letters and numbers.';
            }elseif($this->userModel->findUserByCol('username', $data['username'])){
                $data['usernameError']= 'Username Already taken';
            }

            //validate email
            if(empty($data['email'])){
                $data['emailError'] = 'Please enter email';
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['emailError'] = 'Please enter the correct format';
            }elseif($this->userModel->findUserByCol('email' , $data['email'])){
                //check if emai exists.
                    $data['emailError'] = 'Email is already taken.';
                }

            //Validate password on length ad numeric values
            if(empty($data['password'])){
                $data['passwordError'] = 'Please enter a password';
            }elseif (strlen($data['password'])<8){
                $data['passwordError'] = 'Password must be at least 8 characters';
            }/*elseif (!preg_match($passwordValidation, $data['password'])){
                $data['passwordError'] = 'Password must have at least one numeric value';
            }*/
            if(empty($data['confirmPassword'])){
                $data['confirmPasswordError'] = 'Please enter a password';
            }else{
                if($data['password'] != $data['confirmPassword']){
                    $data['confirmPasswordError'] = 'Passwords do not match';
                }
            }

            //Validate phone number based on number of numeric charracters
            if(empty($data['telephone'])){
                $data['telephoneError'] = 'Please enter a telephone number';
            }else{
                //eliminate every char except 0-9
                $justNums = preg_replace("/[^0-9]/", '', $data['telephone']);

                //eliminate leading 4 if its there
                if (strlen($justNums) == 11) $justNums = preg_replace("/^4/", '',$justNums);

                //if we have 10 digits left, it's probably valid.
                if (strlen($justNums) != 10) {
                    $data['telephoneError'] = 'Please ente a valid telephone number';
                }
            }

            //Check if birth date is empty
            if(empty($data['dateofbirth'])){
                $data['dateError']= 'Please enter your birth date';
            }


            //Make sure that errors are empty

            if(empty($data['usernameError']) &&  empty($data['emailError']) && empty($data['passwordError'] && empty($data['confirmPasswordError']) && empty($data['dateError'] && empty($data['telephoneError']))))  {
                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if($this->userModel->register($data)){
                    //Redirect tot the login page
                    header('location: ' . URLROOT . '/Users/login');
                    
                }else{
                    die('something went wrong');
                }
            }
        }

        $this->view('Users/register', $data);
    }

    public function login(){
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => '',
            ];

            if(empty($data['username'])) {
                $data['usernameError'] = 'Please enter a username.';
            }

            if(empty($data['password'])) {
                $data['passwordError']= 'Please enter a password.';
            }

            if(empty($data['usernameError']) && empty($data['passwordError'])){
                $loggedInUser = $this->userModel->login($data['username'], $data['password']);
                
                if($loggedInUser){
                    $this->createUserSession($loggedInUser);
                    header('location: ' . URLROOT . '/index');
                }else{
                    $data['passwordError'] = 'Password or username is incorect.';

                    $this->view('Users/login', $data);
                }
            }
            
        }else{
            $data = [
                'title' => 'Login page',
                'username' => '',
                'password' => '',
                'usernameError' => '',
                'passwordError' => ''
            ];
    
        }


        $this->view('Users/login', $data);
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['roll']);
        header('location: '. URLROOT . '/users/login' );
    }
    public function createUserSession($user){
        $_SESSION['user_id']= $user->id;
        $_SESSION['username']= $user->username;
        $_SESSION['email']= $user->email;
        $_SESSION['roll'] = $user->type;
    }
}