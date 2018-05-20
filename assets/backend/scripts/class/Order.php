<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16-May-18
 * Time: 18:30
 */

class Order
{

    private $userId;
    private $date;

    public function __construct($userId){
        $this->userId = $userId;
        $this->date = time();
    }

    public function insertOrder(PDO $db, $productId){

        $insertOrder = $db->prepare("INSERT INTO orders(userId,productId,date,status) 
                      VALUES(:userId,:productId,:date,0)");
        $insertOrder->bindParam(":userId",$this->userId);
        $insertOrder->bindParam("productId",$productId);
        $insertOrder->bindParam("date", $this->date);
        $insertOrder->execute();
    }



}