<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function register($data){
            $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

            //Bind values
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

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
        public function findUserByEmail($email){
            //prepared
            $this->db->query('SELECT * FROM users WHERE email = :email');

            //Email param will be bindend with the email var
            $this->db->bind(":email", $email);

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
