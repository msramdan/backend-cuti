<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-jabatan">{{ __('Nama Jabatan') }}</label>
            <input type="text" name="nama_jabatan" id="nama-jabatan" class="form-control @error('nama_jabatan') is-invalid @enderror" value="{{ isset($position) ? $position->nama_jabatan : old('nama_jabatan') }}" placeholder="{{ __('Nama Jabatan') }}" required />
            @error('nama_jabatan')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>