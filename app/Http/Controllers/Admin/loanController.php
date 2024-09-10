<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Reserved;
use App\Models\Serial;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LoanController extends Controller
{
    public function getStudentSearch()
    {
        Session::forget('student');
        return view('admin.loan.search');
    }

    public function postStudentSearch(Request $request)
    {
        $studentNisn = $request->nisn;
        $student = Student::where('nisn', $studentNisn)->first();

        if (!$student) {
            Alert::error('NISN tidak terdaftar pada sistem');
            return Redirect::back();
        }

        $studentIsActive = User::where('email', $student->email)->first();

        if (!$studentIsActive) {
            Alert::warning('Siswa belum aktivasi akun');
            return Redirect::back();
        }

        Session::put('student', $student);
        $now = Carbon::now()->toDateString();
        $studentId = $student->id;
        $included = ['serial', 'serial.catalog'];
        $rsvcount = Reserved::where('student_id', $studentId)->where('start_date', $now)->count();
        $studentTodayReservation = Reserved::with($included)->where('student_id', $studentId)->where('start_date', $now)->get();

        $data = [
            'student' => $student,
            'rsvcount' => $rsvcount,
            'catalog' => null,
            'reserved' => $studentTodayReservation,
        ];

        Alert::success('Data ditemukan');
        return view('admin.loan.result', $data);
    }

    public function getCatalogSearch()
    {
        $student = Session::get('student');
        $now = Carbon::now()->toDateString();
        $included = ['serial', 'serial.catalog'];
        $studentId = $student->id;
        $rsvcount = Reserved::where('student_id', $studentId)->where('start_date', $now)->count();
        $studentTodayReservation = Reserved::with($included)->where('student_id', $studentId)->where('start_date', $now)->get();

        $data = [
            'catalog' => null,
            'student' => $student,
            'reserved' => $studentTodayReservation,
            'rsvcount' => $rsvcount,
        ];

        return view('admin.loan.result', $data);
    }

    public function postCatalogSearch(Request $request)
    {
        $student = Session::get('student');
        $now = Carbon::now()->toDateString();
        $studentId = $student->id;
        $included = ['serial', 'serial.catalog'];
        $studentTodayReservation = Reserved::with($included)->where('student_id', $studentId)->where('start_date', $now)->get();
        $rsvcount = Reserved::where('student_id', $studentId)->where('start_date', $now)->count();
        $inputRegistration = $request->book_registration;
        $serial = Serial::where('registration_number', $inputRegistration)->first();

        $data = [
            'catalog' => null,
            'student' => $student,
            'reserved' => $studentTodayReservation,
            'rsvcount' => $rsvcount,
        ];

        if (!$serial) {
            Alert::error('Nomor seri tidak terdaftar');
            return redirect()->back();
        }

        if ($serial->status == "not_available") {
            Alert::error('Buku dengan nomor seri ini masih pada tempo peminjaman');
            return redirect()->back();
        }

        if ($serial->status == "missing") {
            Alert::warning('Buku dengan nomor seri ini dilaporkan hilang');
            return redirect()->back();
        }

        $catalogInfo = Serial::with('catalog','catalog.category')->where('registration_number', $inputRegistration)->first();

        $data['serial_id'] = $catalogInfo->id;
        $data['catalog'] = $catalogInfo->catalog;

        Alert::success('Data ditemukan');

        return view('admin.loan.result', $data);
    }

    public function submit(Request $request)
    {
        $now = Carbon::now()->toDateString();

        $student = Session::get('student');
        $studentId = $student->id;
        $auth = auth()->user()->id;
        $duration = $request->duration;

        $due = Carbon::now()->addWeeks($duration)->toDateString();
        $serialId = $request->serial_id;

        // Fetch the serial record to get the catalog_id
        $serial = Serial::findOrFail($serialId);
        $catalogId = $serial->catalog_id;

        $existingReservation = Reserved::whereHas('serial', function ($query) use ($catalogId) {
            $query->where('catalog_id', $catalogId);
        })
        ->where('student_id', $studentId)
        ->where('start_date', $now)
        ->orWhere('rsv_status', 'not_done')
        ->first();

        if ($existingReservation) {
            Alert::error('Data peminjaman sudah ada untuk katalog ini dan belum selesai');
            return redirect()->route('admin.loan.search-catalog');
        }

        $reserved = new Reserved();
        $reserved->serial_id = $serialId;
        $reserved->student_id = $studentId;
        $reserved->start_date = $now;
        $reserved->duration = $duration;
        $reserved->due_date = $due;
        $reserved->verified_by = $auth;

        $reserved->save();

        if ($reserved->exists) {
            Serial::where('id', $serialId)->update([
                'status' => 'not_available',
                'student_id' => $studentId,
            ]);

            Alert::success('Data peminjaman berhasil ditambahkan');
        } else {
            Alert::error('Data peminjaman gagal ditambahkan');
        }

        return redirect()->route('admin.loan.search-catalog');
    }

    public function cancel(Request $request)
    {
        $now = Carbon::now()->toDateString();
        $reservedId = $request->reserved_id;
        $serialId = $request->serial_id;

        Reserved::where('id', $reservedId)->delete();
        Serial::where('id', $serialId)->update([
            'status' => 'available',
            'student_id' => null,
        ]);

        $student = Session::get('student');
        $studentId = $student->id;
        $included = ['serial', 'serial.catalog'];
        $reserved = Reserved::with($included)->where('student_id', $studentId)->where('start_date', $now)->get();
        $rsvcount = Reserved::where('student_id', $studentId)->where('start_date', $now)->count();

        $data = [
            'catalog' => null,
            'student' => $student,
            'reserved' => $reserved,
            'rsvcount' => $rsvcount,
        ];

        Alert::success('Data peminjaman berhasil dibatalkan');
        return redirect()->back();
    }
}
