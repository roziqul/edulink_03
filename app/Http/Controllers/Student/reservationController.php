<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Reserved;
use App\Models\Student;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class reservationController extends Controller
{
    public function index(){
        $userAuth = auth()->user()->email;
        $student = Student::where('email', $userAuth)->first();
        $studentId = $student->id;

        $studentReservation = Reservation::where('student_id', $studentId)->get();

        $data = [
            'no' => 1,
            'studentReservation' => $studentReservation,
        ];

        return view('student.reservation.index', $data);
    }

    public function store(Request $request){
        $userAuth = auth()->user()->email;
        $student = Student::where('email', $userAuth)->first();
        $studentId = $student->id;

        $newReservation = new Reservation();

        $newReservation['catalog_id'] = $request->catalog_id;
        $newReservation['student_id'] = $studentId;
        $newReservation['duration'] = $request->duration;
        $newReservation['status'] = 'waiting';

        $newReservation->save();

        if ($newReservation->save()) {
            Alert::success('Pengajuan peminjaman berhasil!');
        } else {
            Alert::error('Pengajuan peminjaman gagal!');
        }
        
        return redirect()->route('student.catalog.index');
    }
}
