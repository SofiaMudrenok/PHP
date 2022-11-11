<?php

class Repo
{
    public $dbh;

    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }
    public function create($array)
    {
        $this->dbh->query('INSERT INTO Fuelstations(owner, address, fuel, price) VALUES (' .
            "'" . $array['address'] . "', " .
            "'" . $array['owner'] . "', " .
            "'" . $array['fuel'] . "', " .
            "'" . $array['price'] . "')"
        );
    }

    public function read()
    {
        return $this->dbh->query('SELECT * FROM Fuelstations')->fetchAll();
    }

    public function update($array)
    {
        $this->dbh->query('UPDATE Fuelstations SET ' .
            'address = ' . $array['address'] . ', ' .
            'owner = ' . $array['owner'] . ', ' .
            'fuel = ' . $array['fuel'] . ' , ' .
            'price = ' . $array['price'] . ' ' .
            'WHERE code = ' . $array['code']);
    }

    public function delete($array)
    {
        return $this->dbh->query('DELETE FROM Fuelstations WHERE code = ' . $array['code']);
    }
}