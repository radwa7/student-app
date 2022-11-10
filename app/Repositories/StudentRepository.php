<?php

namespace App\Repositories;

use App\Http\Resources\StudentResource;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Students;

class StudentRepository implements StudentRepositoryInterface
{
    public function getAllStudents()
    {
        return StudentResource::collection(Students::all());
    }

    public function getStudentById($id)
    {
        return Students::findOrFail($id);
    }

    public function deleteStudent($id)
    {
        Students::destroy($id);
    }


    public function createStudent(array $studentData)
    {
        return new StudentResource(Students::create($studentData));
    }

    public function updateStudetn($id, array $studentData)
    {
        return Students::whereId($id)->update($studentData);
    }


}
