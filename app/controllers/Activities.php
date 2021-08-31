<?php

require_once('Opportunitys.php');


class Activities extends Controller{
    protected $activityModel;
    protected $opportunityContr;
    
    public function __construct(){
        $this->activityModel = $this->model('Activity');
        $this->opportunityContr = new Opportunitys();
    }
    
    public function open_activities_contr(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $id = trim($_POST['OpId']);
            
            $data= $this->activityModel->getActivitiesById($id);

            $data1 = $this->opportunityContr->getOpportunityByIdWithLead($id);
           
            $datas= trim($_POST['OpId']);
            
            
           $this->view('Activities/displayOpActivities', $data, $datas, $data1);
        }
    }
    
    public function newActivity(){
        $form = [
            'description' => '',
            'type' => '',
            'deadline' => '',
            'is_done' => '',
            'opport_id' => ''
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $form = [
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'deadline' => trim($_POST['deadline']),
                'is_done' => trim($_POST['is_done']),
                'opport_id' => trim($_POST['opport_id'])
            ];
            
            if(!(empty($form['description']) && empty($form['type']) && empty($form['deadline']) && empty($form['is_done'])  && empty($form['opport_id']))){
                if($this->activityModel->addActivity($form)){
                   //header('location: ' . URLROOT . '/activities/open_activities_contr');
                   header('location: ' . URLROOT . '/opportunitys/displayOpportunities');
                    
                }
            }else{
                $this->displayOpportunities();
            }
        }
    }
    
    
    
    public function deleteActivity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $id=trim($_POST['ActivityId']);
            
            if($this->activityModel->deleteActivity($id)){
                header('location: ' . URLROOT . '/opportunitys/displayOpportunities');
            }
            else{
                $this->displayOpActivities();
            }
        }
    }
    
    public function editActivityContr(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $id = trim($_POST['ActivityId']);
            
            $data= $this->activityModel->getActivitiesById2($id);
            
            $this->view('Activities/editActivities', $data);
        }
    }
    
    public function editActivity(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data=[
                'id' => trim($_POST['ActivityId']),
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'deadline'=>trim($_POST['deadline']),
                'is_done' =>trim($_POST['is_done'])
                
            ];
            
            if($this->activityModel->editActivity($data)){
                header('location: ' . URLROOT . '/opportunitys/displayOpportunities');
               
            }
            
        }
    }
   
}