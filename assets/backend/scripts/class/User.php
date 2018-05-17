<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16-May-18
 * Time: 13:01
 */


class User
{
    private $userId = 0;
    private $firstName;
    private $lastName;
    private $password;
    private $email;
    private $phone;
    private $address;
    private $isAdmin;
    private $token;

    public function __construct(){

    }

    public function add($firstName, $lastName, $password, $email, $phone, $address){

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;

    }

    public function getCredentials($db,$email,$password){

        $populateUser = $db->prepare("SELECT * FROM users WHERE email=:email and password=:password");
        $populateUser->bindParam(":email",$email);
        $populateUser->bindParam(":password", $password);
        $populateUser->execute();

        if($populateUser->RowCount()){
            $result = $populateUser->fetch(PDO::FETCH_ASSOC);
            return $result['token'];
        } else {
            header("HTTP/1.1 400 Not Found");
            return null;
        }
    }


    public function populate(PDO $db, $email, $token){

        $populateUser = $db->prepare("SELECT * FROM users WHERE email=:email and token=:token");
        $populateUser->bindParam(":email",$email);
        $populateUser->bindParam(":token", $token);
        $populateUser->execute();

        if($populateUser->RowCount()){

            $result = $populateUser->fetch(PDO::FETCH_ASSOC);

            $this->userId = $result['userId'];
            $this->firstName = $result['firstName'];
            $this->lastName = $result['lastName'];
            $this->email = $result['email'];
            $this->phone = $result['phone'];
            $this->address = $result['address'];
            $this->isAdmin = $result['isAdmin'];
            $this->token = $result['token'];
        }

    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getFirstName(){

        return $this->firstName;

    }

    public function getLastName(){

        return $this->lastName;

    }


    public function getEmail()
    {
        return $this->email;
    }


    public function getPhone()
    {
        return $this->phone;
    }


    public function getAddress()
    {
        return $this->address;
    }


    public function getisAdmin()
    {
        return $this->isAdmin;
    }

    public function getToken(){
        return $this->token;
    }


    public function edit(PDO $db){



    }

    public function saveNew(PDO $db){
        $saveUser = $db->prepare("INSERT INTO users(firstName, lastName, password, email, phone, address, token) 
                                              values(:firstName, :lastName, :password, :email, :phone, :address, :token)");

        $this->token = rand(1000);

        $saveUser->bindParam(":firstName",$this->firstName);
        $saveUser->bindParam(":lastName",$this->lastName);
        $saveUser->bindParam(":password",$this->password);
        $saveUser->bindParam(":email",$this->email);
        $saveUser->bindParam(":phone",$this->phone);
        $saveUser->bindParam(":address",$this->address);
        $saveUser->bindParam("token",$this->token);

        $checkUnique = $db->prepare("SELECT * from users where email=:email");
        $checkUnique->bindParam(":email",$this->email);
        $checkUnique->execute();

        if($checkUnique->rowCount()){
            throw new Exception("Email already exists");
        } else {
            return $saveUser->execute();
        }
    }

}

?>