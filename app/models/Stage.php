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
    }