<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreCatalogRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Catalog;
use App\Models\Reserved;
use App\Models\Serial;
use Carbon\Carbon;
use PhpParser\Node\Stmt\Return_;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $category = Category::all();
        
        $data = [
            'category' => $category,
        ];

        return view('admin.category.catalog.create', $data);
    }

    public function store(StoreCatalogRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $storedFilePath = Storage::putFile('public/cover', $request->file('cover'));
            $validated['cover'] = URL::to('/') . Str::of($storedFilePath)->replaceFirst('public/', '/storage/');
        }

        $catalog = Catalog::create($validated);

        if($catalog->create){
            Alert::success('Data berhasil ditambah');
        }
        
        return redirect(route('catalog.index'));
    }

    public function show(string $id)
    {
        $included = ['category','classification'];

        $catalogDetail = Catalog::with($included)->where('id', $id)->first();
        $createdDate = Carbon::parse($catalogDetail->created_at);
        $updatedDate = Carbon::parse($catalogDetail->updated_at);

        $availableSerialNumber = Serial::where('catalog_id', $id)->where('status', 'available')->count();
        $unavailableSerialNumber = Serial::where('catalog_id', $id)->where('status', 'not_available')->count();
        $missingSerialNumber = Serial::where('catalog_id', $id)->where('status', 'missing')->count();
        $allSerial = Serial::where('catalog_id', $id)->orderBy('registration_number', 'ASC')->get();

        $data = [
            'catalogDetail' => $catalogDetail,
            'availableSerialNumber' => $availableSerialNumber,
            'unavailableSerialNumber' => $unavailableSerialNumber,
            'missingSerialNumber' => $missingSerialNumber,
            'allSerial' => $allSerial,
            'createdDate' => $createdDate,
            'updatedDate' => $updatedDate,
        ];

        return view('admin.category.catalog.show', $data);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $oldCategory = $request->category_id;

        $category = Category::all();

        $included = ['category'];

        $catalogDetail = Catalog::with($included)->where('id', $id)->first();
        $availableSerialNumber = Serial::where('catalog_id', $id)->where('status', 'available')->count();


        $data = [
            'catalogDetail' => $catalogDetail,
            'availableSerialNumber' => $availableSerialNumber,
            'category' => $category,
            'oldCategory' => $oldCategory
        ];

        return view('admin.category.catalog.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {        
        $delete = Catalog::where('id', $id)->delete();

        if($delete){
            Alert::success('Data berhasil dihapus');
        }

        $selected = ['id','category_id', 'section_id', 'title', 'writer'];
        $included = ['category', 'section'];

        $catalog = Catalog::with($included)->select($selected)->get();

        $data = [
            'no' => 1,
            'catalog' => $catalog,
        ];

        return view('admin.catalog.index', $data);  
    }

    public function showSerial(string $id){

        $included = ['student','catalog'];

        $serialInfo = Serial::with($included)->where('id',$id)->first();
        $reservedInfo = Reserved::with('student')->where('serial_id', $serialInfo->id)->where('rsv_status', '=', 'not_finished')->first();
        
        $createdDate = Carbon::parse($serialInfo->created_at);
        $updatedDate = Carbon::parse($serialInfo->updated_at);
        
        if ($reservedInfo != null) {
            $startDate = Carbon::parse($reservedInfo->start_date);
            $dueDate = Carbon::parse($reservedInfo->due_date);
        } else {
            $startDate = null;
            $dueDate = null;
        }

        $data = [
            'serialInfo' => $serialInfo,
            'reservedInfo' => $reservedInfo,
            'createdDate' => $createdDate,
            'updatedDate' => $updatedDate,
            'startDate' => $startDate,
            'dueDate' => $dueDate,
        ];

        return view('admin.category.catalog.serial.show', $data);
    }
    
    public function filter(Request $request) {
        $classification = $request->classification;
        $keyword = $request->keyword;
    
        $classificationMap = [
            'isbn' => 'Kode ISBN',
            'serial_number' => 'Nomor Seri',
            'title' => 'Judul',
            'writer' => 'Penulis',
            'publisher' => 'Penerbit',
            'release_year' => 'Tahun Rilis'
        ];
    
        if ($classification == 'serial_number') {
            $catalogInfo = Serial::with('catalog')
                ->where($classification, 'LIKE', '%' . $keyword . '%')
                ->get()
                ->pluck('catalog');
        } else {
            $catalogInfo = Catalog::with('serials')
                ->where($classification, 'LIKE', '%' . $keyword . '%')
                ->get();
        }
    
        $data = [
            'catalogInfo' => $catalogInfo,
            'classification' => $classificationMap,
        ];
    
        if ($catalogInfo->isNotEmpty()) {
            Alert::success('Pencarian berhasil');
        } else {
            Alert::error('Pencarian tidak ditemukan');
        }
    
        return view('admin.category.catalog.search', $data);
    }    
    
}
