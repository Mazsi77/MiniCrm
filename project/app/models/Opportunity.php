<?php
class Opportunity{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getOpportunities(){
        $this->db->query('SELECT opportunities.*, leads.name AS lead_name FROM opportunities INNER JOIN leads ON leads.id=opportunities.lead_id');

        $result = $this->db->resultSet();

        return $result;
    }

    public function addOpportunity($data){
        $this->db->query('INSERT INTO opportunities(lead_id, stage_id, name,amount,prob,close-date) VALUES(:lead_id, :stage_id,:name,:amount,:prob, :close-date');


        $this->db->bind(":lead_id", $data['lead_id']);
        $this->db->bind(":stage_id", $data['stage_id']);
        $this->db->bind(":name", $data['name']);
        $this->db->bind(":amount", $data['amount']);
        $this->db->bind(":prob", $data['prob']);
        $this->db->bind(":close_date", $data['close_date']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

  
    
    
    
    public function updateOpportunities(){
        ///need's to be deeloped
    }
}