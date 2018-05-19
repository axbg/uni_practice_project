<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16-May-18
 * Time: 23:42
 */

class Category implements JsonSerializable
{
    private $categoryId;
    private $name;
    private $description;
    private $image;

    public function __construct($categoryId, $name, $description, $image){
        $this->categoryId =$categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    public function save(PDO $db){

        $saveCategory = $db->prepare("INSERT INTO categories(name,description,image) values(:name,:description,:image)");
        $saveCategory->bindParam(":name",$this->name);
        $saveCategory->bindParam("description",$this->description);
        $saveCategory->bindParam(":image",$this->image);

        $saveCategory->execute();
    }

    public static function queryCategoriesNames(PDO $db){

        $categoriesNames = $db->prepare("SELECT name FROM categories");
        $categoriesNames->execute();

        $result = $categoriesNames->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function queryAllCategories(PDO $db){

        $getCategories = $db->prepare("SELECT * FROM categories");
        $getCategories->execute();

        $results = $getCategories->fetchAll(PDO::FETCH_ASSOC);

        $categoriesArray = array();

        foreach($results as $result){

            $category = new Category($result['categoryId'],$result['name'],$result['description'],$result['image']);
            array_push($categoriesArray,$category);

        }

        return $categoriesArray;
    }

    public static function queryNameToId(PDO $con, $name){

        $nameToId = $con->prepare("SELECT categoryId FROM categories WHERE name=:name");
        $nameToId->bindParam(":name",$name);
        $nameToId->execute();

        $result = $nameToId->fetch(PDO::FETCH_ASSOC);

        return $result['categoryId'];
    }

    public function jsonSerialize() {
        return [
            'categoryId' => $this->categoryId,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
        ];
    }


}