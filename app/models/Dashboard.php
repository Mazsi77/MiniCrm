<?php
class Dashboard{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getSumAmount(){
        $this->db->query('SELECT SUM(amount) FROM opportunities');

        $result = $this->db->resultSet();

        return $result;
    }
	
	public function getAvgProb(){
        $this->db->query('SELECT AVG(prob) FROM opportunities');

        $result = $this->db->resultSet();

        return $result;
    }
	
	public function getCountWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won"');

        $result = $this->db->resultSet();

        return $result;
    }
	
	public function getCountLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost"');

        $result = $this->db->resultSet();

        return $result;
    }
	
	public function getCountProspecting(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting"');

        $result = $this->db->resultSet();

        return $result;
    }
	
	public function getCountNegotiation(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation"');

        $result = $this->db->resultSet();

        return $result;
    }
    
    public function getCountFinished(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.is_finished="1"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    
    public function getCountNotFinished(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.is_finished="0"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    
    
    

}