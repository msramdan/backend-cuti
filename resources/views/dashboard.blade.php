@extends('layouts.app')

@section('title', __('Dashboard'))

@push('css')
    <style>
        canvas {
            width: 330px !important;
            height: 330px !important;
        }
    </style>
@endpush

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-xl-3 col-sm-6 box-col-3">
            <div class="card radius-10 border-start border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Karyawan</p>
                            <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                    data-bs-target="#modalBrancError">
                                    {{ App\Models\Employee::count() }} Data </a>
                            </h4>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                class="fa fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 box-col-3">
            <div class="card radius-10 border-start border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Jabatan</p>
                            <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                    data-bs-target="#modalBrancError">
                                    {{ App\Models\Position::count() }} Data </a>
                            </h4>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                class="fa fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 box-col-3">
            <div class="card radius-10 border-start border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Departemen</p>
                            <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                    data-bs-target="#modalBrancError">
                                    {{ App\Models\Department::count() }} Data </a>
                            </h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                class="fa fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 box-col-3">
            <div class="card radius-10 border-start border-0 border-3 border-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">User</p>
                            <h4 class="my-1 text-primary"><a href="#" class="" data-bs-toggle="modal"
                                    data-bs-target="#modalBrancError">
                                    {{ App\Models\User::count() }} Data </a>
                            </h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                class="fa fa-database"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card" style="height: 400px">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">
                           Pengajuan Cuti - Pending Vs Approved Vs Rejected
                        </h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"> </canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card" style="height: 400px">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">
                            Daftar Cuti Hari ini
                        </h4>
                    </div>
                    <div class="card-body" style="overflow-y: scroll;">
                        <table class="table table-bordered table-xs">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Faskes</th>
                                    <th scope="col">Jumlah Laporan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Pending', 'Approved', 'Rejected'],
                datasets: [{
                    label: '# Total',
                    data: [
                        {{ totalPengajuan('Pending') }},
                        {{ totalPengajuan('Approved') }},
                        {{ totalPengajuan('Rejected') }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush

