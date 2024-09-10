<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Reserved;
use App\Models\Student;
use App\Models\Serial;
use Carbon\Carbon;

class ReturnController extends Controller
{
    public function getSerialSearch(){

        return view('admin.return.search');

    }

    public function postSerialSearch(Request $request){

        $inputRegistration = $request->registration_number;
        $serialInfo = Serial::where('registration_number', $inputRegistration)->first();

        if ($serialInfo == null) {

            Alert::error('Nomor Seri tidak terdaftar dalam sistem');
            return Redirect::back();

        } else {
            
            if ($serialInfo->status == "available") {
                
                Alert::info('Buku dengan nomor seri ini dalam status tersedia');
                return Redirect::back();

            } elseif ($serialInfo->status == "missing") {

                Alert::warning('Buku dengan nomor seri ini telah dilaporkan hilang');
                return Redirect::back();

            } else {

                $responsibleStudent = Student::where('id', $serialInfo->student_id)->first();
                $serial = Serial::with('catalog','student')->where('registration_number', $inputRegistration)->first();
                
                $serialId = $serial->id;
                $studentId = $responsibleStudent->id;
                $reservedInfo = Reserved::where('serial_id', $serialId)->where('student_id', $studentId)->where('rsv_status', 'not_finished')->first();

                Carbon::setLocale('id');
                $startDate = Carbon::parse($reservedInfo->start_date);
                $dueDate = Carbon::parse($reservedInfo->due_date);

                $data = [
                    'student' => $responsibleStudent,
                    'serial' => $serial,
                    'reserved' => $reservedInfo,
                    'startDate' => $startDate,
                    'dueDate' => $dueDate,
                ];

                return view('admin.return.result', $data);

            }
            
        }
        
    }

    public function submit(Request $request){

        $now = Carbon::now()->toDateString();
        
        $serialId = $request->serial_id;
        $reservedId = $request->reserved_id;

        $serialInfo = Serial::where('id', $serialId)->first();
        $reservedInfo = Reserved::where('id', $reservedId)->first();

        $serialUpdate = $serialInfo->update([
            'status' => 'available',
            'student_id' => null
        ]);

        $reservedUpdate = Reserved::where('id', $reservedId)->update([
            'rsv_status' => 'finished',
            'return_date' => $now
        ]);
        
        $due_date = Carbon::parse($reservedInfo->due_date);
        $return_date = Carbon::parse($reservedInfo->return_date);

        if ($return_date <= $due_date) {

            $reservedUpdate = Reserved::where('id', $reservedId)->update([
                'overdue' => 0,
                'total_bill' => 0
            ]);

            Alert::success('Pengembalian buku berhasil');
            return view('admin.return.search');

        } else {

            $countOverdue = $due_date->diffInDaysFiltered(function (Carbon $date)
                { 
                    return !$date->isWeekday(); 
                }
                , $return_date);

            $bill = 500*$countOverdue;

            $reservedUpdate = Reserved::where('id', $reservedId)->update([
                'overdue' => $countOverdue,
                'total_bill' => $bill
            ]);

            Alert::success('Pengembalian buku berhasil');
            return view('admin.return.search');
        }
        
    }
}
