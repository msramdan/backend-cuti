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
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
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
                        <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
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
    <a href="{{ route('pengajuans.show', $model->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
        data-bs-target="#modalApproved{{ $model->id }}">
        <i class="fa fa-check"></i>
    </a>
    <a href="{{ route('pengajuans.show', $model->id) }}" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#modalRejected{{ $model->id }}">
        <i class="fa fa-times"></i>
    </a>
</td>
