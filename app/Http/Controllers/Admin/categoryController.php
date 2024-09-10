<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Catalog;
use App\Models\Category;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $categories = Category::all();

        $classification = [
            'isbn' => 'Kode ISBN',
            'serial_number' => 'Nomor Seri',
            'title' => 'Judul',
            'writer' => 'Penulis',
            'publisher' => 'Penerbit',
            'release_year' => 'Tahun Rilis'
        ];

        $data = [
            'no' => 1,
            'categories' => $categories,
            'classification' => $classification
        ];

        return view('admin.category.index', $data);
    }

    public function store(StoreCategoryRequest $request)
    {
        // $validated = $request->validated();
        // $category = Category::create($validated);
        
        Alert::success('Data berhasil ditambah');
        return redirect()->back();
    }

    public function show(string $id){

        $category = Category::with('catalogs')->where('id', $id)->first();
        $count = $category->catalogs->count();
        
        Carbon::setLocale('id');
        
        $createdDate = Carbon::parse($category->created_at);
        $updatedDate = Carbon::parse($category->updated_at);

        $data = [
            'category' => $category,
            'count' => $count,
            'createdDate' => $createdDate,
            'updatedDate' => $updatedDate
        ];

        return view('admin.category.show', $data);
    }

    public function update(Request $request){
        Alert::success('Data berhasil diperbarui');
        return redirect()->back();
    }
}
