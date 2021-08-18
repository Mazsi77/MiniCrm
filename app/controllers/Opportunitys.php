<?php
require_once('Stages.php');
require_once('Leads.php');
class Opportunitys extends Controller{
    protected $opportunityModel;
    protected $stageContr;
    protected $leadContr;
    public function __construct(){
        $this->opportunityModel = $this->model('Opportunity');
        $this->stageContr = new Stages();
        $this->leadContr = new Leads();
    }

    public function displayOpportunities(){
        //only display opportunities if signed in
        if(!isset($_SESSION['user_id'])){
            $this->view('opportunitys/displayOpportunities');
        }
        else{
            $data= $this->opportunityModel->getOpportunitiesWithDependecy();

            $this->view('opportunitys/displayOpportunities', $data);
        }
    }
    
    public function displayOpportunityCards(){
        if(!isset($_SESSION['user_id'])){
            $this->view('opportunitys/displayOpportunityCards');
        }
        else{
            $ops= $this->opportunityModel->getOpportunities();

            $stages= $this->stageContr->getStages();

            $this->view('opportunitys/displayOpportunityCards', $stages, $ops);
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
    
    public function addOpportunity(){
        $form = [
            'lead_id' => '',
            'stage_id' => '',
            'probability' => '',
            'name' => '',
            'amount' => '',
            'close_date' => '',
            'lead_id_error' => '',
            'lead_name_error' => '',
            'stage_id_error' => '',
            'stage_name_error' => '',
            'probability_error' => '',
            'op_name_error' => '',
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $form = [
            'lead_id' => '',
            'stage_id' => '',
            'prob' => '',
            'name' => trim($_POST['name']),
            'amount' => trim($_POST['amount']),
            'close_date' => trim($_POST['close_date']),
            'lead_id_error' => '',
            'lead_name_error' => '',
            'stage_id_error' => '',
            'stage_name_error' => '',
            'probability_error' => '',
            'op_name_error' => '',
            ];
        
            if(isset($_POST['new_lead'])){
                $lead = [
                    'name' => trim($_POST['lead_name']),
                    'telephone' => trim($_POST['lead_phone']),
                    'email' =>trim($_POST['lead_email'])
                ];

                $form['lead_id']= $this->leadContr->addLead($lead);
            }
            else{
                $form['lead_id'] = trim($_POST['lead_id']);
            }

            if(isset($_POST['new_stage'])){
                $stage = [
                    'name' => trim($_POST['stage_name']),
                    'prob' => trim($_POST['prob']),
                    'is_won' => isset($_POST['is_won'])? 1:0,
                    'is_completed' => isset($_POST['is_completed']) ? 1 : 0
                ];

                $form['stage_id']= $this->stageContr->addStage($stage);
                $form['prob']= $stage['prob'];
            }
            else{
                $form['stage_id'] = trim($_POST['stage_id']);
                $form['prob'] = trim($_POST['prob']);
            }
            
            if(!(empty($form['lead_id']) && empty($form['stage_id']) && empty($form['name']) && empty($form['amount']) && empty($form['prob']) && empty($form['close_date']))){
                if($this->opportunityModel->addOpportunity($form)){
                    header('location: ' . URLROOT . '/Opportunitys/displayOpportunities');
                }
            }else{
                $this->displayOpportunities();
            }
        }

        $leads = $this->leadContr->getLeads();
        $stages= $this->stageContr->getStages();

        $this->view('/opportunitys/addOpportunities', $leads, $stages);
    }
    public function deleteOpportunity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $opid=trim($_POST['opportunitysId']);
            $url=trim($_POST['url']);
            
            if($this->opportunityModel->deleteOpportunity($opid)){
                header('location: ' . $url);
            }
            else{
                $this->displayOpportunities();
            }
        }
    }
     
}