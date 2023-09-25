@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div>
                <h2>Edit Detail Pekerjaan</h2>
            </div>
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('pekerjaans.index') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
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

    <form action="{{ route('pekerjaans.update',$pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $pekerjaan->id }}">
        <input type="hidden" name="user_id" value="{{ $pekerjaan->user_id }}">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail Pekerjaan:</strong>
                    <input class="form-control" name="detail_pekerjaan" placeholder="Detail Pekerjaan" value="{{ $pekerjaan->detail_pekerjaan }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal </strong>
                    <div class="input-group mb-3">
                    <input type="text" name="tanggal" id="datatanggal_input" value="{{ date('d-m-Y', strtotime($pekerjaan->tanggal)) }}" class="form-control" placeholder="Tanggal">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa-regular fa-calendar"></i>
                       </span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Image:{{$pekerjaan->image}}</strong>
                <input type="file" name="image" class="form-control" placeholder="image">
                <img src="{{asset('image/' . $pekerjaan->image) }}" width="100px">
            </div>
        </div>
            <!-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama User</strong>
                    <select class="form-control" name="user_id" id="user_id">
                        <option value="{{ $pekerjaan->user_id }}">{{ $pekerjaan->nama_user }}</option>
                        @foreach ($data_user as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                <input type="hidden" name="id" value="{{ $pekerjaan->id }}">
              <button type="submit" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>

    </form>
    <script>
       jQuery("#datatanggal_input").datepicker({
            dateFormat: "dd-mm-yy"
        });
</script>
@endsection

