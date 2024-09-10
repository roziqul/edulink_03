<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalog;
use App\Models\Serial;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SerialController extends Controller
{
    public function generateBookSerial(Request $request){

        $catalogId = $request->catalog_id;
        $isbn = $request->isbn;
        $serialAmount = $request->serial_amount;
    
        $isbn = str_replace('-', '', $isbn);
    
        $checkExist = Serial::where('catalog_id', $catalogId)->count();
    
        if ($checkExist != 0) {
            $latestSerial = Serial::where('catalog_id', $catalogId)->orderBy('serial_number', 'DESC')->first();            
            $latestSerialNumber = substr($latestSerial->serial_number, strlen($isbn));
    
            for ($i = 0; $i < $serialAmount; $i++) {
                $nextSerialNumber = str_pad((int)$latestSerialNumber + 1 + $i, strlen($latestSerialNumber), '0', STR_PAD_LEFT);
    
                $serialNumber = $isbn . $nextSerialNumber;
    
                $insertSerial = Serial::create([
                    'catalog_id' => $catalogId,
                    'serial_number' => $serialNumber,
                    'status' => 'available'
                ]);
    
                if (!$insertSerial) {
                    Alert::error('Error inserting serial number');
                    return redirect()->back();
                }
            }
    
            Alert::success('Data berhasil ditambah');
            return redirect()->back();
    
        } else {
    
            $initialize = '001';
    
            for ($i = 0; $i < $serialAmount; $i++) {
                $serialNumber = $isbn . str_pad((int)$initialize + $i, strlen($initialize), '0', STR_PAD_LEFT);
    
                $insertSerial = Serial::create([
                    'catalog_id' => $catalogId,
                    'serial_number' => $serialNumber,
                    'status' => 'available'
                ]);
    
                if (!$insertSerial) {
                    Alert::error('Error inserting serial number');
                    return redirect()->back();
                }
            }
    
            Alert::success('Data berhasil ditambah');
            return redirect()->back();
        }
    }

    public function showSerial(string $id){
        
        $serialInfo = Serial::with('catalog')->where('id',$id)->first();

        $data = [
            'serialInfo' => $serialInfo
        ];

        return view('admin.category.catalog.serial.show', $data);
    }
}
