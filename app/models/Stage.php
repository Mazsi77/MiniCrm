<?php
    class Stage {
        private $db;

        public function __construct() {
            $this->db = new Database;
        } 

        public function getStages(){
            $this->db->query('SELECT * FROM stages');

            $result = $this->db->resultSet();

            return $result;
        }
        public function addStage($data)
        {
            $this->db->query('INSERT INTO stages(name, is_finished, is_won, def_prob) VALUES(:name, :is_finished, :is_won, :def_prob)');

            $this->db->bind(':name', $data['name']);
            $this->db->bind(':is_finished', $data['is_completed']);
            $this->db->bind(':is_won', $data['is_won']);
            $this->db->bind(':def_prob', $data['prob']);

            return $this->db->execute();
        }

        public function addStageGetId($data){
            if($this->addStage($data)){
                return $this->db->lastInsert();
            }

            return -1;
        }
        public function deleteStage($id){
            $this->db->query('DELETE FROM stages WHERE stages.id = :id');

            $this->db->bind(":id", $id);

            return $this->db->execute();
        }

        public function editStage($data){
            $this->db->query('UPDATE stages SET name = :name, is_won = :is_won , is_finished = :is_finished , def_prob = :def_prob WHERE id = :id');
        
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':is_finished', $data['is_completed']);
            $this->db->bind(':is_won', $data['is_won']);
            $this->db->bind(':def_prob', $data['prob']);
            $this->db->bind(':id', $data['id']);

            return $this->db->execute();
        }
    }