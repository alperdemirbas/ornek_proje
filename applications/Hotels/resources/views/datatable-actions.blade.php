@php use Rezyon\Applications\Hotels\Enums\AdminPermissionEnums; @endphp
<div class="d-flex">
        @can(AdminPermissionEnums::ADMIN_HOTELS_UPDATE->value)
        <a href="{{ route('hotels.edit', ['hotel' => $id]) }}" class="btn btn-primary shadow btn-xs sharp"><i
                    class="fas fa-pencil"></i></a>
        @endcan
</div>