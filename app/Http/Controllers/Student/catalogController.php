<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Catalog;
use App\Models\Reservation;
use App\Models\Reserved;
use App\Models\Serial;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class catalogController extends Controller
{
    public function index(Request $request) {
        $userEmail = auth()->user()->email;
        $student = Student::where('email', $userEmail)->first();
        $studentId = $student->id;
    
        $userReservation = Reservation::select('catalog_id')
            ->where('student_id', $studentId)
            ->where('status', '=', 'waiting')
            ->pluck('catalog_id')
            ->toArray();
    
        $userReserved = Reserved::select('serial_id')
            ->where('student_id', $studentId)
            ->where('rsv_status', '!=', 'finished')
            ->get()
            ->pluck('serial_id')
            ->toArray();
    
        $excludedIds = array_merge($userReservation, $userReserved);
    
        $studentClassLevelNumeric = explode(' ', $student->class)[0];

        if ($studentClassLevelNumeric == 10) {
            $classificationId = 1;
        } elseif ($studentClassLevelNumeric == 11) {
            $classificationId = 2;
        } elseif ($studentClassLevelNumeric == 12) {
            $classificationId = 3;
        } else {
            $classificationId = 4; // General
        }

        $catalog = Catalog::query()
            ->whereHas('serials', function ($query) use ($excludedIds) {
                $query->whereNotIn('id', $excludedIds);
            })
            ->where(function ($query) use ($classificationId) {
                $query->where('classification_id', $classificationId)
                    ->orWhere('classification_id', 4); // General
            })
            ->orderBy('title', 'ASC')
            ->get();

        $classification = [
            'title' => 'Judul',
            'writer' => 'Penulis',
            'publisher' => 'Penerbit',
            'release_year' => 'Tahun Rilis'
        ];
    
        $data = [
            'catalog' => $catalog,
            'classification' => $classification,
            'excludedIds' => $excludedIds
        ];

        return view('student.catalog.index', $data);
    }

    public function filter(Request $request) {
        $classification = $request->classification;
        $keyword = $request->keyword;
    
        $userEmail = auth()->user()->email;
        $student = Student::where('email', $userEmail)->first();
        $studentId = $student->id;
    
        $userReservation = Reservation::select('catalog_id')
            ->where('student_id', $studentId)
            ->where('status', '!=', 'waiting')
            ->get()
            ->pluck('catalog_id')
            ->toArray();
    
        $userReserved = Reserved::select('serial_id')
            ->where('student_id', $studentId)
            ->where('rsv_status', '!=', 'finished')
            ->get()
            ->pluck('serial_id')
            ->toArray();
    
        $excludedIds = array_merge($userReservation, $userReserved);

        $studentClassLevelNumeric = explode(' ', $student->class)[0];

        if ($studentClassLevelNumeric == 10) {
            $classificationId = 1;
        } elseif ($studentClassLevelNumeric == 11) {
            $classificationId = 2;
        } elseif ($studentClassLevelNumeric == 12) {
            $classificationId = 3;
        } else {
            $classificationId = 4; // General
        }
    
        $catalog = Catalog::query()
            ->where($classification, 'LIKE', '%' . $keyword . '%')
            ->whereHas('serials', function ($query) use ($excludedIds) {
                $query->whereNotIn('id', $excludedIds);
            })
            ->where(function ($query) use ($classificationId) {
                $query->where('classification_id', $classificationId)
                    ->orWhere('classification_id', 4); // General
            })
            ->get();
                
        $classification = [
            'title' => 'Judul',
            'writer' => 'Penulis',
            'publisher' => 'Penerbit',
            'release_year' => 'Tahun Rilis'
        ];
    
        $data = [
            'catalog' => $catalog,
            'classification' => $classification,
            'excludedIds' => $excludedIds
        ];

        if ($catalog->isEmpty()) {
            Alert::error('Pencarian tidak ditemukan');
        } else {
            Alert::success('Pencarian berhasil');
        }
    
        return view('student.catalog.index', $data);
    }

    public function show(string $id) {
        $included = ['category'];

        $userEmail = auth()->user()->email;
        $student = Student::where('email', $userEmail)->first();
        $studentId = $student->id;
    
        $userReservation = Reservation::select('catalog_id')
            ->where('student_id', $studentId)
            ->where('status', '!=', 'waiting')
            ->get()
            ->pluck('catalog_id')
            ->toArray();
    
        $userReserved = Reserved::select('serial_id')
            ->where('student_id', $studentId)
            ->where('rsv_status', '!=', 'finished')
            ->get()
            ->pluck('serial_id')
            ->toArray();
    
        $excludedIds = array_merge($userReservation, $userReserved);

        $studentClassLevelNumeric = explode(' ', $student->class)[0];

        if ($studentClassLevelNumeric == 10) {
            $classificationId = 1;
        } elseif ($studentClassLevelNumeric == 11) {
            $classificationId = 2;
        } elseif ($studentClassLevelNumeric == 12) {
            $classificationId = 3;
        } else {
            $classificationId = 4; // General
        }

        $catalogDetail = Catalog::with($included)
            ->where('id', $id)
            ->whereHas('serials', function ($query) use ($excludedIds) {
                $query->whereNotIn('id', $excludedIds);
            })
            ->first();

        $data = [
            'catalogDetail' => $catalogDetail,
            'excludedIds' => $excludedIds
        ];

        return view('student.catalog.show', $data);
    }
}
