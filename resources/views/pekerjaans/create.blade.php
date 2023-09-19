@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Pekerjaan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{ route('pekerjaans.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <form action="{{ route('pekerjaans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <strong>Detail Perkerjaan:</strong>
                    <textarea class="form-control" style="height:50px" name="detail_pekerjaan"
                        placeholder="pekerjaan"></textarea>
                </div>
                <div class="form-group">
                    <strong>Tanggal:</strong>
                    <div class="input-group mb-3">
                        <input type="text" name="tanggal" id="datatanggal_input"  value="" class="form-control" placeholder="Tanggal">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa-regular fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
                <!-- <div class="form-group">
                    <strong>Nama User:</strong>
                    <select class="form-control" name="user_id" id="user_id">
                        @foreach ($data_pegawai as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div> -->
                
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
        </div>
    

    <script>
        jQuery("#datatanggal_input").datepicker({
            dateFormat: "dd-mm-yy"
        });
    </script>
@endsection