<?php

class User{
    // DB stuff

    private $conn;
    private $table="_utilisateur";
    public function getConn(){
        return $this->conn;
    }
    // Properties

    public $iduser;
    public $username;
    public $fullName;
    public $nationality;
    public $phoneNumber;
    public $birthday;
    public $gmail;
    public $profilPic;
    public $password;
    public $vkey;
    public $verified=0;
    public $activated=1;
    public $role;
    public $createdAt;

    // Constructor for the connection

    public function __construct($db){
        $this->conn = $db;
    }

    // Get users

    public function read(){
        $query = "SELECT * FROM ". $this->table;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Get single user
    public function read_single(){
        $query = "SELECT * FROM ". $this->table ." WHERE iduser = ?";
        $this->iduser = htmlspecialchars(strip_tags($this->iduser));
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$this->iduser);

        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // SET PROPERTIES

        $this->iduser = $row['iduser'];
        $this->username = $row['username'];
        $this->fullName = $row['fullName'];
        $this->nationality= $row['nationality'];
        $this->phoneNumber = $row['phoneNumber'];
        $this->birthday = $row['birthday'];
        $this->gmail = $row['gmail'];
        $this->profilPic = $row['profilPic'];
        $this->password = $row['password'];
        $this->vkey = $row['vkey'];
        $this->verified = $row['verified'];
        $this->activated = $row['activated'];
        $this->role= $row['role'];
        $this->createdAt = $row['createdAt'];

        return $stmt;

    }

    
    // Latest Users
    public function latestUsers(){
        $query = "SELECT username,fullName,gmail,role,verified,createdAt FROM ". $this->table . " ORDER BY createdAt DESC Limit 5";
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    // Count Users
    public function count(){
        $query = "SELECT count(*) FROM ". $this->table;
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // count verified Users
    public function countVerifiedUsers(){
        $query = "SELECT count(*) FROM ". $this->table . " WHERE verified=:verified";
        $stmt=$this->conn->prepare($query);
        $stmt->bindValue(":verified",1);
        $stmt->execute();
        return $stmt;
    }

    // count unverified Users
    public function countUnverifiedUsers(){
        $query = "SELECT count(*) FROM ". $this->table . "  WHERE verified=:verified";
        $stmt=$this->conn->prepare($query);
        $stmt->bindValue(":verified",0);
        $stmt->execute();
        return $stmt;
    }

    // Delete User
    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE iduser = :iduser';
        $stmt=$this->conn->prepare($query);
        // Clean data
        $this->iduser = htmlspecialchars(strip_tags($this->iduser));
        $stmt->bindParam(":iduser",$this->iduser);
        if($stmt->execute()) {
            return true;
        }   
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    // CREATE USER

    public function create(){
        
            $this->conn->beginTransaction();
            // create query
            $query = "INSERT INTO " . $this->table .
            "(username,fullName,nationality,phoneNumber,birthday,gmail,profilPic,password,vkey,verified,role)".
            "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";

            //clean data
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->fullName = htmlspecialchars(strip_tags($this->fullName));
            $this->nationality = htmlspecialchars(strip_tags($this->nationality));
            $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
            $this->birthday = htmlspecialchars(strip_tags($this->birthday));
            $this->gmail = htmlspecialchars(strip_tags($this->gmail));
            $this->profilPic = htmlspecialchars(strip_tags($this->profilPic));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->vkey = htmlspecialchars(strip_tags($this->vkey));
            $this->verified = htmlspecialchars(strip_tags($this->verified));
            $this->role = htmlspecialchars(strip_tags($this->role));

            
            $stmt= $this->conn->prepare($query);
            $stmt->bindParam(1,$this->username);
            $stmt->bindParam(2,$this->fullName);
            $stmt->bindParam(3,$this->nationality);
            $stmt->bindParam(4,$this->phoneNumber);
            $stmt->bindParam(5,$this->birthday);
            $stmt->bindParam(6,$this->gmail);
            $stmt->bindParam(7,$this->profilPic);
            $stmt->bindParam(8,$this->password);
            $stmt->bindParam(9,$this->vkey);
            $stmt->bindParam(10,$this->verified);
            $stmt->bindParam(11,$this->role);

            // Execute query
            if($stmt->execute()) {
                    return true;
                    $this->conn->commit();
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;  

    }  

    // verified users account
    
    public function verify(){
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET verified = :verified WHERE iduser = :iduser';
        $stmt=$this->conn->prepare($query);
        // Clean data
        $this->iduser = htmlspecialchars(strip_tags($this->iduser));
        $this->verified = htmlspecialchars(strip_tags($this->verified));
        $stmt->bindParam(":iduser",$this->iduser);
        $stmt->bindParam(":verified",$this->verified);
        if($stmt->execute()) {
            return true;
        }   
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        
        return false;

    }

    
    // Update user

    public function update(){
               // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET username = :username, fullName= :fullName, nationality = :nationality,
                              phoneNumber = :phoneNumber, birthday = :birthday, gmail = :gmail, profilPic = :profilPic,
                              password= :password,role = :role
                              WHERE iduser = :iduser';
  
        // Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Clean data
        $this->iduser= htmlspecialchars(strip_tags($this->iduser));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->fullName = htmlspecialchars(strip_tags($this->fullName));
        $this->nationality = htmlspecialchars(strip_tags($this->nationality));
        $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));
        $this->gmail = htmlspecialchars(strip_tags($this->gmail));
        $this->profilPic = htmlspecialchars(strip_tags($this->profilPic));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role = htmlspecialchars(strip_tags($this->role));
        // Bind data
        $stmt->bindParam(":username",$this->username);
        $stmt->bindParam(":fullName",$this->fullName);
        $stmt->bindParam(":nationality",$this->nationality);
        $stmt->bindParam(":phoneNumber",$this->phoneNumber);
        $stmt->bindParam(":birthday",$this->birthday);
        $stmt->bindParam(":gmail",$this->gmail);
        $stmt->bindParam(":profilPic",$this->profilPic);
        $stmt->bindParam(":password",$this->Password);
        $stmt->bindParam(":role",$this->role);
        $stmt->bindParam(":iduser",$this->iduser);
  
        // Execute query
        if($stmt->execute()) {
          return true;
        }
  
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
        
    }
    public function update_noProfil(){  
    }
    public function update_noPassword(){}
    public function update_noPwdPdp(){}
      

    
}
