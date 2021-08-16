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
			$janWon= $this->dashboardModel->getjanWon();
		    $janLost= $this->dashboardModel->getjanLost();
			$janPros= $this->dashboardModel->getjanPros();
			$janNeg= $this->dashboardModel->getjanNeg();
			$febWon= $this->dashboardModel->getfebWon();
			$febLost= $this->dashboardModel->getfebLost();
			$febPros= $this->dashboardModel->getfebPros();
			$febNeg= $this->dashboardModel->getfebNeg();
			$marWon= $this->dashboardModel->getmarWon();
			$marLost= $this->dashboardModel->getmarLost();
			$marPros= $this->dashboardModel->getmarPros();
			$marNeg= $this->dashboardModel->getmarNeg();
			$aprWon= $this->dashboardModel->getaprWon();
			$aprLost= $this->dashboardModel->getaprLost();
			$aprPros= $this->dashboardModel->getaprPros();
			$aprNeg= $this->dashboardModel->getaprNeg();
			$mayWon= $this->dashboardModel->getmayWon();
			$mayLost= $this->dashboardModel->getmayLost();
			$mayPros= $this->dashboardModel->getmayPros();
			$mayNeg= $this->dashboardModel->getmayNeg();
			$junWon= $this->dashboardModel->getjunWon();
			$junLost= $this->dashboardModel->getjunLost();
			$junPros= $this->dashboardModel->getjunPros();
			$junNeg= $this->dashboardModel->getjunNeg();
			$julWon= $this->dashboardModel->getjulWon();
			$julLost= $this->dashboardModel->getjulLost();
			$julPros= $this->dashboardModel->getjulPros();
			$julNeg= $this->dashboardModel->getjulNeg();
			$augWon= $this->dashboardModel->getaugWon();
			$augLost= $this->dashboardModel->getaugLost();
			$augPros= $this->dashboardModel->getaugPros();
			$augNeg= $this->dashboardModel->getaugNeg();
			$sepWon= $this->dashboardModel->getsepWon();
			$sepLost= $this->dashboardModel->getsepLost();
			$sepPros= $this->dashboardModel->getsepPros();
			$sepNeg= $this->dashboardModel->getsepNeg();
			
					
			
			$this->view('dashboards/displayDashboards', $data, $datas, $data1, $data2, $data3, $data4, $data5, $data6, $janWon, $janLost, $janPros, $janNeg,$febWon, $febLost, $febPros, $febNeg,$marWon, $marLost, $marPros, $marNeg,$aprWon, $aprLost, $aprPros, $aprNeg,$mayWon, $mayLost, $mayPros, $mayNeg,$junWon, $junLost, $junPros, $junNeg,$julWon, $julLost, $julPros, $julNeg,$augWon, $augLost, $augPros, $augNeg,$sepWon, $sepLost, $sepPros, $sepNeg);
        }
    }

  
}