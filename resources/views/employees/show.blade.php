@extends('layouts.app')

@section('title', __('Detail of Employees'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Employees') }}</h3>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('employees.index') }}">{{ __('Employees') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="alert alert-primary" role="alert">
                                    Data Karyawan
                                </div>

                                <table class="table table-hover table-striped" style="line-height: 11px">
                                    <tr>
                                        <td class="fw-bold">{{ __('Nik') }}</td>
                                        <td>{{ $employee->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Nama Karyawan') }}</td>
                                        <td>{{ $employee->nama_karyawan }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tempat Lahir') }}</td>
                                        <td>{{ $employee->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal Lahir') }}</td>
                                        <td>{{ $employee->tanggal_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Jenis Kelamin') }}</td>
                                        <td>{{ $employee->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('No Hp') }}</td>
                                        <td>{{ $employee->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Alamat') }}</td>
                                        <td>{{ $employee->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Department') }}</td>
                                        <td>{{ $employee->nama_departemen }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Position') }}</td>
                                        <td>{{ $employee->nama_jabatan }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="alert alert-primary" role="alert">
                                    Histori Cuti Karyawan Tahun {{ date('Y') }}
                                </div>
                                @php
                                    $tahun = date('Y');
                                    $employee = DB::select("SELECT * FROM pengajuans WHERE karyawan_id='$employee->id' AND YEAR(tanggal_pengajuan)='$tahun'");
                                @endphp
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Jenis Cuti') }}</th>
                                            <th>{{ __('Tanggal Awal') }}</th>
                                            <th>{{ __('Tanggal Akhir') }}</th>
                                            <th>{{ __('Alasan') }}</th>
                                            <th>{{ __('File') }}</th>
                                            <th>{{ __('Tanggal Pengajuan') }}</th>
                                            <th>{{ __('Status Pengajuan') }}</th>
                                            <th>{{ __('Review By') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [{
                    data: 'jenis_cuti',
                    name: 'jenis_cuti',
                },
                {
                    data: 'tanggal_awal',
                    name: 'tanggal_awal',
                },
                {
                    data: 'tanggal_akhir',
                    name: 'tanggal_akhir',
                },

                {
                    data: 'alasan',
                    name: 'alasan',
                },
                {
                    data: 'file',
                    name: 'file',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'tanggal_pengajuan',
                    name: 'tanggal_pengajuan',
                },
                {
                    data: 'status_pengajuan',
                    name: 'status_pengajuan',
                },
                {
                    data: 'user',
                    name: 'user.created_at'
                }
            ],
        });
    </script>
@endpush
