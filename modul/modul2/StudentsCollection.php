<?php

class StudentsCollection
{
    public $students;

    public function __construct()
    {
    }
    public function defaultStud(){
        $this->students = [
            new Student(1,[
                'name' => 'Сміла О.В.',
                'course' => 4,
                'specialization' => 'Фізика'
            ]),
            new Student(2,[
                'name' => 'Онієв І. В.',
                'course' => 1,
                'specialization' => 'Виш.Мат.'
            ]),
            new Student(3,[
                'name' => 'Іванов О. І.',
                'course' => 2,
                'specialization' => 'Інформатика'
            ]),
            new Student(4,[
                'name' => 'Міщий А. А.',
                'course' => 1,
                'specialization' => 'Право'
            ]),
        ];
        return $this;
    }
    public function getById($id)
    {
        foreach ($this->students as $students) {
            if ($students->id == $id) {
                return $students;
            }
        }
        return null;
    }


    public function edit($array)
    {
        $students = $this->getById($array['id']);
        if (!(empty($students))) {
            $students->name = $array['name'];
            $students->course = $array['course'];
            $students->specialization = $array['specialization'];
        }
    }
}