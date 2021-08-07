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

    public function newLead(){
        $form = [
            'name' => '',
            'email' => '',
            'telephone' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $form = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'telephone' => trim($_POST['telephone'])
            ];

            if(!(empty($form['name']) && empty($form['email']) && empty($form['telephone']))){
                if($this->leadModel->addLead($form)){
                    header('location: ' . URLROOT . '/leads/displayLeads');
                }
            }else{
                $this->displayLeads();
            }
        }
    }
    
    
    public function removeLead(){
        $form = [
            'id' => '' 
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $form = [
              
                'id' => trim($_POST['id'])
            ];
            
            if(!(empty($form['id']))){
                if($this->leadModel->deleteLead($form)){
                    header('location: ' . URLROOT . '/leads/displayLeads');
                }
            }else{
                $this->displayLeads();
            }
            
        }
    }
    
    
    
    
    
    
}