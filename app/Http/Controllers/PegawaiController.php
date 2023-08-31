<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PegawaiController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:pegawai-list|pegawai-create|pegawai-edit|pegawai-delete', ['only' => ['index','show']]);
         $this->middleware('permission:pegawai-create', ['only' => ['create','store']]);
         $this->middleware('permission:pegawai-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:pegawai-delete', ['only' => ['destroy']]);
    }
    

    public function index(): View
    {
        $pegawais = User::role('User')->orderBy('id','desc')->paginate(10);
        return view('pegawais.index',compact('pegawais'));
    }


    public function create()
    {
        return view('pegawais.create');
    }


    public function store(Request $request): RedirectResponse
    {
        request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawais.index')->with('success','Pegawai has been created successfully.');
    }


    public function show(Pegawai $pegawai)
    {
        return view('pegawais.show',compact('pegawai'));
    }



    public function edit(Pegawai $pegawai): View
    {
        return view('pegawais.edit',compact('pegawai'));
    }


    

    public function update(Request $request, Pegawai $pegawai): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        $pegawai->fill($request->all())->save();

        return redirect()->route('pegawais.index')->with('success','Pegawai Has Been updated successfully');
    }


    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        $pegawai->delete();
        return redirect()->route('pegawais.index')->with('success','Pegawai has been deleted successfully');    
        }
    }

