<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Serial;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class UtilityController extends Controller
{
    public function studentActivation(Request $request) {
        $condition = $request->condition;
    
        if ($condition == 'activation') {
            $createUser = User::create([
                'name' => $request->name, 
                'email' => $request->email,
                'password' => bcrypt($request->password), 
                'role' => 'student', 
                'status' => 'active', 
                'activated_by' => auth()->user()->id,
                'deactivated_by' => null
            ]);
    
            if($createUser) {
                Alert::success('Proses aktivasi akun berhasil!');
            } else {
                Alert::error('Proses aktivasi akun gagal!');
            }
            return redirect()->back();
            
        } elseif ($condition == 'deactivate') {
            $userUpdate = User::where('email', $request->email)->update([
                'status' => 'nonactive',
                'activated_by' => null,
                'deactivated_by' => auth()->user()->id
            ]);
    
            if($userUpdate) {
                Alert::success('Penonaktifan akun berhasil!');
            } else {
                Alert::error('Penonaktifan akun gagal!');
            }
            return redirect()->back();
    
        } else {
            $userUpdate = User::where('email', $request->email)->update([
                'status' => 'active',
                'activated_by' => auth()->user()->id,
                'deactivated_by' => null
            ]);
    
            if($userUpdate) {
                Alert::success('Pengaktifan kembali akun berhasil!');
            } else {
                Alert::error('Pengaktifan kembali akun gagal!');
            }
            return redirect()->back();
        }
    }    

    public function generateBookSerial(Request $request){

        $catalogId = $request->catalog_id;
        $amount = $request->amount;
    
        $catalog = Catalog::find($catalogId);

        $isbn = str_replace('-', '', $catalog->isbn);
    
        $checkExist = Serial::where('catalog_id', $catalogId)->count();
    
        if ($checkExist != 0) {
            $latestSerial = Serial::where('catalog_id', $catalogId)->orderBy('registration_number', 'DESC')->first();            
            $latestregistrationNumber = substr($latestSerial->serial_number, strlen($isbn));
    
            for ($i = 0; $i < $amount; $i++) {
                $nextRegistrationNumber = str_pad((int)$latestregistrationNumber + 1 + $i, strlen($latestregistrationNumber), '0', STR_PAD_LEFT);
    
                $registrationNumber = $isbn . $nextRegistrationNumber;
    
                $insertRegistration = Serial::create([
                    'catalog_id' => $catalogId,
                    'registration_number' => $registrationNumber,
                    'status' => 'available'
                ]);
    
                if (!$insertRegistration) {
                    Alert::error('Error inserting serial number');
                    return redirect()->back();
                }
            }
    
            Alert::success('Data berhasil ditambah');
            return redirect()->back();
    
        } else {
    
            $initialize = '001';
    
            for ($i = 0; $i < $amount; $i++) {
                $registrationNumber = $isbn . str_pad((int)$initialize + $i, strlen($initialize), '0', STR_PAD_LEFT);
    
                $insertRegistration = Serial::create([
                    'catalog_id' => $catalogId,
                    'registration_number' => $registrationNumber,
                    'status' => 'available'
                ]);
    
                if (!$insertRegistration) {
                    Alert::error('Error inserting serial number');
                    return redirect()->back();
                }
            }
    
            Alert::success('Data berhasil ditambah');
            return redirect()->back();
        }
    }

    public function printSingleBookBarcode(Request $request){
        $barcode = $request->registration_number;
        $data = [
            'allSerial' => null,
            'barcode' => $barcode
        ];
        return view('admin.category.catalog.barcode', $data);
    }

    public function printMultipleBookBarcode($catalog_id){
        $allSerial = Serial::where('catalog_id', $catalog_id)->orderBy('serial_number', 'ASC')->get();

        $data = [
            'allSerial' => $allSerial,
            'barcode' => null
        ];

        return view('admin.category.catalog.barcode', $data);
    }
}
