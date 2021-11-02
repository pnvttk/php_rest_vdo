<?php
    class Video {
        // db
        private $conn;
        private $table = 'videos';

        // property
        public $id;
        public $title;
        public $url;
        public $description;
        public $img;
        public $img_url;

        // constructor
        public function __construct($db) {
            $this->conn = $db;
        }
        // Get video
        public function read() {
            // create query
            $query = 'SELECT * FROM ' . $this->table . '';

            // prepare stmt
            $stmt = $this->conn->prepare($query);
            // execute
            $stmt->execute();

            return $stmt;
        }
        // Get A video
        public function read_single(){
            // create query
            // $query = 'SELECT * FROM ' . $this->table . 'WHERE id = :id';

            // prepare stmt
            // $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->prepare('SELECT * FROM ' . $this->table .' WHERE id = :id');
            // bind id
            // $stmt->bindParam(':id',$this->id);
            // execute
            // $stmt->execute();
            $stmt->execute(array('id'=>$this->id));

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set property
            $this->title = $row['title'];
            $this->url = $row['url'];
            $this->description = $row['description'];
            $this->img_url = $row['img_url'];

            return $stmt;           
        }
            // create video
        public function create() {
            //create query
            $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                title = :title,
                url = :url,
                description = :description,
                img_url = :img_url';

            // prepare stmt
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->url = htmlspecialchars(strip_tags($this->url));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->img_url = htmlspecialchars(strip_tags($this->img_url));

            // bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':url', $this->url);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':img_url', $this->img_url);

            //execute
            if($stmt->execute()) {
                return true;
            }
            // print error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        // update video
        public function update() {
            //create query
            $query = 'UPDATE ' . $this->table . ' 
            SET 
                title = :title,
                url = :url,
                description = :description,
                img_url = :img_url
            WHERE
                id = :id';

            // prepare stmt
            $stmt = $this->conn->prepare($query);

            // clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->url = htmlspecialchars(strip_tags($this->url));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->img_url = htmlspecialchars(strip_tags($this->img_url));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':url', $this->url);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':img_url', $this->img_url);
            $stmt->bindParam(':id', $this->id);

            //execute
            if($stmt->execute()) {
                return true;
            }
            // print error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
        
        // delete
        public function delete() {
            // create query

            // $query = 'DELETE FROM' . $this->table . ' WHERE id = :id';
            
            // prepare stmt
            // $stmt = $this->conn->prepare($query);

            $stmt = $this->conn->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id');

            // clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind data
            // $stmt->bindParam(':id', $this->id);

            //execute
            if($stmt->execute(array('id'=>$this->id))) {
                return true;
            }
            // print error
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        
    }
?>