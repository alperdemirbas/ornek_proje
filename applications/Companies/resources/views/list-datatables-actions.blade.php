<div class="d-flex">
    <a href="{{ route('companies.show', ['id' => $row->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
    <a href="{{ route('companies.edit', ['id' => $row->id]) }}" class="btn btn-primary shadow btn-xs sharp"><i class="fas fa-pencil"></i></a>
</div>