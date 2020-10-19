<?php

class Vaccine{
    // DB stuff

    private $conn;
    private $table="_vaccin";
    public function getConn(){
        return $this->conn;
    }
    // Properties
    public $idvaccine;
    public $iddisease;
    public $vaccineName;
    public $vaccineInfos;
    public $nbrDoses;
    public $daysBetween;
    public $addedAt;

    public $diseaseName;
    // Constructor for the connection

    public function __construct($db){
        $this->conn = $db;
    }

    
    // Get Vaccines

    public function read(){
        $query = "SELECT idvaccine,diseaseName, vaccineName,CONCAT(SUBSTRING(vaccineInfos,1,50),'...') AS vaccineInfos,nbrDoses,daysBetween,v.addedAt FROM ". $this->table . 
        " v, _maladie m WHERE v.iddisease = m.iddisease ";
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function read_single(){
        $query = "SELECT * FROM ". $this->table ." v, _maladie m WHERE idvaccine = ? AND m.iddisease = v.iddisease LIMIT 0,1";
        $this->idvaccine = htmlspecialchars(strip_tags($this->idvaccine));
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$this->idvaccine);

        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // SET PROPERTIES
        $this->idvaccine = $row['idvaccine'];
        $this->vaccineName = $row['vaccineName'];
        $this->iddisease = $row['iddisease'];
        $this->diseaseName = $row['diseaseName'];
        $this->vaccineInfos = $row['vaccineInfos'];
        $this->nbrDoses = $row['nbrDoses'];
        $this->daysBetween = $row['daysBetween'];
        $this->addedAt = $row['addedAt'];

        return $stmt;
    }


    // Count Vaccines
    public function count(){
        $query = "SELECT count(*) FROM ". $this->table;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create(){
                
        $this->conn->beginTransaction();
        // create query
        $query = "INSERT INTO " . $this->table ."(iddisease,vaccineName,vaccineInfos,nbrDoses,daysBetween)
        VALUES (:iddisease,:vaccineName,:vaccineInfos,:nbrDoses,:daysBetween)";

        //clean data
        $this->iddisease = htmlspecialchars(strip_tags($this->iddisease));
        $this->vaccineName = htmlspecialchars(strip_tags($this->vaccineName));
        $this->vaccineInfos = htmlspecialchars(strip_tags($this->vaccineInfos));
        $this->nbrDoses = htmlspecialchars(strip_tags($this->nbrDoses));
        $this->daysBetween = htmlspecialchars(strip_tags($this->daysBetween));

        $stmt= $this->conn->prepare($query);
        $stmt->bindParam(":iddisease",$this->iddisease);
        $stmt->bindParam(":vaccineName",$this->vaccineName);
        $stmt->bindParam(":vaccineInfos",$this->vaccineInfos);
        $stmt->bindParam(":nbrDoses",$this->nbrDoses);
        $stmt->bindParam(":daysBetween",$this->daysBetween);
        // Execute query
        if($stmt->execute()) {
                return true;
                $this->conn->commit();
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;  
    }

    // Update Vaccine
    public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET iddisease = :iddisease, vaccineName= :vaccineName, vaccineInfos = :vaccineInfos,
                              nbrDoses = :nbrDoses, daysBetween = :daysBetween
                              WHERE idvaccine = :idvaccine';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        $this->iddisease = htmlspecialchars(strip_tags($this->iddisease));
        $this->vaccineName = htmlspecialchars(strip_tags($this->vaccineName));
        $this->vaccineInfos = htmlspecialchars(strip_tags($this->vaccineInfos));
        $this->nbrDoses = htmlspecialchars(strip_tags($this->nbrDoses));
        $this->daysBetween = htmlspecialchars(strip_tags($this->daysBetween));
        $this->idvaccine = htmlspecialchars(strip_tags($this->idvaccine));
  
        // Bind data
        $stmt->bindParam(":iddisease",$this->iddisease);
        $stmt->bindParam(":vaccineName",$this->vaccineName);
        $stmt->bindParam(":vaccineInfos",$this->vaccineInfos);
        $stmt->bindParam(":nbrDoses",$this->nbrDoses);
        $stmt->bindParam(":daysBetween",$this->daysBetween);
        $stmt->bindParam(":idvaccine",$this->idvaccine);
  
        // Execute query
        if($stmt->execute()) {
          return true;
        }
  
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
    }

    // Delete Disease
    public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE idvaccine= :idvaccine';
            $stmt=$this->conn->prepare($query);
            $this->idvaccine = htmlspecialchars(strip_tags($this->idvaccine));
            $stmt->bindParam(":idvaccine",$this->idvaccine);
            if($stmt->execute()) {
                return true;
            }   
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
    
            return false;
    }


}