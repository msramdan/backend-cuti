<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nik">{{ __('Nik') }}</label>
            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ isset($employee) ? $employee->nik : old('nik') }}" placeholder="{{ __('Nik') }}" required />
            @error('nik')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-karyawan">{{ __('Nama Karyawan') }}</label>
            <input type="text" name="nama_karyawan" id="nama-karyawan" class="form-control @error('nama_karyawan') is-invalid @enderror" value="{{ isset($employee) ? $employee->nama_karyawan : old('nama_karyawan') }}" placeholder="{{ __('Nama Karyawan') }}" required />
            @error('nama_karyawan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tempat-lahir">{{ __('Tempat Lahir') }}</label>
            <input type="text" name="tempat_lahir" id="tempat-lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ isset($employee) ? $employee->tempat_lahir : old('tempat_lahir') }}" placeholder="{{ __('Tempat Lahir') }}" required />
            @error('tempat_lahir')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="tanggal-lahir">{{ __('Tanggal Lahir') }}</label>
            <input type="date" name="tanggal_lahir" id="tanggal-lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ isset($employee) && $employee->tanggal_lahir ? $employee->tanggal_lahir->format('Y-m-d') : old('tanggal_lahir') }}" placeholder="{{ __('Tanggal Lahir') }}" required />
            @error('tanggal_lahir')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jenis-kalamin">{{ __('Jenis Kalamin') }}</label>
            <select class="form-select @error('jenis_kalamin') is-invalid @enderror" name="jenis_kalamin" id="jenis-kalamin" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select jenis kalamin') }} --</option>
                <option value="0" {{ isset($employee) && $employee->jenis_kalamin == '0' ? 'selected' : (old('jenis_kalamin') == '0' ? 'selected' : '') }}>{{ __('True') }}</option>
				<option value="1" {{ isset($employee) && $employee->jenis_kalamin == '1' ? 'selected' : (old('jenis_kalamin') == '1' ? 'selected' : '') }}>{{ __('False') }}</option>
            </select>
            @error('jenis_kalamin')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="no-hp">{{ __('No Hp') }}</label>
            <input type="text" name="no_hp" id="no-hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ isset($employee) ? $employee->no_hp : old('no_hp') }}" placeholder="{{ __('No Hp') }}" required />
            @error('no_hp')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="alamat">{{ __('Alamat') }}</label>
            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="{{ __('Alamat') }}" required>{{ isset($employee) ? $employee->alamat : old('alamat') }}</textarea>
            @error('alamat')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="departemen-id">{{ __('Department') }}</label>
            <select class="form-select @error('departemen_id') is-invalid @enderror" name="departemen_id" id="departemen-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select department') }} --</option>
                
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ isset($employee) && $employee->departemen_id == $department->id ? 'selected' : (old('departemen_id') == $department->id ? 'selected' : '') }}>
                                {{ $department->id }}
                            </option>
                        @endforeach
            </select>
            @error('departemen_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jabatan-id">{{ __('Position') }}</label>
            <select class="form-select @error('jabatan_id') is-invalid @enderror" name="jabatan_id" id="jabatan-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select position') }} --</option>
                
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ isset($employee) && $employee->jabatan_id == $position->id ? 'selected' : (old('jabatan_id') == $position->id ? 'selected' : '') }}>
                                {{ $position->id }}
                            </option>
                        @endforeach
            </select>
            @error('jabatan_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>