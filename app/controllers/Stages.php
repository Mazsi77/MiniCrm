<?php


class Stages extends Controller{
    protected $stageModel;

    public function __construct(){
        $this->stageModel = $this->model('Stage');
    }

    public function displayStages(){
        if(!isset($_SESSION['user_id'])){
            $this->view('Stages/displayStages');
        }
        else{
            $data= $this->getStages();

            $this->view('Stages/displayStages', $data);
        }
    }

    public function getStages(){

        if(isset($_SESSION['user_id'])){
            $stages = $this->stageModel->getStages();
            return $stages;
        }
    }
    public function addStage($data){
        return $this->stageModel->addStageGetId($data);
    }

    public function newStage(){
        $form = [
            'name' => '',
            'is_won' => '',
            'is_completed' => '',
            'prob' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $form = [
                'name' => trim($_POST['name']),
                'is_won' => isset($_POST['is_won']) ? 1 : 0,
                'is_completed' => isset($_POST['is_completed']) ? 1 : 0,
                'prob' =>trim($_POST['prob'])
            ];

            if(!empty($form['name']) && $form['name']!=""){
                if($this->stageModel->addStage($form)){
                    header('location: ' . URLROOT . '/Stages/displayStages');
                }
            }else{
                $this->displayStages();
            }
        }
    }
    
    public function deleteStage(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $id=trim($_POST['stageId']);

            if($this->stageModel->deleteStage($id)){
                header('location: ' . URLROOT . '/stages/displayStages');
            }
            else{
                $this->displayStages();
            }
        }
    }

    public function editStage(){
        $form=[
            'id' => "",
            'name' => "",
            'is_won' => "",
            'is_completed' => "",
            'prob' =>""
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $form=[
                'id' => trim($_POST['stageId']),
                'name' => trim($_POST['name']),
                'is_won' => isset($_POST['is_won']) ? 1 : 0,
                'is_completed' => isset($_POST['is_completed']) ? 1 : 0,
                'prob' =>trim($_POST['prob'])
            ];
            if($form['name'] != "" && $form['id']!= ""){
                if($this->stageModel->editStage($form)){
                    header('location: ' . URLROOT . '/Stages/displayStages');
                }
                else{
                    header('location: ' . URLROOT . '/Stages/displayStages');
                }
            }
        }
    }
}