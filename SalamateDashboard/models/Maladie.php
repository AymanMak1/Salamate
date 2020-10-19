<?php

class Maladie{
    // DB stuff

    private $conn;
    private $table="_maladie";
    //private $countryTable = "_pays";
    //private $relationTable ="_maladiespays";

    public function getConn(){
        return $this->conn;
    }
    // Properties

    // Main Table
    public $diseaseName;
    // Main Table & RelationTable
    public $iddisease;
    public $addedAt;
    public $countryNameFr;
    public $idcountry;

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

    public function read(){
        $query = "SELECT m.iddisease,p.abrCountry,p.countryNameFr,m.diseaseName, m.addedAt
        FROM ". $this->table . " m ,_pays p, _maladiespays mp 
        WHERE p.idcountry = mp.idcountry AND mp.iddisease = m.iddisease 
        ORDER By iddisease ";
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Get One Disease
    public function read_single(){
        $query = "SELECT m.iddisease, p.idcountry, p.abrCountry,p.countryNameFr,m.diseaseName, m.addedAt
        FROM ". $this->table . " m ,_pays p, _maladiespays mp 
        WHERE p.idcountry = mp.idcountry AND mp.iddisease = m.iddisease AND m.iddisease= ?
        ORDER By iddisease";
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$this->iddisease);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->iddisease = $row['iddisease'];
        $this->diseaseName = $row['diseaseName'];
        $this->idcountry = $row['idcountry'];
        $this->countryNameFr = $row['countryNameFr'];
        $this->addedAt = $row['addedAt'];
        return $stmt;
    }

    public function read_single_byDiseaseName(){
        $query = "SELECT * FROM ". $this->table ." WHERE diseaseName = ?";
        $this->diseaseName = htmlspecialchars(strip_tags($this->diseaseName));
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$this->diseaseName);

        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // SET PROPERTIES

        $this->iddisease = $row['iddisease'];
        $this->diseaseName = $row['diseaseName'];
        $this->addedAt = $row['addedAt'];

        return $stmt;
    }

    // Get single Disease after creating in order to add it to the data tables
    public function lastInserted(){



    }

    public function create(){

            $this->conn->beginTransaction();
            // create query
            $query = "INSERT INTO " . $this->table ."(diseaseName)". "VALUES (?)";

            //clean data
            $this->diseaseName = htmlspecialchars(strip_tags($this->diseaseName));

            $stmt= $this->conn->prepare($query);
            $stmt->bindParam(1,$this->diseaseName);

            // Execute query
            if($stmt->execute()) {
                    return true;
                    $this->conn->commit();
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;  
      
    }

    
    public function update (){

        $this->conn->beginTransaction();
        // create query
        $query = "UPDATE " . $this->table ." SET diseaseName = ? WHERE iddisease = ?";

        //clean data
        $this->iddisease = htmlspecialchars(strip_tags($this->iddisease));
        $this->diseaseName = htmlspecialchars(strip_tags($this->diseaseName));

        $stmt= $this->conn->prepare($query);
        $stmt->bindParam(1,$this->diseaseName);
        $stmt->bindParam(2,$this->iddisease);

        // Execute query
        if($stmt->execute()) {
                return true;
                $this->conn->commit();
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;  


    }
    // Delete Disease
    public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE iddisease= :iddisease';
            $query2 = 'DELETE FROM _maladiespays WHERE iddisease= :iddisease';
            $stmt=$this->conn->prepare($query);
            // Clean data
            $this->iddisease = htmlspecialchars(strip_tags($this->iddisease));
            $stmt->bindParam(":iddisease",$this->iddisease);
            if($stmt->execute()) {
                $stmt=$this->conn->prepare($query2);
                $stmt->bindParam(":iddisease",$this->iddisease);
                $stmt->execute();
                return true;
            }   
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
    
            return false;
    }


}