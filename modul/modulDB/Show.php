<?php

class Show
{
    public static function showStud($students)
    {
        $table = '<table border="1px">';
        $table .= '<tr> <th>ID</th> <th>П.І.Б.</th> <th>Курс</th> <th>Спеціальність</th> </tr>';

        foreach ($students as $item) {
            $table .= "<tr><td>$item->id</td><td>$item->name</td><td>$item->course</td>" .
                "<td>$item->specialization</td></tr>";
        }

        $table .= '</table>';
        return $table;
    }
}