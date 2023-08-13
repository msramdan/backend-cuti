@extends('layouts.app')

@section('title', __('Detail of Contacts'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Contacts') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail of contact.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('contacts.index') }}">{{ __('Contacts') }}</a>
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
                                        <td>{{ $contact->employee ? $contact->employee->nik : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Judul') }}</td>
                                        <td>{{ $contact->judul }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Deskripsi') }}</td>
                                        <td>{{ $contact->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Tanggal') }}</td>
                                        <td>{{ isset($contact->tanggal) ? $contact->tanggal->format('d/m/Y H:i') : '' }}
                                        </td>
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
