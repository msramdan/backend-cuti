<td>
    @can('pengajuan view')
    <a href="{{ route('pengajuans.show', $model->id) }}" class="btn btn-outline-success btn-sm">
        <i class="fa fa-eye"></i>
    </a>
    @endcan
</td>
