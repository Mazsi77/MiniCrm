<?php

class Leads extends Controller{
    protected $leadModel;
    public function __construct(){
        $this->leadModel = $this->model('Lead');
    }

    public function displayLeads(){
        //only display leads if signed in
        if(!isset($_SESSION['user_id'])){
            $this->view('leads/displayLeads');
        }
        else{
            $data= $this->leadModel->getLeads();

            $this->view('leads/displayLeads', $data);
        }
    }
}