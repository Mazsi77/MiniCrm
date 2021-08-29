<?php
class Pages extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');
    }

    public function index() {
        $data = [
            'title' => 'Home page'
        ];
        if(isset($_SESSION['username'])){
            header('location: ' . URLROOT . '/Opportunitys/displayOpportunities');
        }
        else{
            header('location: ' . URLROOT . '/Users/login');
        }
        
    }

}
