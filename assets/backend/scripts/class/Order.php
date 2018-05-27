<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16-May-18
 * Time: 18:30
 */

class Order implements JsonSerializable
{

    private $userId;
    private $date;

    public function __construct($userId){
        $this->userId = $userId;
        $this->date = time();
    }

    public function edit($userId, $date){
        $this->userId = $userId;
        $this->date = $date;
    }

    public function insertOrder(PDO $db, $productId){

        $insertOrder = $db->prepare("INSERT INTO orders(userId,productId,date,status) 
                      VALUES(:userId,:productId,:date,0)");
        $insertOrder->bindParam(":userId",$this->userId);
        $insertOrder->bindParam("productId",$productId);
        $insertOrder->bindParam("date", $this->date);
        $insertOrder->execute();
    }

    public function confirmOrder(PDO $db){

        $confirmOrder = $db->prepare("UPDATE orders SET status=1 WHERE date=:date");
        $confirmOrder->bindParam(":date",$this->date);
        $confirmOrder->execute();

    }

    public static function getUnconfirmedOrders(PDO $db){

        $getOrders = $db->prepare("SELECT DISTINCT date, userID FROM orders WHERE status=0");
        $getOrders->execute();

        $orders = $getOrders->fetchAll(PDO::FETCH_ASSOC);

        return $orders;
    }

    public function jsonSerialize() {
        return [
            'date' => $this->date,
            'userID' => $this->userID,
        ];
    }



}