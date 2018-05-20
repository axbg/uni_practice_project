<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16-May-18
 * Time: 18:30
 */

class Cart
{

    private $userId;

    public function __construct($userId){
        $this->userId = $userId;
    }

    public function insert(PDO $db, $productId){

        $checkStock = $db->prepare("SELECT stock FROM products WHERE productId=:productId");
        $checkStock->bindParam(":productId",$productId);
        $checkStock->execute();

        $result = $checkStock->fetch(PDO::FETCH_ASSOC);

        if($result['stock']){

            $alterStock = $db->prepare("UPDATE products SET stock=stock-1 WHERE productId=:productId");
            $alterStock->bindParam(":productId",$productId);
            $alterStock->execute();

            $addToCart = $db->prepare("INSERT INTO cart(userId, productId, status, quantity) 
                                          VALUES(:userId,:productId,0,1)");
            $addToCart->bindParam(":userId",$this->userId);
            $addToCart->bindParam(":productId",$productId);
            $addToCart->execute();

        } else {
            //throw new Exception("Stock is empty");
            throw new Exception($productId);
        }

    }

    public function delete(PDO $db, $productId){

        $deleteItem = $db->prepare("DELETE FROM cart WHERE productId=:productId AND userId=:userId LIMIT 1");
        $deleteItem->bindParam(":productId",$productId);
        $deleteItem->bindParam(":userId",$this->userId);
        $deleteItem->execute();

        $replenishStock = $db->prepare("UPDATE products SET stock=stock+1 WHERE productId=:productId");
        $replenishStock->bindParam("productId", $productId);
        $replenishStock->execute();
    }


    public function deleteOne(PDO $db, $productId){

        $deleteItem = $db->prepare("DELETE FROM cart WHERE userId=:userId AND productId=:productId LIMIT 1");
        $deleteItem->bindParam(":userId",$this->userId);
        $deleteItem->bindParam("productId",$productId);
        $deleteItem->execute();

    }

    public function queryUserCart(PDO $db){

        $getUserCart = $db->prepare("SELECT products.productId, products.name, products.description, products.stock, products.price,
                                      products.image, products.categoryId, products.brandId FROM products JOIN 
                                      cart ON cart.userId = :userId AND cart.productId = products.productId
                                      GROUP BY products.productId");
        $getUserCart->bindParam(":userId",$this->userId);
        $getUserCart->execute();

        $result = $getUserCart->fetchAll(PDO::FETCH_ASSOC);

        $cartProducts = array();

        foreach($result as $cartItem){

            $product = new Product($cartItem['productId'], $cartItem['name'], $cartItem['description'], $cartItem['stock'], $cartItem['price'],
                        $cartItem['image'],$cartItem['categoryId'],$cartItem['brandId']);

            array_push($cartProducts,$product);
        }

        return $cartProducts;

    }

    public function queryUserCartDuplicates(PDO $db){

        $getUserCart = $db->prepare("SELECT products.productId, products.name, products.description, products.stock, products.price,
                                      products.image, products.categoryId, products.brandId FROM products JOIN 
                                      cart ON cart.userId = :userId AND cart.productId = products.productId");
        $getUserCart->bindParam(":userId",$this->userId);
        $getUserCart->execute();

        $result = $getUserCart->fetchAll(PDO::FETCH_ASSOC);

        $cartProducts = array();

        foreach($result as $cartItem){

            $product = new Product($cartItem['productId'], $cartItem['name'], $cartItem['description'], $cartItem['stock'], $cartItem['price'],
                $cartItem['image'],$cartItem['categoryId'],$cartItem['brandId']);

            array_push($cartProducts,$product);
        }

        return $cartProducts;

    }

    public function queryUserQuantities(PDO $db){

        $getUserCart = $db->prepare("SELECT count(products.productId) AS quantity FROM products JOIN 
                                      cart ON cart.userId = :userId AND cart.productId = products.productId
                                      GROUP BY products.productId");
        $getUserCart->bindParam(":userId",$this->userId);
        $getUserCart->execute();

        $result = $getUserCart->fetchAll(PDO::FETCH_ASSOC);

        $cartQuantities = array();

        foreach($result as $quantity){

            array_push($cartQuantities,$quantity['quantity']);
        }

        return $cartQuantities;

    }

}

?>