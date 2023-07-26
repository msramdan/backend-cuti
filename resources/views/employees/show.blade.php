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
                                <table class="table table-hover table-striped">
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
                                            <td>{{ isset($employee->tanggal_lahir) ? $employee->tanggal_lahir->format('d/m/Y') : ''  }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Jenis Kelamin') }}</td>
                                        <td>{{ $employee->jenis_kelamin == 1 ? 'True' : 'False' }}</td>
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
                                        <td>{{ $employee->department ? $employee->department->id : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Position') }}</td>
                                        <td>{{ $employee->position ? $employee->position->id : '' }}</td>
                                    </tr>

                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $employee->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $employee->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
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
