@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="{{ route('pekerjaans.index') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Detail Pekerjaan:</strong>
            {{ $pekerjaan->detail_pekerjaan }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama User:</strong>
            {{ $pekerjaan->user->name }}
        </div>
</div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tanggal:</strong>
            {{ $pekerjaan ->tanggal }}
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Date Created:</strong>
            {{ $pekerjaan ->created_at }}
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Image:</strong>
            <img src="{{ $pekerjaan->user->image_url }}" alt="" class="img-fluid" width="50">
   </div>
</div>
    </div>
</div>
    
@endsection

