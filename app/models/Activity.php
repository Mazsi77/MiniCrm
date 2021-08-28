<?php
class Activity{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    
    public function getActivitiesById($id){
        $this->db->query('SELECT * FROM activities WHERE activities.opport_id = :id');
        
        $this->db->bind(":id", $id);
        
        $result = $this->db->resultSet();
        
        return $result;
    }
    
    public function getActivitiesById2($id){
        $this->db->query('SELECT * FROM activities WHERE activities.id = :id');
        
        $this->db->bind(":id", $id);
        
        //$result = $this->db->resultSet();
         return $this->db->single();
        
       // return $result;
    }
    
    
    public function addActivity($data){
        $this->db->query('INSERT INTO activities(description, type, deadline, is_done,opport_id) VALUES(:description, :type, :deadline, :is_done, :opport_id)');
        
        
        $this->db->bind(":description", $data['description']);
        $this->db->bind(":type", $data['type']);
        $this->db->bind(":deadline", $data['deadline']);
        $this->db->bind(":is_done", $data['is_done']);
        $this->db->bind(":opport_id", $data['opport_id']);
        
        if($this->db->execute()){
            return true;
        }
        return false;
    }
    
    public function deleteActivity($id){
        $this->db->query('DELETE FROM activities WHERE activities.id = :id');
        
        $this->db->bind(":id", $id);
        
        return $this->db->execute();
    }
    
    public function editActivity($data){
        $this->db->query('UPDATE activities SET description = :description, type = :type, deadline = :deadline,  is_done = :is_done WHERE activities.id = :id');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':deadline', $data['deadline']);
        $this->db->bind(':is_done', $data['is_done']);  
                
        return $this->db->execute();
    }
    
    
   
}