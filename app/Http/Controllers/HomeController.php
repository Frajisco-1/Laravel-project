<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var  \App\Models\User $user  */
        $user = $this->getUser();
        $role = $user->hasRole('Admin') ? 'Admin' : 'User';
        $action = sprintf('index%s', $role);

        return $this->$action();
    }

    public function indexUser()
    {
        return view('home.user');
    }

    public function indexAdmin()
    {
        return view('home.admin');
    }


    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('image',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        return redirect()->back();
    }
}
