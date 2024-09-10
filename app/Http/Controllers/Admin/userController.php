<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdministratorRequest;
use App\Models\Administrator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $administrator = Administrator::all();

        $data = [
            'no' => 1,
            'administrator' => $administrator,
        ];

        return view('admin.user.administrator.index', $data);
    }

    public function create()
    {
        return view('admin.user.administrator.create');
    }

    public function store(StoreAdministratorRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $storedFilePath = Storage::putFile('public/photo/administrator', $request->file('photo'));
            $validated['photo'] = URL::to('/') . Str::of($storedFilePath)->replaceFirst('public/', '/storage/');
        }

        $administrator = Administrator::create($validated);
        
        return redirect(route('admin-data.index'))->with('success', 'Data berhasil ditambahkan !');
    }

    public function show(string $id)
    {
        $administrator = Administrator::where('id', $id)->first();
        $administratorEmail = $administrator->email;

        $checkExist = User::where('email', $administratorEmail)->first();

        if ($checkExist != null) {
            $checkCondition = $checkExist->status;
            if ($checkCondition == 'active') {
                $status = 'active';
            } else {
                $status = 'nonactive';
            }

            $data = [
                'administrator' => $administrator,
                'status' => $status,
            ];
    
            return view('admin.user.administrator.show', $data);

        } else {
            $status = 'unregistered';

            $data = [
                'administrator' => $administrator,
                'status' => $status,
            ];
    
            return view('admin.user.administrator.show', $data);
        }           

    }

    public function edit(string $id)
    {
        return view('admin.user.administrator.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        Alert::success('Data berhasil dihapus');
        
        $administrator = Administrator::all();

        $data = [
            'no' => 1,
            'administrator' => $administrator,
        ];

        return view('admin.user.administrator.index', $data);
    }
}
