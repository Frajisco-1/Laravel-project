<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    public function index()
    {
        
        $laporans = Pekerjaan::query()
            ->with(['user'])
            ->latest()
            ->paginate(5);
            

        return view('laporans.index', compact('laporans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

}


