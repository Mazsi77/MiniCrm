<?php

    require_once('Stages.php');
    require_once('Leads.php');
    require_once('Opportunitys.php');

    class Dashboard extends Controller {
        protected $stagesContr;
        protected $leadsContr;
        protected $opsContr;

        public function __construct(){
            $this->stagesContr = new Stages();
            $this->leadsContr = new Leads();
            $this->opsContr = new Opportunitys();
        }

        public function displayDashboard(){
            $ops = $this->opsContr->getOpportunities();
            $leads = $this->leadsContr->getLeads();
            $stages = $this->stagesContr->getStages();

            $this->view('/Dashboard/displayDashboard', $ops, $leads, $stages);
        }
    }