<?php

class Student
{
    public $id;
    public $name;
    public $course;
    public $specialization;
    public function __construct($id, $array)
    {
        $this->id = $id;
        $this->name = $array['name'];
        $this->course = $array['course'];
        $this->specialization = $array['specialization'];
    }
    public static function validationData($array){
        return !(
            empty($array['name']) ||
            empty($array['course']) ||
            empty($array['specialization']) ||
            !isset($array)
        );
    }
}