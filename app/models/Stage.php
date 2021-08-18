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
    }