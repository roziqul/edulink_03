<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserved;
use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $student = Student::all();

        $data = [
            'no' => 1,
            'student' => $student,
        ];
        
        return view('admin.user.student.index', $data);
    }

    public function show(string $id)
    {
        $studentInfo = Student::findOrFail($id);

        $studentRsvRecords = $studentInfo->reserveds;
        $studentBillRecords = $studentRsvRecords->where('total_bill', '!=', '0');

        $checkStudentAccount = User::where('email', $studentInfo->email)->first();

        $studentStatus = $checkStudentAccount ? $checkStudentAccount : 'unregistered';

        $data = [
            'student' => $studentInfo,
            'reserved' => $studentRsvRecords,
            'no' => 1,
            'status' => $studentStatus,
            'bill' => $studentBillRecords,
        ];

        return view('admin.user.student.show', $data);
    }


    public function insertExcel(){

    }
}
