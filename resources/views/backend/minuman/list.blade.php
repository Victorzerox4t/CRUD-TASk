@extends('backend.layouts.main')

@section('minuman')
    <div class="container-xl">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Drink <b>Management</b></h2></div>
                        <div class="col-sm-4 text-right">
                            <a href="{{ route('admin.drink.tambah') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-plus"></i> Tambah
                            </a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Drink Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach($drink as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->Drink_Name }}</td>
                            <td>{{ $row->Qty }}</td>
                            <td>{{ $row->Price }}</td>
                            <td>{{ $row->Description }}</td>
                            <td>
                            <td>
                                <img src="{{ route('storage', $row->Image) }}" width="50px" height="50px">
                            </td>
                            </td>
                            <td>
                                <a href="{{ route('admin.drink.edit', $row->id_drink) }}" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.drink.hapus', $row->id_drink) }}" onclick="return confirm('Anda Yakin?')" class="btn btn-sm btn-secondary">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Auto-hide the alert after 3 seconds
            $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
                $(this).slideUp(500);
            });
        });
    </script>
@endsection
