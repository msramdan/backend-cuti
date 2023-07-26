@extends('layouts.app')
Cuti
@section('title', __('Detail Pengajuan Cuti'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Pengajuan Cuti') }}</h3>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('pengajuans.index') }}">{{ __('Pengajuan Cuti') }}</a>
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
                                        <td class="fw-bold">{{ __('Employee') }}</td>
                                        <td>{{ $pengajuan->employee ? $pengajuan->employee->created_at : '' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Jenis Cuti') }}</td>
                                        <td>{{ $pengajuan->jenis_cuti == 1 ? 'True' : 'False' }}</td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tanggal Akhir') }}</td>
                                            <td>{{ isset($pengajuan->tanggal_akhir) ? $pengajuan->tanggal_akhir->format('d/m/Y') : ''  }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tanggal Awal') }}</td>
                                            <td>{{ isset($pengajuan->tanggal_awal) ? $pengajuan->tanggal_awal->format('d/m/Y') : ''  }}</td>
                                        </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Alasan') }}</td>
                                            <td>{{ $pengajuan->alasan }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('File') }}</td>
                                        <td>
                                            @if ($pengajuan->file == null)
                                            <img src="https://via.placeholder.com/350?text=No+Image+Avaiable" alt="File"  class="rounded" width="200" height="150" style="object-fit: cover">
                                            @else
                                                <img src="{{ asset('storage/uploads/files/' . $pengajuan->file) }}" alt="File" class="rounded" width="200" height="150" style="object-fit: cover">
                                            @endif
                                        </td>
                                    </tr>
									<tr>
                                            <td class="fw-bold">{{ __('Tanggal Pengajuan') }}</td>
                                            <td>{{ isset($pengajuan->tanggal_pengajuan) ? $pengajuan->tanggal_pengajuan->format('d/m/Y H:i') : ''  }}</td>
                                        </tr>
									<tr>
                                        <td class="fw-bold">{{ __('Status Pengajuan') }}</td>
                                        <td>{{ $pengajuan->status_pengajuan == 1 ? 'True' : 'False' }}</td>
                                    </tr>
									<tr>
                                        <td class="fw-bold">{{ __('User') }}</td>
                                        <td>{{ $pengajuan->user ? $pengajuan->user->created_at : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ $pengajuan->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ $pengajuan->updated_at->format('d/m/Y H:i') }}</td>
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
