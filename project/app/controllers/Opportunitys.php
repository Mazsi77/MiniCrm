<?php

class Opportunitys extends Controller{
    protected $opportunityModel;
    public function __construct(){
        $this->opportunityModel = $this->model('Opportunity');
    }

    public function displayOpportunities(){
        //only display opportunities if signed in
        if(!isset($_SESSION['user_id'])){
            $this->view('opportunitys/displayOpportunities');
        }
        else{
            $data= $this->opportunityModel->getOpportunities();

            $this->view('opportunitys/displayOpportunities', $data);
        }
    }
    
    
    public function newOpportunity(){
        $form = [
            'lead_id' => '',
            'stage_id' => '',
            'name' => '',
            'amount' => '',
            'prob' => '',
            'close_date' => ''
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $form = [
                'lead_id' => trim($_POST['lead_id']),
                'stage_id' => trim($_POST['stage_id']),
                'name' => trim($_POST['name']),
                'amount' => trim($_POST['amount']),
                'prob' => trim($_POST['prob']),
                'close_date' => trim($_POST['close_date'])
            ];
            
            if(!(empty($form['lead_id']) && empty($form['stage_id']) && empty($form['name']) && empty($form['amount']) && empty($form['prob']) && empty($form['close_date']))){
                if($this->opportunityModel->addOpportunity($form)){
                    header('location: ' . URLROOT . '/Opportunitys/displayOpportunities');
                }
            }else{
                $this->displayOpportunities();
            }
        }
    }
    
    
    
}