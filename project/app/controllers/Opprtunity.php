<?php

class Opprtunity extends Controller{
    protected $opportunityModel;
    public function __construct(){
        $this->$opportunityModel = $this->model('Opprtunity');
    }

    public function displayOpportunities(){
        //only display opportunities if signed in
        if(!isset($_SESSION['user_id'])){
            $this->view('opprtunity/displayOpportunities');
        }
        else{
            $data= $this->$opportunityModel->getOpportunities();

            $this->view('opprtunity/displayOpportunities', $data);
        }
    }
}