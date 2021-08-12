<?php

class Dashboards extends Controller{
    protected $dashboardModel;
    public function __construct(){
        $this->dashboardModel = $this->model('Dashboard');
    }

    public function displayDashboards(){
        //only display leads if signed in
        if(!isset($_SESSION['user_id'])){
            $this->view('dashboards/displayDashboards');
        }
        else{
            $data= $this->dashboardModel->getSumAmount();
			$datas= $this->dashboardModel->getAvgProb();
			$data1= $this->dashboardModel->getCountWon();
			$data2= $this->dashboardModel->getCountLost();
			$data3= $this->dashboardModel->getCountProspecting();
			$data4= $this->dashboardModel->getCountNegotiation();
			$data5= $this->dashboardModel->getCountFinished();
			$data6= $this->dashboardModel->getCountNotFinished();

			$this->view('dashboards/displayDashboards', $data, $datas, $data1, $data2, $data3, $data4, $data5, $data6);
        }
    }

  
}