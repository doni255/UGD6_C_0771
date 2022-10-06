@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Departemen</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('pegawai')}}">Pegawai</a>
                        </li>
                        <li class="breadcrumb-item active">Index</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Nama Pegawai</th>
                                            <th class="text-center">Department</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Telepon</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pegawai as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->nomor_induk_pegawai }}</td>
                                            <td class="text-center">{{ $item->nama_pegawai }}</td>
                                            @if($item->id_departemen == 1)
                                            <td class="text-center">IT</td>
                                            @elseif($item->id_departemen == 2)
                                            <td class="text-center">Sosial</td>
                                            @elseif($item->id_departemen == 3)
                                            <td class="text-center">Hukum</td>
                                            @elseif($item->id_departemen == 4)
                                            <td class="text-center">Kreatif</td>
                                            @elseif($item->id_departemen == 5)
                                            <td class="text-center">Pemasaran</td>
                                            @else
                                            <td class="text-center">Pelawak</td>
                                            @endif
                                            <td class="text-center">{{ $item->email }}</td>
                                            <td class="text-center">{{ $item->telepon }}</td>
                                            @if($item->gender == 0)
                                            <td class="text-center">Pria</td>
                                            @else
                                            <td class="text-center">Wanita</td>
                                            @endif
                                            @if($item->status == 1)
                                            <td class="text-center">Aktif</td>
                                            @else
                                            <td class="text-center">Tidak Aktif</td>
                                            @endif
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger">
                                            Data Pegawai belum tersedia
                                        </div>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {!! $pegawai->links() !!}
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection

