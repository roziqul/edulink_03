<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Missing;
use App\Models\Reserved;
use App\Models\Serial;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $included = ['catalog','catalog.student'];

        $countReserved = Serial::where('status', 'not_available')->count();
        $countBook = Serial::count();
        $countUser = User::where('role', 'student')->count();
        $countFine = Reserved::where('bill_status', 'not_paid')->sum('total_bill');

        $waitingApproval = Missing::where('status', 'waiting_approval')->get();
        $waitingPayments = Reserved::with($included)->where('rsv_status', 'not_done')->get();

        $data = [
            'countReserved' => $countReserved,
            'countBook' => $countBook,
            'countUser' => $countUser,
            'countFine' => $countFine,
            'waitingApproval' => $waitingApproval,
            'waitingPayments' => $waitingPayments,
            'no' => 1
        ];

        return view('admin.dashboard.index', $data);
    }
}
