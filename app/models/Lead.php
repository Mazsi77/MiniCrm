<?php
class Lead{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getLeads(){
        $this->db->query('SELECT * FROM leads');

        $result = $this->db->resultSet();

        return $result;
    }

    public function addLead($data){
        $this->db->query('INSERT INTO leads(name, email, telephone) VALUES(:name, :email, :telephone)');


        $this->db->bind(":name", $data['name']);
        $this->db->bind(":email", $data['email']);
        $this->db->bind(":telephone", $data['telephone']);

        if($this->db->execute()){
            return true;
        }
        return false;
    }

    public function updateLead(){
        ///need's to be deeloped
    }
    public function deleteLead($id){
        $this->db->query('DELETE FROM leads WHERE leads.id = :id');

        $this->db->bind(":id", $id);

        return $this->db->execute();
    }

    public function getLeadById($id){
        $this->db->query('SELECT * FROM leads WHERE leads.id = :id');

        $this->db->bind(":id", $id);

        return $this->db->single();
    }
}