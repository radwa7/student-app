<?php

namespace App\Interfaces;

interface StudentRepositoryInterface{
    public function getAllStudents();
    public function getStudentById($id);
    public function deleteStudent($id);
    public function updateStudetn($id, array $studetnData);
    public function createStudent(array $studentData);

}

?>
