@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex justify-content-between">
        <h2 class="mb-0">Update Profil</h2>
        <a class="btn btn-primary btn-sm" href="{{ route('home') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
    </div>
</div>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row mt-3">
    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! Form::model($user, [
            'method' => 'POST',
            'route' => 'users.profileUpdate',
            'enctype' => 'multipart/form-data'
        ]) !!}
            <div class="mb-3">
                <img src="{{ $user->image_url }}" alt="" class="img-fluid" width="150">
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Upload Photo:</label>
                {!! Form::file('photo', ['class' => 'form-control']) !!}
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Name:</label>
                {!! Form::text('name', null, ['placeholder' => 'Name','class' => 'form-control']) !!}
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email:</label>
                {!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control']) !!}
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Password:</label>
                {!! Form::password('password', ['placeholder' => 'Password','class' => 'form-control']) !!}
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Confirm Password:</label>
                {!! Form::password('confirm-password', [
                    'placeholder' => 'Confirm Password','class' => 'form-control'
                ]) !!}
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
