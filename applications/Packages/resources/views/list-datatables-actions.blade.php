@php use Rezyon\Applications\Packages\Enums\AdminPermissionsEnum; @endphp
<div class="d-flex">
    @can(AdminPermissionsEnum::ADMIN_PACKAGE_SHOW->value)
        <a href="{{ route('packages.show', ['id' => $row->id]) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                    class="fas fa-eye"></i></a>
    @endcan
    @can(AdminPermissionsEnum::ADMIN_PACKAGE_UPDATE->value)
        <a href="{{ route('packages.edit', ['id' => $row->id]) }}" class="btn btn-primary shadow btn-xs sharp"><i
                    class="fas fa-pencil"></i></a>
    @endcan

</div>