<?php

class Fuelstation
{
    public $code;
    public $address;
    public $owner;
    public $fuel;
    public $price;
    public function __construct($code, $array)
    {
        $this->code = $code;
        $this->address = $array['address'];
        $this->owner = $array['owner'];
        $this->fuel = $array['fuel'];
        $this->price = $array['price'];
    }
    public static function validationData($array){
        return !(
            empty($array['address']) ||
            empty($array['owner']) ||
            empty($array['fuel']) ||
            empty($array['price']) ||
            !isset($array)
        );
    }

}