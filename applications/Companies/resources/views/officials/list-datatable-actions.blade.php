@php use Rezyon\Applications\Companies\Enums\AdminPermissionsEnum; @endphp
<div class="d-flex text-right float-end">

    @can(AdminPermissionsEnum::ADMIN_OFFICIALS_EDIT->value)
        <a href="{{ route('applications.companies.official.edit', ['id' => $id]) }}"
           class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil"></i></a>
    @endcan

    @can(AdminPermissionsEnum::ADMIN_OFFICIALS_DELETE->value)
        <a data-bs-toggle="modal" data-bs-target="#official_destroy"
           data-id="{{$id}}"
           class="btn btn-outline-primary shadow btn-xs sharp me-1" data-role="destroy"><i class="fas fa-trash"></i></a>
    @endcan
</div>