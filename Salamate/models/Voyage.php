<?php
  class Voyage {
    // DB stuff
    private $conn;
    private $table = '_voyage';

    // voyage Properties
    public $idtrip;
    public $iduser;
    public $tripName;
    public $tripDeparture;
    public $tripDestination;
    public $tripStartDate;
    public $tripEndDate;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      $query = "SELECT * FROM ". $this->table . " WHERE iduser= ?";
      $this->iduser = htmlspecialchars(strip_tags($this->iduser));
      $stmt=$this->conn->prepare($query);
      $stmt->bindParam(1,$this->iduser);
      $stmt->execute();
      return $stmt;
    }

    // Get single user
    public function read_single(){
      $query = "SELECT * FROM ". $this->table ." WHERE idtrip = ? ";
      $this->idtrip = htmlspecialchars(strip_tags($this->idtrip));
     // $this->iduser = htmlspecialchars(strip_tags($this->iduser));
      $stmt=$this->conn->prepare($query);
      //$stmt->bindParam(1,$this->iduser);
      $stmt->bindParam(1,$this->idtrip);

      $stmt->execute();


      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // SET PROPERTIES

      $this->idtrip = $row['idtrip'];
      $this->iduser = $row['iduser'];
      $this->tripName = $row['tripName'];
      $this->tripDeparture= $row['tripDeparture'];
      $this->tripDestination = $row['tripDestination'];
      $this->tripStartDate = $row['tripStartDate'];
      $this->tripEndDate = $row['tripEndDate'];

      return $stmt;

  }

    // Create Post
    public function create() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . ' SET iduser = :iduser, tripName = :tripName, tripDeparture = :tripDeparture,
                                                tripDestination = :tripDestination, tripStartDate = :tripStartDate, tripEndDate = :tripEndDate';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->iduser = htmlspecialchars(strip_tags($this->iduser));
      $this->tripName  = htmlspecialchars(strip_tags($this->tripName ));
      $this->tripDeparture= htmlspecialchars(strip_tags( $this->tripDeparture));
      $this->tripDestination = htmlspecialchars(strip_tags($this->tripDestination));
      $this->tripStartDate = htmlspecialchars(strip_tags($this->tripStartDate));
      $this->tripEndDate = htmlspecialchars(strip_tags($this->tripEndDate));

      // Bind data
      $stmt->bindParam(':iduser', $this->iduser);
      $stmt->bindParam(':tripName',$this->tripName);
      $stmt->bindParam(':tripDeparture', $this->tripDeparture);
      $stmt->bindParam(':tripDestination', $this->tripDestination);
      $stmt->bindParam(':tripStartDate',$this->tripStartDate);
      $stmt->bindParam(':tripEndDate',$this->tripEndDate);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
  }

    // Update Post
    public function update() {
        // Create query
        $query = 'UPDATE ' . $this->table . '
                              SET tripName = :tripName, tripDeparture = :tripDeparture , tripDestination = :tripDestination, tripStartDate = :tripStartDate, tripEndDate = :tripEndDate
                              WHERE idtrip = :idtrip';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        
        $this->tripName = htmlspecialchars(strip_tags($this->tripName));
        $this->tripDeparture = htmlspecialchars(strip_tags($this->tripDeparture));
        $this->tripDestination = htmlspecialchars(strip_tags($this->tripDestination));
        $this->tripStartDate = htmlspecialchars(strip_tags($this->tripStartDate));
        $this->tripEndDate = htmlspecialchars(strip_tags($this->tripEndDate));
        $this->idtrip = htmlspecialchars(strip_tags($this->idtrip));

        // Bind data
        $stmt->bindParam(':tripName', $this->tripName);
        $stmt->bindParam(':tripDeparture', $this->tripDeparture);
        $stmt->bindParam(':tripDestination', $this->tripDestination);
        $stmt->bindParam(':tripStartDate', $this->tripStartDate);
        $stmt->bindParam(':tripEndDate', $this->tripEndDate);
        $stmt->bindParam(':idtrip', $this->idtrip);

        // Execute query
        if($stmt->execute()) {
          return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    //Delete Trip

    public function delete() {

      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE idtrip = :idtrip ';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      //$this->iduser = htmlspecialchars(strip_tags($this->iduser));
      $this->idtrip = htmlspecialchars(strip_tags($this->idtrip));

      // Bind data
     // $stmt->bindParam(':iduser', $this->iduser);
      $stmt->bindParam(':idtrip', $this->idtrip);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
  }

}