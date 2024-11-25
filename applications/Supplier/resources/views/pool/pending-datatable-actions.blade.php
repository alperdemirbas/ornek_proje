<div class="d-flex">
    @can(\Rezyon\Applications\Supplier\Enums\PermissionsEnum::SUPPLIER_ACTIVITY_POOL_PENDING_SHOW->value)
        <a href="{{ _route('supplier.activity.pool.pending.show', ['id' => $id]) }}" class="btn btn-primary shadow btn-sm sharp me-1"><i
                    class="fas fa-eye me-1"></i>İncele</a>
    @endcan
</div>