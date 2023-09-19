
@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2>Detail Pekerjaan</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-timeout alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col"><span style="color: #000000">No</span></th>
            <th scope="col"><span style="color: #000000">Image</span></th>
            <th scope="col"><span style="color: #000000">Detail Pekerjaan</span<</th>
            <th scope="col"><span style="color: #000000">Tanggal</span></th>
            <th scope="col"><span style="color: #000000">Nama User</span></th>
            <th scope="col"><span style="color: #000000">Date Created</span></th>
            <th width="280px">Action</th>
</thead>
        </tr>
        
        @php
            $no = 1;
        @endphp
        @foreach ($laporans as $laporan)
            <tr>
                <td>{{$loop->iteration}}{{ $no++ }}</td>
                <td><img src="{{asset('image/' .$pekerjaan->image) }}" width="100px"></td>
                <td>{{ $laporan->detail_pekerjaan }}</td>
                <td>{{ date('d/m/Y', strtotime($pekerjaan->tanggal)) }}</td>
                <td>{{ $pekerjaan->user->name }}</td>
                <td>{{ date_format($pekerjaan->created_at, 'd/m/Y') }}</td>
                <td>
                                                        
                    
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row text-center">
        {!! $laporans->links() !!}
    </div>

@endsection




      

