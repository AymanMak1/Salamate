<?php

class Actualite{
    // DB stuff

    private $conn;
    private $table="_avisvoyages";
    //private $countryTable = "_pays";
    //private $relationTable ="_maladiespays";

    public function getConn(){
        return $this->conn;
    }
    // Properties
    public $idavis;
    public $title;
    public $publicationDate;
    public $description;
    public $published;

    // Constructor for the connection

    public function __construct($db){
        $this->conn = $db;
    }

    
    // Count Diseases
    public function count(){
        $query = "SELECT count(*) FROM ". $this->table;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    
    // Get News

    public function read(){
        $query = "SELECT idavis,title,publicationDate,CONCAT(SUBSTRING(description,1,50),'...') AS 'description', published FROM ". $this->table . " ORDER BY publicationDate ASC";
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Get One Actualite
    public function read_single(){
        $query = "SELECT * FROM ". $this->table ." WHERE idavis = ? ";
        $this->idavis = htmlspecialchars(strip_tags($this->idavis));
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$this->idavis);

        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // SET PROPERTIES
        $this->idavis = $row['idavis'];
        $this->title =$row['title'];
        $this->publicationDate = $row['publicationDate'];
        $this->description = $row['description'];
        $this->published = $row['published'];

        return $stmt;
    }

    public function create(){
        
        $this->conn->beginTransaction();
        // create query
        $query = "INSERT INTO " . $this->table .
        "(title,publicationDate,description,published)".
        "VALUES (?, ?, ?, ?)";

        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->publicationDate = htmlspecialchars(strip_tags($this->publicationDate));
        $this->description = $this->description;
        $this->published = htmlspecialchars(strip_tags($this->published));
        
        $stmt= $this->conn->prepare($query);
        $stmt->bindParam(1,$this->title);
        $stmt->bindParam(2,$this->publicationDate);
        $stmt->bindParam(3,$this->description);
        $stmt->bindParam(4,$this->published);

        // Execute query
        if($stmt->execute()) {
                return true;
                $this->conn->commit();
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;  

    }  
     // Update Actualite
     public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET title = :title, publicationDate= :publicationDate, description = :description , published = :published
                              WHERE idavis = :idavis';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->publicationDate = htmlspecialchars(strip_tags($this->publicationDate));
        $this->description = $this->description;
        $this->published = htmlspecialchars(strip_tags($this->published));
        $this->idavis = htmlspecialchars(strip_tags($this->idavis));
        // Bind data
        $stmt->bindParam(":title",$this->title);
        $stmt->bindParam(":publicationDate",$this->publicationDate);
        $stmt->bindParam(":description",$this->description);
        $stmt->bindParam(":published",$this->published);
        $stmt->bindParam(":idavis",$this->idavis);
  
        // Execute query
        if($stmt->execute()) {
          return true;
        }
  
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
    }

    // Delete New
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE idavis = :idavis';
        $stmt=$this->conn->prepare($query);
        // Clean data
        $this->idavis = htmlspecialchars(strip_tags($this->idavis));
        $stmt->bindParam(":idavis",$this->idavis);
        if($stmt->execute()) {
            return true;
        }   
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function publish(){
            // Create query
            $query = 'UPDATE ' . $this->table . ' SET published = :published WHERE idavis = :idavis';
            $stmt=$this->conn->prepare($query);
            // Clean data
            $this->idavis = htmlspecialchars(strip_tags($this->idavis));
            $this->published = htmlspecialchars(strip_tags($this->published));
            $stmt->bindParam(":idavis",$this->idavis);
            $stmt->bindParam(":published",$this->published);
            if($stmt->execute()) {
                return true;
            }   
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            
            return false;
    
    }


}