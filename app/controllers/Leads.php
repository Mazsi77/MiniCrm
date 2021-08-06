<?php

class Leads extends Controller{
    protected $leadModel;
    public function __construct(){
        $this->leadModel = $this->model('Lead');
    }

    public function displayLeads(){
        $this->view('leads/displayLeads');
    }
}