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


    public function __construct($brandId, $name, $originCountry, $image){
        $this->brandId = $brandId;
        $this->name = $name;
        $this->originCountry = $originCountry;
        $this->image = $image;
    }

    public static function queryAllBrands(PDO $db){

        $getBrands = $db->prepare("SELECT * FROM brands");
        $getBrands->execute();

        $results = $getBrands->fetchAll(PDO::FETCH_ASSOC);

        $brandsArray = array();

        foreach($results as $result){
            $brand = new Brand($result['brandId'], $result['name'], $result['originCountry'], $result['image']);

            array_push($brandsArray,$brand);
        }

        return $brandsArray;
    }

    public function jsonSerialize() {
        return [
            'brandId' => $this->brandId,
            'name' => $this->name,
            'originCountry' => $this->originCountry,
            'image' => $this->image,
        ];
    }
}