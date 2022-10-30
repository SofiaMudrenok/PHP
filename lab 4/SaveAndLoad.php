<?php

class SaveAndLoad
{
    public static function save($fuelstations)
    {
        $file = fopen("fuelstations.txt", "w");
        fwrite($file, serialize($fuelstations));
        fclose($file);
    }

    public function load()
    {
        return unserialize(file_get_contents("fuelstations.txt"));
    }

}