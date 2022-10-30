<?php

class Show
{
    public static function showFuelstations($fuelstations)
    {
        echo "<h2>Таблиця всіх АЗС</h2>";
        $table = '<table border="1px">';
        $table .= '<tr> <th>Code</th> <th>Address</th> <th>Owner</th> <th>Fuel</th> <th>Price</th> </tr>';

        foreach ($fuelstations as $item) {
            $table .= "<tr><td>$item->code</td><td>$item->address</td><td>$item->owner</td>" .
                "<td>$item->fuel</td><td>$item->price</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}