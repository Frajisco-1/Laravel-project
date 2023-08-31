<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);

        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));

        $input = $request->all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'roles' => 'required'
        ]);

        $attributes = $request->all();

        if ($image = $request->file('photo')) {
            $destinationPath = 'image/';
            $userImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $userImage);
            $attributes['image'] = $userImage;
        }

        $attributes['password'] = Hash::make($attributes['password']);

        $user = User::create($attributes);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $attributes = $request->only(['name', 'email']);

        if ($request->password) {
            $attributes['password'] = Hash::make($request->password);
        }

        if ($image = $request->file('photo')) {
            $destinationPath = 'image/';
            $userImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $userImage);
            $attributes['image'] = $userImage;
        }

        $user = User::find($id);
        $user->update($attributes);
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);

        if ($user) {
            \App\Models\Pekerjaan::where('user_id', $user->id)->delete();
            $user->delete();
        }
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function profile()
    {
        $user = auth()->user();

        return view('users.profile', compact('user'));
    }

    public function profileUpdate(Request $request): RedirectResponse
    {
        /** @var  \App\Models\User  $user */
        $user = auth()->user();

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'same:confirm-password'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $attributes = $request->only(['name', 'email']);

        if ($request->password) {
            $attributes['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $image = $request->photo;
            $destinationPath = 'image/';
            $oldImage = public_path($destinationPath . $user->image);
            if ($user->image && file_exists($oldImage)) { unlink($oldImage); }

            $userImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $userImage);
            $attributes['image'] = $userImage;
        }

        $user->update($attributes);

        return redirect()->route('home')->with('success', 'Profile updated successfully');
    }
}
