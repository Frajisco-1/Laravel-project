<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pekerjaans = Pekerjaan::query()
            ->with(['user'])
            ->where('user_id', \Auth::user()->id)
            ->latest()
            ->paginate(5);

        return view('pekerjaans.index', compact('pekerjaans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_pegawai = User::all();
        return view('pekerjaans.create', compact('data_pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'detail_pekerjaan' => 'required',
            'tanggal' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $pekerjaanImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $pekerjaanImage);
            $input['image'] = $pekerjaanImage;
        }

        $input['user_id'] = Auth::user()->id;
        Pekerjaan::create($input);

        return redirect()->route('pekerjaans.index')
            ->with('success', 'Pekerjaan created successfully.');
    }


    public function show($id): View
{
    $pekerjaan = Pekerjaan::with(['user'])->find($id);
    return view('pekerjaans.show',compact('pekerjaan'));
}


    public function edit($id) : View
    {
        $pekerjaan = Pekerjaan::query()
            ->with(['user'])
            ->find($id);
        $data_tanggal = Carbon::parse($pekerjaan->tanggal)->format('m/d/Y');
        $data_user = User::all();
        return view('pekerjaans.edit', compact('pekerjaan', 'data_user','data_tanggal'));
    }

    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $request->validate([
            'id' => 'required',
            'detail_pekerjaan' => 'required',
            'tanggal' => 'required',
            'user_id' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $oldImage = public_path($destinationPath . $pekerjaan->image);
            if (file_exists($oldImage)) { unlink($oldImage); }

            $pekerjaanImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $pekerjaanImage);
            $input['image'] = $pekerjaanImage;
        } else {
            unset($input['image']);
        }

        $pekerjaan->update($input);

        return redirect()->route('pekerjaans.index')
            ->with('success', 'Pekerjaan updated successfully');
    }

    public function destroy(Pekerjaan $pekerjaan)
    {
        $image = public_path('image/' . $pekerjaan->image);
        if (file_exists($image)) { unlink($image); }
        $pekerjaan->delete();
        return redirect()->route('pekerjaans.index')
            ->with('success', 'Pekerjaan deleted successfully');
    }
}
