<?php

namespace App\Http\Controllers;

use App\Event\StudentCreated;
use App\Helpers\PhoneParser;
use App\Http\Requests\RegisterValidation;
use App\Http\Requests\Stu_Validation;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Message;
use App\Models\Students;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    // private StudentRepositoryInterface $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function home()
    {
        return view('home');
    }
    public function stuRegister()
    {
        return view('sturegister');
    }
    public function teaRegister()
    {
        return view('tearegister');
    }

    public function teachers()
    {
        return view('teachers');
    }

    public function addUser(Stu_Validation $request)
    {
        $phone = [
            'phone'   => $request->input('phone_number'),
            'code'    => $request->input('country_code'),
            'country' => ''
        ];
        $mobile = PhoneParser::parse($phone);
        $user = $request->all();
        $user['phone_number'] = (string)$mobile['phone'];
        $user['country_code'] = (string)$mobile['code'];
        $user['country'] = (string)$mobile['country'];
        if($request->input('pass') === $request->input('re_pass')){
            $user['password'] = $request->input('pass');
            $user['password'] = Hash::make($user['password']);
            $user = Students::create($user);
            return redirect()->action([MainController::class, 'stuLogin'])->withSuccess('User Created, please log in');
        }else{
            return view('home')->with('status',"passwords don't match");
        }
    }
    public function addTeacher(RegisterValidation $request)
    {

        $user = $request->all();
        if($request->input('pass') === $request->input('re_pass')){
            $user['password'] = $request->input('pass');
            $user['password'] = Hash::make($user['password']);
            $user = Teacher::create($user);
            return redirect()->action([MainController::class, 'teaLogin'])->withSuccess('Teacher Created, please log in');
        }else{
            return view('home');
        }
    }
    public function stuLogin()
    {
        return view('stulogin');
    }
    public function teaLogin()
    {
        return view('tealogin');
    }
    public function logout()
    {
        Session::forget('studentName');
        Session::forget('teacherName');
        return redirect()->action([MainController::class, 'home']);
    }
    public function validateStudent(Request $request)
    {
        $guest['email'] = $request->input('email');
        $guest['password'] = $request->input('password');
        $user = Students::whereEmail($guest['email'])->first();
        if($user == null){
            return redirect()->action([MainController::class, 'stuLogin'])->with('status','email not found');
        }
        elseif (Hash::check($guest['password'], $user['password'])) {
            session(['studentName' => $user['full_name']]);
            return redirect()->action([MainController::class, 'showTeachers'])->withSuccess('logged in');
        }else{
            return redirect()->action([MainController::class, 'stuLogin'])->with('status','password incorrect');
        }
    }
    public function validateTeacher(Request $request)
    {
        $guest['email'] = $request->input('email');
        $guest['password'] = $request->input('password');
        $user = Teacher::whereEmail($guest['email'])->first();
        if($user == null){
            return redirect()->action([MainController::class, 'teaLogin'])->with('status','email not found');
        }
        elseif (Hash::check($guest['password'], $user['password'])) {
            session(['teacherName' => $user['name']]);
            return redirect()->action([MainController::class, 'show'])->withSuccess('logged in');
        }else{
            return redirect()->action([MainController::class, 'teaLogin'])->with('status','password incorrect');
        }
    }
    public function show()
    {
        if (!empty(Session::get('teacherName'))) {
            // $students =  StudentResource::collection(Students::all());
            $students = $this->studentRepository->getAllStudents();
            return view('students',['students' => $students]);
        }else{
            return redirect()->action([MainController::class, 'teaLogin'])->with('status','please log in first');
        }

    }

    public function showTeachers()
    {
        if (!empty(Session::get('studentName'))) {
            $teachers =  Teacher::all();
            return view('teachers',['teachers' => $teachers]);
        }else{
            return redirect()->action([MainController::class, 'stuLogin'])->with('status','please log in first');
        }
    }

    public function create()
    {
        return view('create');
    }
    public function store(Stu_Validation $request)
    {

        $student = self::PhoneNumebr($request);
        if($request->input('pass') === $request->input('re_pass')){
            $student['password'] = $request->input('pass');
            $student['password'] = Hash::make($student['password']);
            // $student = new StudentResource(Students::create($student));
            $student = $this->studentRepository->createStudent($student);
            return redirect()->action([MainController::class, 'show'])->withSuccess('Student Added');
            event(new StudentCreated($request->input('email')));
        }else{
            return view('home')->with('status',"passwords don't match");
        }
    }
    public function edit($id)
    {
        $student = new StudentResource(Students::findOrFail($id));
        return view('edit',['student' => $student]);
    }
    public function update(UpdateStudentRequest $request, $id)
    {
        $phone = [
            'phone'   => $request->input('phone_number'),
            'code'    => $request->input('country_code'),
            'country' => ''
        ];
        $mobile = PhoneParser::parse($phone);


        // $student = new StudentResource(Students::findOrFail($id));
        $student = $this->studentRepository->getStudentById($request->id);
        // $student->update($request->all());
        $studentData = $request->only([
            'id',
            'full_name',
            'phone_number',
            'country_code',
            'country',
            'email',
            'gender',
            'is_married',
            'have_child'
        ]);

        $studentData['phone_number'] = (string)$mobile['phone'];
        $studentData['country_code'] = (string)$mobile['code'];
        $studentData['country'] = (string)$mobile['country'];

        $student = $this->studentRepository->updateStudetn($student->id,$studentData);
        return redirect()->action([MainController::class, 'show'])->withSuccess('Student Updated');
    }
    public function delete(Request $request)
    {
        // $student = Students::findOrFail($request->student_delete_id);
        $student = $this->studentRepository->getStudentById($request->student_delete_id);
        // $student->delete();
        $this->studentRepository->deleteStudent($student->id);
        return redirect()->action([MainController::class, 'show'])->withSuccess('Student Deleted');
    }


    public function chatTeacher($id)
    {
        $teachers =  Teacher::all();
        $teacher = Teacher::find($id);
        $student = Students::whereFull_name(Session::get('studentName'))->first();
        $messagesSent = Message::where('from', '=', $student['email'] )
                            ->where('to', '=', $teacher['email'])
                            ->get();
        $messagesRec = Message::where('from', '=', $teacher['email'] )
                            ->where('to', '=', $student['email'])
                            ->get();
        $messages = $messagesSent->merge($messagesRec)->sortBy('created_at');
        return view('chat',['id'=>$id, 'teachers'=> $teachers, 'teacherWa'=>$teacher,
                    'student'=>$student , 'messages' => $messages]);
    }

    public function chatStudent($id)
    {
        $students =  Students::all();
        $student = Students::find($id);
        $teacher = Teacher::whereName(Session::get('teacherName'))->first();
        $messagesSent = Message::where('from', '=', $teacher['email'])
                            ->where('to', '=', $student['email'])
                            ->get();
        $messagesRec = Message::where('to', '=', $teacher['email'])
                            ->where('from', '=', $student['email'])
                            ->get();
        $messages = $messagesSent->merge($messagesRec)->sortBy('created_at');
        return view('chatStu',['students'=>$students ,
                            'studentWa' =>$student ,
                            'teacher'=>$teacher,
                            'messages'=>$messages
                            ]);

    }

    public function sendMessage(Request $request)
    {
        $body = $request->all();
        $body = Message::create($body);
        return Redirect::back()->with('message','message sent !');
    }




public function PhoneNumebr(Stu_Validation $request)
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
    return $student;

}




}
