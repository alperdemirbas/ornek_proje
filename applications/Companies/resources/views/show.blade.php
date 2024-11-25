@php use Rezyon\Applications\Companies\Enums\AdminPermissionsEnum; @endphp
@extends('layouts.admin')

@section('main-content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <h3 class="card-title m-4">@lang(trans('company.details'))</h3>
                <div class="card-header border-0 flex-wrap align-items-start pt-0">
                    <div class="col-md-8">
                        <div class="user d-sm-flex d-block pe-md-5 pe-0">
                            <div class="ms-sm-3 ms-0 me-md-5 md-0">
                                <h5 class="mb-1"><a href="javascript:void(0);"
                                                    class="text-dark">{{ $company->name }}</a></h5>
                                <div class="listline-wrapper mb-2">
                                    <span class="item"><i class="text-primary far fa-envelope"></i><a
                                                href="mailto:{{ $company->email }}">{{ $company->email }}</a></span>
                                    <span class="item"><i class="text-primary far fa-id-badge"></i>{{ trans('company.'.strtolower($company->type->value)) }}</span>
                                    <span class="item"><i class="text-primary fas fa-phone"></i><a
                                                href="tel:{{ phone($company->phone, $company->phone_country)->formatE164() }}">{{ phone($company->phone, $company->phone_country)->formatE164() }}</a></span>
                                    <span class="item"><i
                                                class='fa fa-circle me-1 text-{{ ($company->is_active) ? "success" : "danger" }}'></i>{{ trans('general.'.($company->is_active ? 'active' : 'inactive')) }}</span>
                                </div>
                                <p>{{ $company->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_PACKAGES->value)
            <div class="col-xl-12">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader collapse">
                        <div class="cpa">
                            <i class="fa-solid fa-cubes me-1"></i>@lang('package.list')
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt" style="display: none;">
                        <div class="card-body pb-4">
                            {{ $packages->table() }}
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                {!! $packages->scripts() !!}
            @endpush
        @endcan
        @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_USERS->value)
            <div class="col-xl-12">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader collapse">
                        <div class="cpa">
                            <i class="fa-solid fa-users me-1"></i>@lang('user.list')
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt" style="display: none;">
                        <div class="card-body pb-4">
                            {{ $users->table() }}
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                {!! $users->scripts() !!}
            @endpush
        @endcan
        @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_OFFICIALS->value)
            <div class="col-xl-12">
                <div class="filter cm-content-box box-primary">
                    <div class="content-title SlideToolHeader collapse">
                        <div class="cpa">
                            <i class="fa-solid fa-user-shield me-1"></i>@lang('company.officials')
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                        </div>
                    </div>
                    <div class="cm-content-body form excerpt" style="display: none;">
                        <div class="card-body pb-4">
                            {{ $officials->table() }}
                        </div>
                    </div>
                </div>
            </div>
            @push('scripts')
                {!! $officials->scripts() !!}
            @endpush
        @endcan
        @if($company->type === \Rezyon\Companies\Enums\CompanyTypeEnums::TOURISM_COMPANY)
            @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_CUSTOMERS->value)
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader collapse">
                            <div class="cpa">
                                <i class="fa-solid fa-arrows-down-to-people me-1"></i>@lang('user.customers')
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt" style="display: none;">
                            <div class="card-body pb-4">
                                {{ $customers->table() }}
                            </div>
                        </div>
                    </div>
                </div>
                @push('scripts')
                    {!! $customers->scripts() !!}
                @endpush
            @endcan
            @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_ACTIVITY_POOL->value)
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader collapse">
                            <div class="cpa">
                                <i class="fa-solid fa-basket-shopping me-1"></i>@lang('activity.activity_pool')
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt" style="display: none;">
                            <div class="card-body pb-4">
                                {{ $activityPool->table() }}
                            </div>
                        </div>
                    </div>
                </div>
                @push('scripts')
                    {!! $activityPool->scripts() !!}
                @endpush
            @endcan
        @else
            @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_ACTIVITIES->value)
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader collapse">
                            <div class="cpa">
                                <i class="fa-solid fa-cable-car me-1"></i>@lang('activity.list')
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt" style="display: none;">
                            <div class="card-body pb-4">
                                {{ $activities->table() }}
                            </div>
                        </div>
                    </div>
                </div>
                @push('scripts')
                    {!! $activities->scripts() !!}
                @endpush
            @endcan
            @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_SUPPLIER_CUSTOMERS->value)
                <div class="col-xl-12">
                    <div class="filter cm-content-box box-primary">
                        <div class="content-title SlideToolHeader collapse">
                            <div class="cpa">
                                <i class="fa-solid fa-arrows-down-to-people me-1"></i>@lang('user.customers')
                            </div>
                            <div class="tools">
                                <a href="javascript:void(0);" class="expand handle"><i
                                            class="fal fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div class="cm-content-body form excerpt" style="display: none;">
                            <div class="card-body pb-4">
                                {{ $supplierCustomers->table() }}
                            </div>
                        </div>
                    </div>
                </div>
                @push('scripts')
                    {!! $supplierCustomers->scripts() !!}
                @endpush
            @endcan
        @endif
        @can(AdminPermissionsEnum::ADMIN_COMPANY_SHOW_DOCUMENTS->value)
            <div class="col-xl-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader collapse">
                    <div class="cpa">
                        <i class="fa-solid fa-file-lines me-1"></i>@lang('company.documents')
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt" style="display: none;">
                    <div class="card-body pb-4">
                        <div class="row">
                            @foreach($company->documents as $file)
                                <div class="col-md-3">
                                    @php
                                        $url = Illuminate\Support\Facades\Storage::disk('s3')
                                        ->temporaryUrl(
                                            $file->name,
                                            now()->addMinutes(15)
                                        );
                                    @endphp
                                    <a
                                            href="{{ $url }}"
                                            class="fs-4 text-primary open-pdf"
                                            data-iframe="true"
                                            data-src="{{ $url }}"
                                    >
                                        <img class="img-fluid pdf-img" src="{{ asset('assets/images/icons/pdf.png') }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection

@push('styles')
    <link href="{{ asset('assets/vendor/lightgallery/css/lightgallery.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/lightgallery/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/datatable-init.js') }}"></script>
    <script>
        $('.open-pdf').lightGallery({
            selector: 'this',
        });
    </script>
@endpush