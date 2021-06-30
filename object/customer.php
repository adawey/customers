<?php


class Customer{

    private $connection;
    private $tb_name = 'customers';


    public $id;
    public $name;
    public $email;
    public $phone;
    public $bio;
    public $job;


    public function __construct($db){
        $this->connection = $db;
    }
    

    public function read()
    {

        $query = "SELECT * FROM ". $this->tb_name;

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function readOne(){

        $query = "SELECT * FROM ".$this->tb_name. " WHERE id = ? ";

        $stmt= $this->connection->prepare($query);

        $stmt->bindParam(1,$this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row != null){
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
            $this->bio = $row['bio'];
            $this->job = $row['job'];

        }
    }

    public function create(){

        $query = " INSERT INTO  ".$this->tb_name." SET name=:name, email=:email , phone=:phone , bio=:bio , job=:job ";

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email= htmlspecialchars(strip_tags($this->email));
        $this->phone= htmlspecialchars(strip_tags($this->phone));
        $this->bio = htmlspecialchars(strip_tags($this->bio));
        $this->job = htmlspecialchars(strip_tags($this->job));

        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":phone",$this->phone);
        $stmt->bindParam(":bio",$this->bio);
        $stmt->bindParam(":job",$this->job);

        if($stmt->execute()){
            return true;
        }else{
            return false;
            
        }
    }
        
    



};

?>