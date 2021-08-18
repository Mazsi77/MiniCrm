<?php

class Leads extends Controller{
    protected $leadModel;
    
    public function __construct(){
        $this->leadModel = $this->model('Lead');
        
    }

    public function getLeads(){
        $result = $this->leadModel->getLeads();
        return $result;
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

    public function addLead($form){
        if(!(empty($form['name']) && empty($form['email']) && empty($form['telephone']))){
           $id = $this->leadModel->addLeadGetId($form);
           return $id;
        } 
        return -1;     
    }

    public function deleteLead(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id=trim($_POST['leadsId']);

            if($this->leadModel->deleteLead($id)){
                header('location: ' . URLROOT . '/leads/displayLeads');
            }
            else{
                $this->displayLeads();
            }
        }
    }

    public function editLeadContr(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $id = trim($_POST['leadsId']);

            $data= $this->leadModel->getLeadById($id);

            $this->view('leads/editLeads', $data);
        }
    }

    public function editLead(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data=[
                'id' => trim($_POST['leadsId']),
                'name' => trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'telephone' =>trim($_POST['telephone'])
            ];

            if($this->leadModel->editLead($data)){
                header('location: ' . URLROOT . '/leads/displayLeads');
            }
            
        }
    }
}