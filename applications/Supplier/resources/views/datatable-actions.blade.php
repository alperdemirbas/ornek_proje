<div class="d-flex">
    @can(\Rezyon\Applications\Supplier\Enums\PermissionsEnum::SUPPLIER_ACTIVITY_SHOW->value)
        <a href="{{ _route('supplier.activity.show', ['id' => $row->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                    class="fas fa-eye"></i></a>
    @endcan
    @can(\Rezyon\Applications\Supplier\Enums\PermissionsEnum::SUPPLIER_ACTIVITY_UPDATE->value)
        <a href="" class="btn btn-primary shadow btn-xs sharp"><i
                    class="fas fa-pencil"></i></a>
    @endcan
</div>