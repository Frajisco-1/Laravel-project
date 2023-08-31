@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <font color="blue"><center><h2>DATA PEGAWAI</h2></center></font>
                    
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success btn-sm" href="{{ route('pegawais.create') }}"> Create Pegawai</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Pegawai Name</th>
                    <th>Pegawai Email</th>
                    <th>Pegawai Address</th>
                    <th>Pegawai Phone Number</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pegawais as $pegawai)
                    <tr>
                        <td>{{ $pegawai->id }}</td>
                        <td>{{ $pegawai->name }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->address }}</td>
                        <td>{{ $pegawai->phone }}</td>
                        <td>
                            <form action="{{ route('pegawais.destroy',$pegawai->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('pegawais.edit',$pegawai->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $pegawais->links() !!}
    </div>
</body>
</html>
@endsection

