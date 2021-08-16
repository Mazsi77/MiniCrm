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
	
	public function getjanWon(){
	    $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-01-%"');
	    
        $result = $this->db->resultSet();
        
        return $result;
    }
	public function getjanLost(){
	    $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-01-%"');
	    
        $result = $this->db->resultSet();
        
        return $result;
    }
	public function getjanPros(){
	    $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-01-%"');
	    
        $result = $this->db->resultSet();
        
        return $result;
    }
	public function getjanNeg(){
	    $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-01-%"');
	    
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getfebWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-02-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getfebLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-02-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getfebPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-02-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getfebNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-02-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmarWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-03-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmarLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-03-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmarPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-03-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmarNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-03-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaprWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-04-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaprLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-04-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaprPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-04-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaprNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-04-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmayWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-05-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmayLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-05-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmayPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-05-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getmayNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-05-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjunWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-06-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjunLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-06-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjunPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-06-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjunNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-06-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjulWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-07-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjulLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-07-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjulPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-07-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getjulNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-07-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaugWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-08-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaugLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-08-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaugPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-08-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getaugNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-08-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getsepWon(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Won" AND opportunities.date LIKE "2021-09-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getsepLost(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Lost" AND opportunities.date LIKE "2021-09-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getsepPros(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Prospecting" AND opportunities.date LIKE "2021-09-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    public function getsepNeg(){
        $this->db->query('SELECT COUNT(opportunities.id) FROM opportunities INNER JOIN stages ON stages.id=opportunities.stage_id WHERE stages.name="Negotiation" AND opportunities.date LIKE "2021-09-%"');
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    
    
    
    

}