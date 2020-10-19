<?php
  class Vaccine {
    // DB stuff
    private $conn;
    private $table = '_vaccin';
    private $table2 = '_vaccination';
    // voyage Properties
    public $iduser;
    public $idvaccine;
    public $idtrip;

    public $firstDoseDate;
    public $status;
    public $diseaseName;
    public $vaccineName;
    public $vaccineInfos;
    public $nbrDoses;
    public $daysBetween;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    
    public function read() {

        $query = "SELECT v.idvaccine,diseaseName,vaccineName,tripDestination,vaccineInfos,nbrDoses,daysBetween,firstDoseDate,status FROM 
        _pays p,". $this->table ." v," . $this->table2 ." vac, _maladie m,_voyage vo, _vaccinspays vp 
        WHERE v.idvaccine = vp.idvaccine 
        AND vac.idvaccine = v.idvaccine AND v.iddisease = m.iddisease AND 
        vp.idcountry = p.idcountry AND vo.tripDestination = p.countryNameEng 
        AND vac.iduser = vo.iduser AND vo.iduser= :iduser AND idtrip = :idtrip";

        $this->iduser = htmlspecialchars(strip_tags($this->iduser));
        $this->idtrip = htmlspecialchars(strip_tags($this->idtrip));
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(":iduser",$this->iduser);
        $stmt->bindParam(":idtrip",$this->idtrip);
        $stmt->execute();
        return $stmt;
    }

    public function setSchedule(){
         // Create query
         $query = 'UPDATE ' . $this->table2 . '
         SET firstDoseDate = :firstDoseDate
         WHERE iduser = :iduser AND idvaccine = :idvaccine';
   
         // Prepare statementf
         $stmt = $this->conn->prepare($query);
   
         // Clean data
         $this->firstDoseDate = htmlspecialchars(strip_tags($this->firstDoseDate));
         $this->iduser = htmlspecialchars(strip_tags($this->iduser));
         $this->idvaccine = htmlspecialchars(strip_tags($this->idvaccine));
 
   
         // Bind data
         $stmt->bindParam(':firstDoseDate', $this->firstDoseDate);
         $stmt->bindParam(':iduser', $this->iduser);
         $stmt->bindParam(':idvaccine', $this->idvaccine);
   
         // Execute query
         if($stmt->execute()) {
           return true;
         }
   
         // Print error if something goes wrong
         printf("Error: %s.\n", $stmt->error);
   
         return false;

    }

    public function notifyMe(){
      $query = "SELECT vaccineName FROM ". $this->table ." v,". $this->table2 ." vac WHERE v.idvaccine = vac.idvaccine AND vac.iduser = :iduser AND status = 0";
      $this->iduser = htmlspecialchars(strip_tags($this->iduser));
      $stmt=$this->conn->prepare($query);
      $stmt->bindParam(":iduser",$this->iduser);
      $stmt->execute();
      return $stmt;
    }

    public function completedVaccine(){
               // Create query
               $query = 'UPDATE ' . $this->table2 . '
               SET status = :status
               WHERE iduser = :iduser AND idvaccine = :idvaccine';
         
               // Prepare statementf
               $stmt = $this->conn->prepare($query);
         
               // Clean data
               $this->status = htmlspecialchars(strip_tags($this->status));
               $this->iduser = htmlspecialchars(strip_tags($this->iduser));
               $this->idvaccine = htmlspecialchars(strip_tags($this->idvaccine));
       
         
               // Bind data
               $stmt->bindParam(':status', $this->status);
               $stmt->bindParam(':iduser', $this->iduser);
               $stmt->bindParam(':idvaccine', $this->idvaccine);
         
               // Execute query
               if($stmt->execute()) {
                 return true;
               }
         
               // Print error if something goes wrong
               printf("Error: %s.\n", $stmt->error);
         
               return false;
        
    }
  
  }