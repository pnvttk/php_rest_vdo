<?php
    class User {
        // db
        private $conn;
        private $table = 'tb_user';

        // property
        public $id;
        public $username;
        public $password;
        public $email;

        // constructor
        public function __construct($db) {
            $this->conn = $db;
        }
        // Get User
        public function read() {
            // create query
            $query = 'SELECT * FROM ' . $this->table . '';

            // prepare stmt
            $stmt = $this->conn->prepare($query);
            // execute
            $stmt->execute();

            return $stmt;
        }
    }

?>