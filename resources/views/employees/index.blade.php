@extends('layouts.app')

@section('title', __('Karyawan'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Karyawan') }}</h3>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Employees') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

                @can('karyawan create')
                <div class="d-flex justify-content-end">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i>
                        {{ __('Tambah Departemen') }}
                    </a>
                </div>
                @endcan

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Nik') }}</th>
											<th>{{ __('Nama Karyawan') }}</th>
											<th>{{ __('Tempat Lahir') }}</th>
											<th>{{ __('Tanggal Lahir') }}</th>
											<th>{{ __('Jenis Kelamin') }}</th>
											<th>{{ __('No Hp') }}</th>
											<th>{{ __('Alamat') }}</th>
											<th>{{ __('Department') }}</th>
											<th>{{ __('Position') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script>
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.index') }}",
            columns: [
                {
                    data: 'nik',
                    name: 'nik',
                },
				{
                    data: 'nama_karyawan',
                    name: 'nama_karyawan',
                },
				{
                    data: 'tempat_lahir',
                    name: 'tempat_lahir',
                },
				{
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir',
                },
				{
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin',
                },
				{
                    data: 'no_hp',
                    name: 'no_hp',
                },
				{
                    data: 'alamat',
                    name: 'alamat',
                },
				{
                    data: 'department',
                    name: 'department.id'
                },
				{
                    data: 'position',
                    name: 'position.id'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
        });
    </script>
@endpush
