<?php

class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){
        $data =[
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'emailError' => '',
            'usernameError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'emailError' => '',
                'usernameError' => '',
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
            }

            //validate email
            if(empty($data['email'])){
                $data['emailError'] = 'Please enter email';
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['emailError'] = 'Please enter the correct format';
            }elseif($this->userModel->findUserByEmail($data['email'])){
                //check if emai exists.
                    $data['emailError'] = 'Email is already taken.';
                }

            //Validate password on length ad numeric values
            if(empty($data['password'])){
                $data['passwordError'] = 'Please enter a password';
            }elseif (strlen($data['password']<8)){
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

            //Make sure that errors are empty

            if(empty($data['usernameError']) &&  empty($data['emailError']) && empty($data['passwordError'] && empty($data['confirmPasswordError'])))  {
                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if($this->userModel->register($data)){
                    //Redirect tot the login page
                    header('location: ' . URLROOT . '/users/login');
                    
                }else{
                    die('something went wrong');
                }
            }
        }

        $this->view('users/register', $data);
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
                }else{
                    $data['passwordError'] = 'Password or username is incorect.';

                    $this->view('users/login', $data);
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


        $this->view('users/login', $data);
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location: '. URLROOT . '/users/login' );
    }
    public function createUserSession($user){
        $_SESSION['user_id']= $user->id;
        $_SESSION['username']= $user->username;
        $_SESSION['email']= $user->email;
    }
}