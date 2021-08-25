<?php
class Opportunity{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getOpportunitiesWithDependecy(){
        $this->db->query('SELECT *, opportunities.name AS opname, opportunities.id AS opid, leads.name AS lead_name, stages.name AS stage_name FROM opportunities INNER JOIN leads ON leads.id=opportunities.lead_id INNER JOIN stages ON stages.id=opportunities.stage_id');

        $result = $this->db->resultSet();

        return $result;
    }

    public function getOpportunities(){
        $this->db->query('SELECT *, opportunities.name AS opname, opportunities.id AS opid, leads.name AS lead_name, leads.id AS lead_id FROM opportunities INNER JOIN leads ON leads.id=opportunities.lead_id');
        
        $result = $this->db->resultSet();

        return $result;
    }

    public function getOpportunityById($id){
        $this->db->query('SELECT * FROM opportunities WHERE id = :id');

        $this->db->bind(':id', $id);

        return $this->db->single();
    }

    public function addOpportunity($data){
        $this->db->query('INSERT INTO opportunities(lead_id, stage_id, name, amount, prob, close_date) VALUES(:lead_id, :stage_id,:name, :amount, :prob, :close_date)');


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
    
    public function deleteOpportunity($opid){
        $this->db->query('DELETE FROM opportunities WHERE opportunities.id = :opid');
        
        $this->db->bind(":opid", $opid);
        
        return $this->db->execute();
    }


    public function changeStage($opid, $stageId){
        $this->db->query('UPDATE opportunities SET stage_id = :stage_id WHERE id = :id');

        $this->db->bind(':stage_id', $stageId);
        $this->db->bind(':id', $opid);

        return $this->db->execute();
    }

    public function updateOpportunity($data){
        $this->db->query('UPDATE opportunities SET lead_id = :lead_id, stage_id = :stage_id, name = :name, amount = :amount, prob = :prob, close_date = :close_date WHERE id = :id');

        $this->db->bind(":lead_id", $data['lead_id']);
        $this->db->bind(":stage_id", $data['stage_id']);
        $this->db->bind(":name", $data['name']);
        $this->db->bind(":amount", $data['amount']);
        $this->db->bind(":prob", $data['prob']);
        $this->db->bind(":close_date", $data['close_date']);
        $this->db->bind(":id", $data['currentId']);

        return $this->db->execute();
    }

}