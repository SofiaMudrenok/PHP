<?php

class FuelstationColection
{
    public $fuelstations;

    public function __construct()
    {
    }
    public function defaultFuelstation(){
        $this->fuelstations = [
            new Fuelstation(1 ,[
                'code' => 1,
                'address' => 'Kapushanska',
                'owner' => 'WOG',
                'fuel' => 500,
                'price' => 41
            ]),
            new Fuelstation(2 ,[
                'code' => 2,
                'address' => 'Minayska',
                'owner' => 'WOG',
                'fuel' => 600,
                'price' => 41
            ]),
            new Fuelstation(3 ,[
                'code' => 3,
                'address' => 'Sobranetska',
                'owner' => 'OKKO',
                'fuel' => 550,
                'price' => 40
            ]),
            new Fuelstation(4 ,[
                'code' => 4,
                'address' => 'Minayska',
                'owner' => 'OKKO',
                'fuel' => 400,
                'price' => 40
            ]),
        ];
        return $this;
    }
    public function getByCode($code)
    {
        foreach ($this->fuelstations as $fuelstation) {
            if ($fuelstation->code == $code) {
                return $fuelstation;
            }
        }
        return null;
    }

    public function sortByFuelQuantity($owner, $fuel)
    {
        return array_filter(
            $this->fuelstations,
            function ($value) use ($owner, $fuel) {
                return ($value->owner == $owner and $value->fuel > $fuel);
            }
        );
    }

    public function addFuelstation($fuelstation)
    {
        $this->fuelstations[] = $fuelstation;
    }
    public function editFuelstation($array)
    {
        $fuelstation = $this->getByCode($array['code']);
        if (!(empty($fuelstation))) {
            $fuelstation->code = $array['code'];
            $fuelstation->address = $array['address'];
            $fuelstation->owner = $array['owner'];
            $fuelstation->fuel = $array['fuel'];
            $fuelstation->price = $array['price'];
        }
    }

    public function save()
    {
        $file = fopen("fuelstations.txt", "w");
        fwrite($file, serialize($this->fuelstations));
        fclose($file);
    }

    public function load()
    {
        $this->fuelstations = unserialize(file_get_contents("fuelstations.txt"));
    }

    public function showFuelstations()
    {
        echo "<h2>Таблиця всіх АЗС</h2>";
        $table = '<table border="1px">';
        $table .= '<tr> <th>Code</th> <th>Address</th> <th>Owner</th> <th>Fuel</th> <th>Price</th> </tr>';

        foreach ($this->fuelstations as $item) {
            $table .= "<tr><td>$item->code</td><td>$item->address</td><td>$item->owner</td>" .
                "<td>$item->fuel</td><td>$item->price</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
    public function filter($owner, $fuel)
    {
        echo "<h2>Запит  наявності X літрів пального</h2> <br>";
        $array = $this-> sortByFuelQuantity($owner, $fuel);
        $table = '<table border="1px">';
        $table .= '<tr> <th>Code</th> <th>Address</th> <th>Owner</th> <th>Fuel</th> <th>Price</th> </tr>';

        foreach ($array as $item) {
            $table .= "<tr><td>$item->code</td><td>$item->address</td><td>$item->owner</td>" .
                "<td>$item->fuel</td><td>$item->price</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}