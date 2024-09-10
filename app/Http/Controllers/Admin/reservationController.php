<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Reservation;
use App\Models\Reserved;
use App\Models\Serial;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReservationController extends Controller
{
    public function index(){
        $selected = ['student_id', 'status'];
        $reservation = Reservation::with('student')->select($selected)->where('status', 'waiting')->distinct('student_id')->get();

        $data = [
            'no' => 1,
            'reservation' => $reservation,
        ];

        return view('admin.reservation.index', $data);
    }

    public function show(Request $request){
        $studentId = $request->student_id;

        $studentDetail = Student::where('id', $studentId)->first();
        $detailReservation = Reservation::where('student_id', $studentId)->where('status','=','waiting')->get();

        $data = [
            'no' => 1,
            'detailReservation' => $detailReservation,
            'studentDetail' => $studentDetail
        ];

        return view('admin.reservation.show', $data);
    }

    public function detailReservation(Request $request){
        $catalogId = $request->catalog_id;
        $reservationId = $request->reservation_id;

        $catalogDetail = Catalog::where('id', $catalogId)->first();
        $reservationDetail = Reservation::where('id', $reservationId)->first();
        $allSerial = Serial::where('catalog_id', $catalogId)->where('status','=','available')->get();

        $reservationRequest = Carbon::parse($reservationDetail->created_at)->isoFormat('DD-MM-YYYY');
        $timeEstimation = Carbon::parse($reservationRequest)->addWeeks($reservationDetail->duration)->isoFormat('DD-MM-YYYY');

        $data = [
            'catalogDetail' => $catalogDetail,
            'reservationDetail' => $reservationDetail,
            'reservationRequest' => $reservationRequest,
            'timeEstimation' => $timeEstimation,
            'allSerial' => $allSerial
        ];

        return view('admin.reservation.detail', $data);
    }

    public function submit(Request $request){

        $reservationStatus = $request->status;

        if ($reservationStatus == 'approved') {
            $studentId = $request->student_id;
            $startDate = Carbon::parse($request->start_date)->toDateString();
            $duration = $request->duration;
            $dueDate = Carbon::parse($startDate)->addMonths($duration)->toDateString();
            $reservationId = $request->reservation_id;
            $serialId = $request->registration_number;

            $updateReservation = Reservation::where('id', $reservationId)->update([
                'status' => 'approved',
                'verified_by' => auth()->user()->id
            ]);

            $updateSerial = Serial::where('id', $serialId)->update([
                'student_id' => $studentId,
                'status' => 'not_available'
            ]);

            $insertReserved = Reserved::create([
                'serial_id' => $serialId,
                'student_id' => $studentId,
                'duration' => $duration,
                'start_date' => $startDate,
                'due_date' => $dueDate,
                'rsv_status' => 'not_finished',
                'verified_by' => auth()->user()->id
            ]);

            Alert::success('Data Reservasi berhasil diproses');
            return redirect()->back();

        } elseif ($reservationStatus == 'declined') {

            $reservationId = $request->reservation_id;
            $info = $request->info;

            $updateReservation = Reservation::where('id', $reservationId)->update([
                'status' => 'not_approved',
                'verified_by' => auth()->user()->id,
                'info' => $info
            ]);

            if ($updateReservation) {
                Alert::success('Data Reservasi berhasil diproses');
                return redirect()->back();
            } else {
                Alert::error('Data Reservasi gagal diproses');
                return redirect()->back();
            }
        }
        
    }
}
