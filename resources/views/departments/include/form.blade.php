<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-departeman">{{ __('Nama Departemen') }}</label>
            <input type="text" name="nama_departemen" id="nama-departeman" class="form-control @error('nama_departemen') is-invalid @enderror" value="{{ isset($department) ? $department->nama_departemen : old('nama_departemen') }}" placeholder="{{ __('Nama Departemen') }}" required />
            @error('nama_departemen')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>