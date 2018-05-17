<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16-May-18
 * Time: 18:30
 */

class Product implements JsonSerializable
{
    private $productId;
    private $name;
    private $description;
    private $stock;
    private $price;
    private $image;
    private $categoryId;
    private $brandId;

    public function __construct($productId, $name, $description, $stock, $price, $image, $categoryId, $brandId){
        $this->productId = $productId;
        $this->name = $name;
        $this->description = $description;
        $this->stock = $stock;
        $this->price = $price;
        $this->image = $image;
        $this->categoryId = $categoryId;
        $this->brandId = $brandId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return mixed
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    public static function getAllProducts(PDO $db){

        $getProducts = $db->prepare("SELECT * FROM products");
        $getProducts->execute();

        $result = $getProducts->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = array();

        foreach($result as $product){
            $newProduct = new Product($product['productId'], $product['name'],$product['description'],$product['stock'],$product['price'],
                                    $product['image'], $product['categoryId'], $product['brandId']);

            array_push($productsArray,$newProduct);
        }

        return $productsArray;
    }

    public function jsonSerialize() {
        return [
                'productId' => $this->productId,
                'name' => $this->name,
                'description' => $this->description,
                'stock' => $this->stock,
                'price' => $this->price,
                'image' => $this->image,
                'categoryId' => $this->categoryId,
                'brandId' => $this->brandId
            ];
    }


}