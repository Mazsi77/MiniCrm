<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query('INSERT INTO users (username, password, telephone, email, dateofbirth) VALUES(:username, :password, :telephone, :email, :dateofbirth)');

            //Bind values
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':telephone', $data['telephone']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':dateofbirth', $data['dateofbirth']);

            //Execute function
            if($this->db->execute()){
                return true;
            }
            return false;
        }
        public function login($username, $password){
            $this->db->query('SELECT * FROM users WHERE username = :username');

            $this->db->bind(':username', $username);

            $row= $this->db->single();

            $hashedPassword= $row->password;

            if(password_verify($password, $hashedPassword)){
                return $row;
            } else{
                return false;
            }
        }
        //function for checking if there's already a user registered by a column name for ex: username, email
        public function findUserByCol($col, $data){
            //prepared
            $this->db->query('SELECT * FROM users WHERE ' . $col .' = :' . $col);

            //Email param will be bindend with the email var
            $this->db->bind(':' . $col, $data);

            $this->db->execute();

            //Check if email is alrady taken
            if($this->db->rowCount()>0){
                return true;
            }

            return false;
        }
        /* Test (database and table needs to exist before this works)
        public function getUsers() {
            $this->db->query("SELECT * FROM users");

            $result = $this->db->resultSet();

            return $result;
        }
        */
    }
