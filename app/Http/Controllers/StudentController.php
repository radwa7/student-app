<?php

namespace App\Http\Controllers;
use App\Event\StudentCreated;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\Stu_Validation;
use App\Http\Requests\ShowStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Students;
use App\Helpers\PhoneParser;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberFormat;
use Brick\PhoneNumber\PhoneNumberParseException;

class StudentController extends Controller
{

    public function showAll()
    {
        $students =  StudentResource::collection(Students::all());
        return response()->json($students, 200);
    }


    public function showStudent(ShowStudentRequest $request, $id)
    {

        $student = new StudentResource(Students::findOrFail($id));
        return response()->json($student, 200);
    }


    public function save(Stu_Validation $request)
    {

        $phone = [
            'phone'   => $request->input('phone_number'),
            'code'    => $request->input('country_code'),
            'country' => ''
        ];

        $mobile = PhoneParser::parse($phone);
        $student = $request->all();
        $student['phone_number'] = (string)$mobile['phone'];
        $student['country_code'] = (string)$mobile['code'];
        $student['country'] = (string)$mobile['country'];
        $student = new StudentResource(Students::create($student));
        return  response()->json($student, 200);
        event(new StudentCreated($request->input('email')));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $student = new StudentResource(Students::findOrFail($id));
        $student->update($request->all());
        return response()->json($student, 200);
    }


    public function delete(DeleteStudentRequest $request,$id)
    {
            $student = Students::findOrFail($id);
            $student->delete();
            return response()->json( [
                'status' => true,
                'message' => 'User deleted successfully'
            ], 200);
    }
}
