<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 16-May-18
 * Time: 18:30
 */

class Brand implements JsonSerializable
{
    private $brandId;
    private $name;
    private $originCountry;
    private $image;

    public function __construct($brandId, $name, $originCountry, $image)
    {
        $this->brandId = $brandId;
        $this->name = $name;
        $this->originCountry = $originCountry;
        $this->image = $image;
    }

    public function save(PDO $db)
    {

        $saveBrand = $db->prepare("INSERT INTO brands(name,originCountry,image) values(:name,:originCountry,:image)");
        $saveBrand->bindParam(":name", $this->name);
        $saveBrand->bindParam("originCountry", $this->originCountry);
        $saveBrand->bindParam(":image", $this->image);

        $saveBrand->execute();
    }

    public static function queryBrandsNames(PDO $db)
    {

        $brandsNames = $db->prepare("SELECT name FROM brands");
        $brandsNames->execute();

        $result = $brandsNames->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public static function queryAllBrands(PDO $db)
    {

        $getBrands = $db->prepare("SELECT * FROM brands");
        $getBrands->execute();

        $results = $getBrands->fetchAll(PDO::FETCH_ASSOC);

        $brandsArray = array();

        foreach ($results as $result) {
            $brand = new Brand($result['brandId'], $result['name'], $result['originCountry'], $result['image']);

            array_push($brandsArray, $brand);
        }

        return $brandsArray;
    }

    public static function queryNameToId(PDO $con, $name)
    {

        $nameToId = $con->prepare("SELECT brandId FROM brands WHERE name=:name");
        $nameToId->bindParam(":name", $name);
        $nameToId->execute();

        $result = $nameToId->fetch(PDO::FETCH_ASSOC);

        return $result['brandId'];
    }

    public static function queryIdToName(PDO $con, $brandId)
    {

        $idToName = $con->prepare("SELECT name FROM brands WHERE brandId=:brandId");
        $idToName->bindParam(":brandId", $brandId);
        $idToName->execute();

        $result = $idToName->fetch(PDO::FETCH_ASSOC);

        return $result['name'];
    }

    public function jsonSerialize()
    {
        return [
            'brandId' => $this->brandId,
            'name' => $this->name,
            'originCountry' => $this->originCountry,
            'image' => $this->image,
        ];
    }
}
