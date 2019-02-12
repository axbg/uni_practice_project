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

    public function __construct($productId, $name, $description, $stock, $price, $image, $categoryId, $brandId)
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->description = $description;
        $this->stock = $stock;
        $this->price = $price;
        $this->image = $image;
        $this->categoryId = $categoryId;
        $this->brandId = $brandId;
    }

    public function save(PDO $db)
    {

        $saveProduct = $db->prepare("INSERT INTO products(name,description,stock,price,image,brandId,categoryId)
                          values(:name,:description,:stock,:price,:image,:brandId,:categoryId)");
        $saveProduct->bindParam(":name", $this->name);
        $saveProduct->bindParam(":description", $this->description);
        $saveProduct->bindParam(":stock", $this->stock);
        $saveProduct->bindParam(":price", $this->price);
        $saveProduct->bindParam(":image", $this->image);
        $saveProduct->bindParam(":brandId", $this->brandId);
        $saveProduct->bindParam(":categoryId", $this->categoryId);

        $saveProduct->execute();
    }

    /**
     * @return mixed
     */

    public function getProductId()
    {
        return $this->productId;
    }

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

    public static function searchProduct(PDO $db, $name)
    {

        $searchProduct = $db->prepare("SELECT * from products where UPPER(name) LIKE :name");

        $name = "%" . $name . "%";

        $searchProduct->bindParam(":name", $name);
        $searchProduct->execute();

        $results = $searchProduct->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = array();

        foreach ($results as $product) {
            $newProduct = new Product($product['productId'], $product['name'], $product['description'], $product['stock'], $product['price'],
                $product['image'], $product['categoryId'], $product['brandId']);

            array_push($productsArray, $newProduct);
        }

        return $productsArray;
    }

    public static function getProduct(PDO $db, $productId)
    {

        $getProduct = $db->prepare("SELECT * FROM products WHERE productId=:productId");
        $getProduct->bindParam(":productId", $productId);
        $getProduct->execute();

        $product = $getProduct->fetch(PDO::FETCH_ASSOC);

        if ($product['productId']) {

            $retrievedProduct = new Product($product['productId'], $product['name'], $product['description'], $product['stock'], $product['price'],
                $product['image'], $product['categoryId'], $product['brandId']);

            return $retrievedProduct;

        } else {
            return null;
        }

    }

    public static function getAllProducts(PDO $db)
    {

        $getProducts = $db->prepare("SELECT * FROM products ORDER BY productId DESC LIMIT 6");
        $getProducts->execute();

        $result = $getProducts->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = array();

        foreach ($result as $product) {
            $newProduct = new Product($product['productId'], $product['name'], $product['description'], $product['stock'], $product['price'],
                $product['image'], $product['categoryId'], $product['brandId']);

            array_push($productsArray, $newProduct);
        }

        return $productsArray;
    }

    public static function getCategory(PDO $db, $categoryId)
    {

        $getCategory = $db->prepare("SELECT * FROM products WHERE categoryId=:categoryId");
        $getCategory->bindParam(":categoryId", $categoryId);
        $getCategory->execute();

        $results = $getCategory->fetchAll(PDO::FETCH_ASSOC);
        $productsArray = array();

        foreach ($results as $product) {
            $newProduct = new Product($product['productId'], $product['name'], $product['description'], $product['stock'], $product['price'],
                $product['image'], $product['categoryId'], $product['brandId']);

            array_push($productsArray, $newProduct);
        }

        return $productsArray;
    }

    public static function getBrand(PDO $db, $brandId)
    {

        $getBrand = $db->prepare("SELECT * from products WHERE brandId=:brandId");
        $getBrand->bindParam(":brandId", $brandId);
        $getBrand->execute();

        $results = $getBrand->fetchAll(PDO::FETCH_ASSOC);

        $productsArray = array();

        foreach ($results as $product) {
            $newProduct = new Product($product['productId'], $product['name'], $product['description'], $product['stock'], $product['price'],
                $product['image'], $product['categoryId'], $product['brandId']);

            array_push($productsArray, $newProduct);
        }

        return $productsArray;
    }

    public function jsonSerialize()
    {
        return [
            'productId' => $this->productId,
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'image' => $this->image,
            'categoryId' => $this->categoryId,
            'brandId' => $this->brandId,
        ];
    }

}
