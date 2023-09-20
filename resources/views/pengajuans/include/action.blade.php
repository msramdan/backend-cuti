<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            @php
                $employee = DB::table('employees')
                    ->join('departments', 'employees.departemen_id', '=', 'departments.id')
                    ->leftJoin('positions', 'employees.jabatan_id', '=', 'positions.id')
                    ->select('employees.*', 'departments.nama_departemen', 'positions.nama_jabatan')
                    ->where('employees.id', '=', $model->karyawan_id)
                    ->first();
            @endphp
            <div class="modal-body">
                <table class="table table-hover table-striped" style="line-height: 10px">
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
                    <tr>
                        <td class="fw-bold">{{ __('Sisa Cuti Tahunan') }}</td>
                        <td>{{ sisaCuti($employee->id) }} Hari</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('Histori Cuti Karyawan') }}</td>
                        <td> <a href="/employees/{{$employee->id}}" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i> View History</a>  </td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


{{-- modal approved --}}
<div class="modal fade" id="modalApproved{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approved Pengajuan Cuti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateStatus') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                        <input type="hidden" name="status_pengajuan" id="status_pengajuan" value="Approved">
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required>{{ $model->catatan }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    @if ($model->status_pengajuan == 'Pending')
                        <button type="submit" class="btn btn-success">Approved</button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal rejected --}}
<div class="modal fade" id="modalRejected{{ $model->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rejected Pengajuan Cuti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('updateStatus') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Catatan</label>
                        <input type="hidden" name="id" id="id" value="{{ $model->id }}">
                        <input type="hidden" name="status_pengajuan" id="status_pengajuan" value="Rejected">
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required>{{ $model->catatan }}</textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    @if ($model->status_pengajuan == 'Pending')
                        <button type="submit" class="btn btn-danger">Rejected</button>
                    @endif
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<td>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa-solid fa-gear"></i>
        </button>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('pengajuans.show', $model->id) }}" class="dropdown-item">Detail Pengajuan</a>
            </li>
            <li>
                <a href="{{ route('pengajuans.show', $model->id) }}" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $model->id }}">Infomasi Karyawan</a>
            </li>
            <li>
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalApproved{{ $model->id }}">Approved</a>
            </li>
            <li>
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalRejected{{ $model->id }}">Rejected</a>
            </li>
        </ul>
    </div>
</td>
