@extends('layouts.app')

@section('title', __('Daftar Pengajuan Cuti'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Daftar Pengajuan Cuti') }}</h3>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Pengajuans') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="data-table" width="100%">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Karyawan') }}</th>
                                            <th>{{ __('Jenis Cuti') }}</th>
                                            <th>{{ __('Tanggal Awal') }}</th>
                                            <th>{{ __('Tanggal Akhir') }}</th>
                                            <th>{{ __('Alasan') }}</th>
                                            <th>{{ __('File') }}</th>
                                            <th>{{ __('Tanggal Pengajuan') }}</th>
                                            <th>{{ __('Status Pengajuan') }}</th>
                                            <th>{{ __('Review By') }}</th>
                                            {{-- <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Updated At') }}</th> --}}
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
            ajax: "{{ route('pengajuans.index') }}",
            columns: [{
                    data: 'employee',
                    name: 'employee.created_at'
                },
                {
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
                    render: function(data, type, full, meta) {
                        return `<div class="avatar">
                            <img src="${data}" alt="File">
                        </div>`;
                    }
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
                },
                // {
                //     data: 'created_at',
                //     name: 'created_at'
                // },
                // {
                //     data: 'updated_at',
                //     name: 'updated_at'
                // },
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
