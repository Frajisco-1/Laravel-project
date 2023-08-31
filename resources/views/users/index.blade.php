@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success btn-sm" href="{{ route('users.create') }}"><i class="fa-solid fa-plus"></i> Create New Pegawai</a>
            <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm"><i class="fa-solid fa-arrow-left"></i> Back to previous</a>
        </div>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-timeout alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Image</th>
   <th>Name</th>
   <th>Email</th>
   <th>Roles</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td><img src="{{asset('image/' .$user->image) }}" width="100px"></td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge bg-danger">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
       <a class="btn btn-warning btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fa-regular fa-eye"></i> Show</a>
       <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="fa-regular fa-pen-to-square"></i> Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
        {{ Form::button('<i class="fa-regular fa-trash-can"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) }}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>
{!! $data->render() !!}
<p class="text-center text-dark"><small>Pegawai</small></p>
@endsection