<?php


class Stages extends Controller{
    protected $stageModel;

    public function __construct(){
        $this->stageModel = $this->model('Stage');
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
}