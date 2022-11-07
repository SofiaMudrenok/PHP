<?php

class DBCntr
{
    public $dbcntr;
    public function __construct($dbcntr)
    {
        $this->dbcntr = $dbcntr;
    }
    public function read()
    {
        return $this->dbcntr->query('SELECT * FROM Stud')->fetchAll();
    }

    public function update($array)
    {
        $this->dbcntr->query('UPDATE Stud SET ' .
            'name = ' . $array['name'] . ', ' .
            'course = ' . $array['course'] . ', ' .
            'specialization = ' . $array['specialization'] . ', ' .
            'WHERE id = ' . $array['id']);
    }
}