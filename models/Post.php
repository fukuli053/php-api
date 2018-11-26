<?php
class Post {
    // DB stuff
    private $conn;
    private $table = 'posts';
    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    //Get Post
    public function read() {
        // Create query
        $query = 'SELECT *
                    FROM ' . $this->table . ' as post
                    LEFT JOIN
                      categories c ON post.category_id = c.id
                    ORDER BY
                      post.created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
    }

    public function read_single(){
        // Create query
        $query = 'SELECT *
                    FROM ' . $this->table . ' as post
                    LEFT JOIN
                      categories c ON post.category_id = c.id
                    WHERE 
                        post.id =? 
                        LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row["title"];
    }



}