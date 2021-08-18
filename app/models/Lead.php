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

    public function editLead($data){
        $this->db->query('UPDATE leads SET name = :name, email = :email, telephone = :telephone WHERE id = :id');

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }

    public function addLeadGetId($data){
        if($this->addLead($data)){
            return $this->db->lastInsert();
        }
        return -1;

    }
}