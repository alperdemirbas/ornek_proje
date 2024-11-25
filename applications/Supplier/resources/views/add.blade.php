@extends('layouts.admin')
@section('title', trans('title.activity.add'))

@section('main-content')
    <div class="row">
        <div class="col-xl-12">
            <form id="addActivityForm" method="post" action="{{ _route('supplier.activity.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('general.category')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i
                                                class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt" >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="form-label d-block">{{__('general.category_type')}}</label>
                                            <select class="form-control select2" id="activity_category_types">
                                                <option value="">{{__('general.default')}}</option>
                                                @foreach($categoryTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label d-block">{{__('general.category')}}</label>
                                            <select class="form-control select2" id="activity_categories" name="activity_category_id">
                                                <option value="1">{{__('general.default')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card h-auto">
                            <div class="card-body">
                                <ul class="nav nav-pills justify-content-start mb-4">
                                    @foreach($lang as $item)
                                        <li class=" nav-item">
                                            <a href="#{{ $item['code'] }}" class="nav-link {{ $lang[0]['code'] == $item['code'] ? 'active' : '' }}" data-bs-toggle="tab" aria-expanded="false">{{ $item['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($lang as $item)
                                        <div id="{{ $item['code'] }}" class="tab-pane {{ $lang[0]['code'] == $item['code'] ? 'active' : '' }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">{{__('activity.name')}}</label>
                                                        <input type="text" class="form-control" name="name[{{ $item['code'] }}]">
                                                    </div>
                                                    <label class="form-label">{{__('activity.descrtiption')}}</label>
                                                    {{--<div id="editor_{{ $item['code'] }}"></div>--}}
                                                    <textarea name="description[{{ $item['code'] }}]" class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary" smooth-name="files">
                            <div class="cm-content-body form excerpt">
                                <div class="card-body">
                                    <h4>@lang('activity.images')</h4>
                                    <div class="image-uploader p-3" id="dragArea">
                                        <i class="fa-solid fa-cloud-arrow-up cloud-icon"></i>
                                        <h4>@lang('general.drag_drop.title')</h4>
                                        <p>
                                            @lang('general.drag_drop.select')
                                        </p>
                                        <input type="file" id="dragDrop" name="files[]" accept="image/*" multiple hidden/>

                                        <div class="image-preview" id="imagePreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">

                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    @lang('activity.location')
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>

                            <div class="cm-content-body form excerpt" id="city" smooth-name="city">
                                <div class="card-body row">

                                    <!-- Start : Şehir -->
                                    <div class="col-3">
                                        <label class="form-label">{{__('general.city')}}</label>
                                        <select required name="city" class="form-control mb-3 select2">
                                            <option>{{__('general.please_make_your_choice')}}</option>
                                        </select>
                                    </div>

                                    <!-- Start : İlçe -->
                                    <div class="col-3">
                                        <label class="form-label">{{__('general.district')}}</label>
                                        <select required name="district" class="form-control mb-3 select2">

                                        </select>
                                    </div>

                                    <!-- Start : Semt -->
                                    <div class="col-3">
                                        <label class="form-label">{{__('general.neighborhoods')}}</label>
                                        <select required name="neighborhood" class="form-control mb-3 select2">

                                        </select>
                                    </div>

                                    <!-- Start : Mahalle -->
                                    <div class="col-3">
                                        <label class="form-label">{{__('general.street')}}</label>
                                        <select required name="street" class="form-control mb-3 select2">

                                        </select>
                                    </div>

                                    <!-- Start : Adres Devamı -->
                                    <div class="col-12 mt-3">
                                        <label class="form-label">{{__('general.address_more')}}</label>
                                        <input type="text" name="detail" class="form-control mb-3">
                                    </div>

                                    <!-- Start : Adres Tarihi -->
                                    <div class="col-12">
                                        <label class="form-label">{{__('general.address_directions')}}</label>
                                        <input type="text" name="directions" class="form-control mb-3">
                                    </div>

                                    <!-- Start : Map Positions -->
                                    <div class="map-area">
                                        <div id="map"></div>
                                        <input hidden name="latitude" id="latitude">
                                        <input hidden name="longitude" id="longitude">
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="filter cm-content-box box-primary" smooth-name="session_type">
                            <div class="cm-content-body form excerpt">
                                <div class="card-body">
                                    <h4>{{__('supplier.session_type')}}</h4>
                                    <p>{{__('supplier.session_description')}}</p>
                                    <button type="button" class="btn btn-outline-primary" id="sessionBased">@lang('activity.session_based.title')</button>
                                    <button type="button" class="btn btn-outline-primary" id="dayBased">@lang('activity.day_based.title')</button>
                                </div>
                            </div>
                        </div>

                        <div class="filter cm-content-box box-primary d-none" id="sessions_section">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('general.sessions')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body form excerpt">
                                <div class="card-body">
                                    <h6 class="mb-4 font-w500">{{__('supplier.session_create')}}</h6>
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('supplier.session_start_time')}}</label>
                                            <input type="text" class="form-control time-picker" id="session_start_time">
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('supplier.session_end_time')}}</label>
                                            <input type="text" class="form-control time-picker" id="session_end_time">
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="mb-3">
                                                <label  class="form-label">{{__('activity.sessions_capacity')}}</label>
                                                <input type="number" class="form-control" id="session_capacity" value="1">
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('activity.sessions_days')}}</label>
                                            <select class="form-control default-select h-auto wide" id="session_days" placeholder="Gün(ler) Seçiniz" multiple>
                                                <option value="MONDAY">{{__('general.monday')}}</option>
                                                <option value="TUESDAY">{{__('general.tuesday')}}</option>
                                                <option value="WEDNESDAY">{{__('general.wednesday')}}</option>
                                                <option value="THURSDAY">{{__('general.thursday')}}</option>
                                                <option value="FRIDAY">{{__('general.friday')}}</option>
                                                <option value="SATURDAY">{{__('general.saturday')}}</option>
                                                <option value="SUNDAY">{{__('general.sunday')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="addSession" class="btn btn-primary btn-sm float-end mt-3 mt-sm-0">{{__('supplier.session_create')}}</button>
                                        </div>
                                    </div>
                                    <div id="sessions">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary d-none" id="activityStartEndTime">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('supplier.session_start_time')}} - {{__('supplier.session_end_time')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('general.start_time')}}</label>
                                            <input type="text" class="form-control time-picker" name="start_time">
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('general.end_time')}}</label>
                                            <input type="text" class="form-control time-picker" name="end_time">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary d-none" id="activityDuration">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('activity.duration.title')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('general.time')}}</label>
                                            <input type="number" class="form-control" name="duration[hours]" value="1">
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('general.minute')}}</label>
                                            <input type="number" class="form-control" name="duration[minutes]" value="30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('activity.activity_rules')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body form excerpt">
                                <div class="card-body">
                                    <h6 class="mb-4 font-w500">{{__('activity.new_create_rules')}}</h6>
                                    <div class="row mb-3">
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="mb-3">
                                                <label  class="form-label">{{__('activity.rules.title')}}</label>
                                                <select class="form-control default-select h-auto wide" id="price_rules_rule">
                                                    <option value="FREE">{{__('activity.rules.rule.free')}}</option>
                                                    <option value="DONT_ENTRY">{{__('activity.dont_entry')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <label  class="form-label">{{__('general.gender')}}</label>
                                            <select class="form-control default-select h-auto wide" id="price_rules_gender">
                                                <option value="ALL"{{__('general.all')}}></option>
                                                <option value="MALE">{{__('activity.rules.gender.female')}}</option>
                                                <option value="FEMALE">{{__('activity.rules.gender.male')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('general.age')}}</label>
                                            <input class="form-control" id="price_rules_age" min="0" max="100" type="number">
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('activity.age.entry.select')}}</label>
                                            <select class="form-control default-select h-auto wide" id="price_rules_operator">
                                                <option value="operator">{{__('activity.less_than')}}</option>
                                                <option value="BIGGER">{{__('activity.greater_than')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <label class="form-label">{{__('general.start_date')}} ({{__('general.optional')}})</label>
                                            <input type="text" class="form-control date-picker" id="price_rules_start_date">
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <label class="form-label"{{__('general.end_date')}}> ({{__('general.optional')}})</label>
                                            <input type="text" class="form-control date-picker" id="price_rules_end_date">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="addRule" class="btn btn-primary btn-sm float-end my-3 mt-sm-0">{{__('activity.new_create_rules')}}</button>
                                        </div>
                                    </div>
                                    <div id="rules">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('activity.price.title')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt" smooth-name="price">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label class="form-label d-block">{{__('general.currency')}}</label>
                                            <select class="form-control default-select" name="price_currency">
                                                @foreach($currencies as $currency)
                                                    <option value="{{ $currency->name }}">{{ $currency->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">{{__('general.type')}}</label>
                                            <select class="form-control default-select price-type" id="pricing_type">
                                                <option value="ALL">{{__('general.type')}}</option>
                                                <option value="WEEKEND">{{__('activity.prices.weekend')}}</option>
                                                <option value="WEEK">{{__('activity.prices.week')}}</option>
                                                <option value="SPECIAL_DAY">{{__('activity.prices.special_day')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">{{__('general.sale_price')}}</label>
                                            <input type="text" class="form-control priceMask" id="pricing_price">
                                        </div>
                                    </div>
                                    <div class="row d-none special_day_content">
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">{{__('general.start_date')}}</label>
                                            <input type="text" class="form-control date-picker" id="pricing_start_date">
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">{{__('general.end_date')}}</label>
                                            <input type="text" class="form-control date-picker" id="pricing_end_date">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="addPrice" class="btn btn-primary btn-sm float-end my-3">{{__('activity.price.add')}}</button>
                                        </div>
                                    </div>
                                    <div id="prices">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('activity.closed.day.title')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('activity.closed.day.title')}}</label>
                                            <select class="form-control default-select h-auto wide" name="closed_days[]" placeholder="Gün(ler) Seçiniz" multiple>
                                                <option value="1">{{__('general.monday')}}</option>
                                                <option value="2">{{__('general.tuesday')}}</option>
                                                <option value="3">{{__('general.wednesday')}}</option>
                                                <option value="4">{{__('general.thursday')}}</option>
                                                <option value="5">{{__('general.friday')}}</option>
                                                <option value="6">{{__('general.saturday')}}</option>
                                                <option value="7">{{__('general.sunday')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {{__('activity.private.day')}}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-12 mb-3">
                                            <label class="form-label">{{__('general.start_date')}}</label>
                                            <input type="text" class="form-control date-picker" id="private_days_start_date">
                                        </div>
                                        <div class="col-lg-4 col-12 mb-3">
                                            <label class="form-label">{{__('general.finish_date')}}</label>
                                            <input type="text" class="form-control date-picker" id="private_days_end_date">
                                        </div>
                                        <div class="col-lg-4 col-12 m-auto">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" class="form-check-input" id="private_days_is_closed">
                                                <label class="form-check-label" for="private_days_is_closed">{{__('activity.private.day.closed_today')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="addPrivateDays" class="btn btn-primary btn-sm float-end my-3">
                                                {{__('activity.add.private.day')}}
                                            </button>
                                        </div>
                                    </div>
                                    <div id="privateDays">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {!! trans('activity.cancellation.rule.title') !!}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('general.hour')</label>
                                            <input type="number" class="form-control" id="cancellation_rules_hour">
                                            <p>@lang('activity.cancellation.rule.hour.desc')</p>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('activity.cancellation.rule.discount.rate.title')</label>
                                            <input type="number" class="form-control" id="cancellation_rules_discount">
                                            <p>@lang('activity.cancellation.rule.discount.rate.desc')</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="addCancellationRule" class="btn btn-primary btn-sm float-end my-3">
                                                @lang('activity.cancellation.rule.add')
                                            </button>
                                        </div>
                                    </div>
                                    <div id="cancellationRules">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter cm-content-box box-primary">
                            <div class="content-title SlideToolHeader">
                                <div class="cpa">
                                    {!! trans('activity.extra.title') !!}
                                </div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div class="cm-content-body publish-content form excerpt">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">@lang('general.type')</label>
                                            <select class="form-control default-select price-type" id="extras_type">
                                                <option value="include_price">@lang('activity.extra.include.price')</option>
                                                <option value="not_include_price">@lang('activity.extra.not.include.price')</option>
                                                <option value="advice">@lang('activity.extra.advice')</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('general.description')</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="extras_description" placeholder="@lang('activity.extra.example')">
                                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#extras_desc_translatable" data-bs-default><i class="fa-solid fa-pen-to-square me-1"></i>@lang('general.translate')</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="addExtras" class="btn btn-primary btn-sm float-end my-3">
                                                @lang('activity.extra.add.button')
                                            </button>
                                        </div>
                                    </div>
                                    <div id="extras">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="addActivity" class="btn btn-success float-end mb-3">{{__('general.save')}}</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="extras_desc_translatable" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('general.translate')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach(config('app.available_locales') as $locale)
                            <div class="mb-3 col-md-6">
                                <label class="form-label">@lang("general.".$locale['name'])</label>
                                <input type="text" class="form-control" data-lang="{{ $locale['key'] }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('assets/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/drag-drop-image/drag-drop-image.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/featherlight/featherlight.css') }}" rel="stylesheet">
@endpush

@push('scripts')

    <script src="{{ asset('assets/vendor/featherlight/featherlight.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/drag-drop-image/drag-drop-image.js') }}"></script>

    <!-- ck-editor -->
    <script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ asset('assets/vendor/imask/imask.min.js') }}"></script>
    <!-- prettier-ignore -->
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyB4zSvwyAIFmQMfpstL3Ge-CNxBdQeMFXk", v: "weekly"});</script>
    <!-- Google Maps Initialize-->
    <script src="{{ asset('assets/js/map.js') }}"></script>

    <script>
        const available_languages = JSON.parse('@JSON(config('app.available_locales'))');
        const app_locale = '{{ app()->getLocale() }}';

        $('#extras_desc_translatable').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let value = button.prev('input').val();
            const extra = button.closest('.extras');
            let modalBodyInput = $('#extras_desc_translatable .modal-body input[data-lang="'+app_locale+'"]');
            modalBodyInput.val(value);
            if(extra.length > 0 && button) {
                console.log(button);
                $.each(available_languages, function (key, value) {
                    $(`[data-lang="${value.key}"]`).val(extra.find(`input[data-id="${value.key}"]`).val())
                })
            }

            $('input[data-lang]').change(function() {
                extra.find(`input[data-id="${$(this).data('lang')}"]`).val($(this).val())
            })

            modalBodyInput.val(value);
        });

        $(document).on('change', 'input[data-default]', function() {
            $(this).closest('.extras').find(`input[data-id="${app_locale}"]`).val($(this).val())
        })


        let locationNotFoundText = "@lang('general.location_not_found')";
        let okText = "@lang('general.ok')";

        $(document).ready(function () {
            dateTimeInit();
            $('#addActivity').click(function() {
                $('#addActivityForm').submit();
            })

            $('#activity_category_types').change(function () {
                const id = $(this).val();
                if(!id){
                    $('#activity_categories').html(`
                        <option>{{__('general.select_category')}}</option>
                    `)
                    return true;
                }
                $.get('{{ _route('supplier.categories.list') }}', {
                        _token: csrf,
                        id: id
                    },
                    function (response) {

                        let html = '<option value="" selected>{{__('general.select_category')}}</option>';
                        for(let k of response){

                            const name =  k.name[lang] ?? k.name["tr"];
                            html += `<option value='${k.id}'>${name}</option>`;
                        }

                        $('#activity_categories').html(html);
                    });
            })


            $('#sessionBased').click(function () {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $('#dayBased').addClass('btn-outline-primary').removeClass('btn-primary')
                $('#sessions_section').removeClass('d-none', 1000, "easeOutBounce");
                $('#activityStartEndTime').addClass('d-none');
                $('#activityDuration').addClass('d-none');
            })

            $('#dayBased').click(function () {
                $(this).removeClass('btn-outline-primary').addClass('btn-primary')
                $('#sessionBased').addClass('btn-outline-primary').removeClass('btn-primary')
                $('#sessions_section').addClass('d-none');
                $('#activityStartEndTime').removeClass('d-none', 1000, "easeOutBounce");
                $('#activityDuration').removeClass('d-none', 1000, "easeOutBounce");
            })
        });

        !(function () {
            let i = 0;
            let k = 0;
            let j = 0;
            let z = 0;
            let v = 0;
            let g = 0;

            const sessionsInit =  function() {
                $(document).on('click', '[data-action="deleteSession"]', function() {
                    $(this).closest('.session').remove()
                });

                $('#addSession').click(function () {
                    let startTime = $('#session_start_time');
                    let endTime = $('#session_end_time');

                    let days = [];
                    $('#session_days option:selected').each(function () {
                        days.push($(this).text());
                    });

                    let capacity = $('#session_capacity');

                    if (!startTime || !endTime || days.length === 0 || !capacity) {
                        _Swal({
                            title: '{{__('general.error')}}',
                            text: '{{__('general.valid_sessions')}}',
                            icon: 'error',
                            confirmButtonText: "{{__('general.ok')}}"
                        })
                        return false;
                    }

                    let sessionHtml = `<div class="session">
                        <div class="card my-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-sm-6 mb-3">
                                        <label class="form-label">{{__('general.start_time')}}</label>
                                        <input type="text" class="form-control time-picker" name="sessions[${k}][start_time]" value="${startTime.val()}">
                                    </div>
                                    <div class="col-xl-6 col-sm-6 mb-3">
                                        <label class="form-label">Bitiş Saati</label>
                                        <input type="text" class="form-control time-picker" name="sessions[${k}][end_time]" value="${endTime.val()}">
                                    </div>
                                    <div class="col-xl-6 col-sm-6">
                                        <div class="mb-3">
                                            <label  class="form-label">Kapasite</label>
                                            <input type="number" class="form-control" name="sessions[${k}][capacity]" value="${capacity.val()}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-sm-6 mb-3">
                                        <label class="form-label">Günler</label>
                                        <select class="form-control default-select h-auto wide" name="sessions[${k}][days][]" placeholder="{{__('general.select.day')}}" multiple>
                                            <option value="MONDAY" ${(days.includes('Pazartesi') ? 'selected' : '')}>{{__('general.monday')}}</option>
                                            <option value="TUESDAY" ${(days.includes('Salı') ? 'selected' : '')}>{{__('general.tuesday')}}</option>
                                            <option value="WEDNESDAY" ${(days.includes('Çarşamba') ? 'selected' : '')}>{{__('general.wednesday')}}</option>
                                            <option value="THURSDAY" ${(days.includes('Perşembe') ? 'selected' : '')}>{{__('general.thursday')}}</option>
                                            <option value="FRIDAY" ${(days.includes('Cuma') ? 'selected' : '')}>{{_('general.friday')}}</option>
                                            <option value="SATURDAY" ${(days.includes('Cumartesi') ? 'selected' : '')}>{{__('general.saturday')}}</option>
                                            <option value="SUNDAY" ${(days.includes('Pazar') ? 'selected' : '')}>{{__('general.sunday')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteSession">{{__('general.delete')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                    $('#sessions').append(sessionHtml);

                    // Eklendikten sonra inputları temizle
                    startTime.val('');
                    endTime.val('');
                    $('#session_days').selectpicker("deselectAll");
                    capacity.val('1');

                    dateTimeInit();

                    k++;
                })
            };
            const rulesInit =  function () {
                $(document).on('click', '[data-action="deleteRule"]', function() {
                    $(this).closest('.rule').remove()
                });

                $('#addRule').click(function () {

                    let rule = $('#price_rules_rule');
                    let gender = $('#price_rules_gender');
                    let age = $('#price_rules_age');
                    let operator = $('#price_rules_operator');
                    let startDate = $('#price_rules_start_date');
                    let endDate = $('#price_rules_end_date');

                    if (!rule || !gender || !age || !operator || !startDate || !endDate) {
                        _Swal({
                            title: '{{__('general.error')}}',
                            text: '{{__('activity.role_require')}}',
                            icon: 'error',
                            confirmButtonText: "{{__('general.ok') }}"
                        })
                        return false;
                    }

                    const ruleHtml = `
                        <div class="rule">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="mb-3">
                                                <label  class="form-label">{{__('general.rules.text')}}</label>
                                                <select class="form-control default-select h-auto wide" name="price_rules[${i}][rule]">
                                                    <option value="FREE" ${rule.val() === "FREE" ? 'selected' : ''}>Ücretsiz</option>
                                                    <option value="DONT_ENTRY" ${rule.val() === "DONT_ENTRY" ? 'selected' : ''}>Giriş Yapamaz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <label  class="form-label">Cinsiyet</label>
                                            <select class="form-control default-select h-auto wide" name="price_rules[${i}][gender]">
                                                <option value="ALL" ${gender.val() === "ALL" ? 'selected' : ''}>{{__('general.all')}}</option>
                                                <option value="MALE" ${gender.val() === "MALE" ? 'selected' : ''}>{{__('activity.rules.gender.female')}}</option>
                                                <option value="FEMALE" ${gender.val() === "FEMALE" ? 'selected' : ''}>{{__('activity.rules.gender.male')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">Yaş</label>
                                            <input class="form-control" name="price_rules[${i}][age]" value="${age.val()}" min="0" max="100" type="number">
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">Yaş Operatörü</label>
                                            <select class="form-control default-select h-auto wide" name="price_rules[${i}][operator]">
                                                <option value="LOWER" ${operator.val() === "LOWER" ? 'selected' : ''}>{{__('activity.less_than')}}</option>
                                                <option value="BIGGER" ${operator.val() === "BIGGER" ? 'selected' : ''}>{{__('activity.greater_than')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('general.start_date')}} ({{__('general.optional')}})</label>
                                            <input type="text" class="form-control date-picker" name="price_rules[${i}][start_date]" value="${startDate.val()}">
                                        </div>
                                        <div class="col-xl-6 col-sm-6 mb-3">
                                            <label class="form-label">{{__('general.end_date')}} ({{__('general.optional')}})</label>
                                            <input type="text" class="form-control date-picker" name="price_rules[${i}][end_date]" value="${endDate.val()}">
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteRule">{{__('general.delete')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#rules').append(ruleHtml);

                    rule.val('')
                    gender.val('')
                    age.val('')
                    operator.val('')
                    startDate.val('')
                    endDate.val('')

                    dateTimeInit();

                    i++;
                })
            };
            const pricingInit =  function () {
                $(document).on('click', '[data-action="deletePricing"]', function() {
                    $(this).closest('.pricing').remove()
                });

                $('.price-type').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                    if($(this).val() === "SPECIAL_DAY") {
                        $('.special_day_content').removeClass('d-none');
                    } else {
                        $('.special_day_content').addClass('d-none');
                    }
                });

                $('#addPrice').click(function() {

                    let pricing_type = $('#pricing_type');
                    let pricing_price = $('#pricing_price');
                    let pricing_start_date = $('#pricing_start_date');
                    let pricing_end_date = $('#pricing_end_date');

                    console.log(pricing_type.val())
                    const priceHtml = `
                        <div class="pricing">
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">Fiyat</label>
                                            <select class="form-control default-select price-type" name="price[${j}][type]">
                                                <option value="ALL" ${pricing_type.val() === "ALL" ? 'selected' : ''}>{{__('general.all')}}</option>
                                                <option value="WEEKEND" ${pricing_type.val() === "WEEKEND" ? 'selected' : ''}>{{__('activity.prices.weekend')}}</option>
                                                <option value="WEEK" ${pricing_type.val() === "WEEK" ? 'selected' : ''}>{{__('activity.prices.week')}}</option>
                                                <option value="SPECIAL_DAY" ${pricing_type.val() === "SPECIAL_DAY" ? 'selected' : ''}>{{__('activity.prices.special_day')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">{{__('general.price')}}</label>
                                            <input type="text" class="form-control priceMask" name="price[${j}][price]" value="${pricing_price.val()}">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="special_day_content" class="row ${pricing_type.val() !== "SPECIAL_DAY" ? 'd-none' : ''}">
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">{{__('general.start_date')}}</label>
                                            <input type="text" class="form-control date-picker" name="price[${j}][start_date]" value="${pricing_start_date.val()}">
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">{{__('general.end_date')}}</label>
                                            <input type="text" class="form-control date-picker" name="price[${j}][end_date]" value="${pricing_end_date.val()}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm float-end mt-3" data-action="deletePricing">{{__('general.delete')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#prices').append(priceHtml);

                    pricing_type.selectpicker('deselectAll');
                    pricing_price.val('');
                    pricing_start_date.val('');
                    pricing_end_date.val('');

                    dateTimeInit();

                    j++;
                })
            };
            const privateDays = function() {
                $(document).on('click', '[data-action="deletePrivateDays"]', function() {
                    $(this).closest('.privateDays').remove()
                });

                $('#addPrivateDays').click(function() {

                    let start_date = $('#private_days_start_date');
                    let end_date = $('#private_days_end_date');
                    let is_closed = $('#private_days_is_closed');

                    const privateDaysHtml = `
                        <div class="privateDays">
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">{{__('general.start_date')}}</label>
                                            <input type="text" class="form-control date-picker" name="private_days[${g}][start_date]" value="${start_date.val()}">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">{{__('general.end_date')}}</label>
                                            <input type="text" class="form-control date-picker" name="private_days[${g}][end_date]" value="${end_date.val()}">
                                        </div>
                                        <div class="col-lg-4 col-12 mb-3">
                                            <div class="form-check custom-checkbox">
                                                <input type="checkbox" class="form-check-input" name="private_days[${g}][is_closed]" value="${is_closed.prop('checked')}" ${is_closed.prop('checked') ? 'checked' : null}>
                                                <label class="form-check-label">{{__('activity.private.day.closed_today')}}</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm float-end" data-action="deletePrivateDays">@lang('general.delete')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#privateDays').append(privateDaysHtml);

                    start_date.val('');
                    end_date.val('');
                    is_closed.prop('checked', false);

                    dateTimeInit();

                    g++;
                })
            };
            const cancellationRules = function() {
                $(document).on('click', '[data-action="deleteCancellationRules"]', function() {
                    $(this).closest('.cancellationRules').remove()
                });

                $('#addCancellationRule').click(function(e) {

                    let hour = $('#cancellation_rules_hour');
                    let discount =$('#cancellation_rules_discount');

                    if(hour.val().length === 0 || discount.val().length === 0) {
                        e.preventDefault();
                        _Swal({
                            title: '@lang('general.error')',
                            text: '@lang('general.error_fill_blanks')',
                            confirmButtonText: '@lang('general.ok')'
                        })
                        return false;
                    }

                    const cancellationRulesHtml = `
                        <div class="cancellationRules">
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('general.hour')</label>
                                            <input type="number" class="form-control" name="cancellation_rules[${z}][hour]" value="${hour.val()}">
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('activity.cancellation.rule.discount.rate.title')</label>
                                            <input type="number" class="form-control" name="cancellation_rules[${z}][discount_rate]" value="${discount.val()}">
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteCancellationRules">@lang('general.delete')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#cancellationRules').append(cancellationRulesHtml);

                    hour.val('');
                    discount.val('');
                    z++;
                })
            };
            const extras = function() {
                $(document).on('click', '[data-action="deleteExtras"]', function() {
                    $(this).closest('.extras').remove()
                });

                $('#addExtras').click(function(e) {

                    let type = $('#extras_type');
                    let description = $('#extras_description');

                    if(description.val().length === 0) {
                        e.preventDefault();
                        _Swal({
                            title: '@lang('general.error')',
                            text: '@lang('general.error_fill_blanks')',
                            confirmButtonText: '@lang('general.ok')'
                        })
                        return false;
                    }

                    const extrasHtml = `
                        <div class="extras">
                            <div class="card my-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 mb-3">
                                            <label class="form-label d-block">Tür</label>
                                            <select class="form-control default-select price-type" name="extras[${v}][type]">
                                                <option value="include_price" ${type.val() === 'include_price' ? 'selected' : null}>@lang('activity.extra.include.price')</option>
                                                <option value="not_include_price" ${type.val() === 'not_include_price' ? 'selected' : null}>@lang('activity.extra.not.include.price')</option>
                                                <option value="advice" ${type.val() === 'advice' ? 'selected' : null}>@lang('activity.extra.advice')</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-3">
                                            <label class="form-label">@lang('general.description')</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="extras[${v}][description][${app_locale}]" data-default value="${description.val()}">
                                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#extras_desc_translatable" data-bs-default><i class="fa-solid fa-pen-to-square me-1"></i>@lang('general.translate')</button>
                                            </div>
                                            @foreach(config('app.available_locales') as $locale)
                                            <input type="hidden" class="form-control" name="extras[${v}][description][{{ $locale['key'] }}]" data-id="{{ $locale['key'] }}" value="${$('[data-lang="{{ $locale['key'] }}"]').val()}">
                                            @endforeach
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-danger btn-sm float-end" data-action="deleteExtras">@lang('general.delete')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('#extras').append(extrasHtml);

                    type.val('');
                    description.val('');
                    $('#extras_desc_translatable .modal-body input').val('');
                    v++;
                })
            };

            sessionsInit();
            rulesInit();
            pricingInit();
            privateDays();
            cancellationRules();
            extras();
        })();

        // Locations List
        !(()=>{
            let city_id;
            let districtList;
            let district_id;

            const options = {
                method: 'GET',
            };

            fetch('/locations', options)
            .then(response => response.json())
            .then(body => {
                $.each(body,(index,value)=>{
                    $("[name='city']").append(`<option value=${value.id}>${value.city_name}</option>`);
                })
            });

            // Seçim yapılan şehrin semtlerini listeler.
            $(document).on('change',"[name='city']",(e)=>{
                $("[name='district'], [name='neighborhood'], [name='street'] ").empty();
                $("[name='district']").empty().append(`<option>{{__('general.loading')}}</option>`);
                city_id = $("[name='city']").select2("val");
                fetch('/locations?sort=+id&filter[id]='+city_id+'&include=district.neighborhood', options)
                .then(response => response.json())
                .then(body => {
                    $("select[name='district']").empty().append(`<option>{{__('general.please_select')}}</option>`);
                    $.each(body,(index,value)=>{
                        districtList = value.district;
                        $.each(districtList,(districtIndex,districtValue)=>{
                            $("[name='district']").append(`<option value=${districtValue.id}>${districtValue.district_name}</option>`);
                        });
                    });
                });
            });

            // Seçilen ilçenin mahallelenin listeler
            $(document).on('change',"[name='district']",(e)=>{
                $("[name='neighborhood']").empty().append(`<option>{{__('general.loading')}}</option>`);
                $("[name='neighborhood'], [name='street'] ").empty().append(`<option>{{__('general.please_select')}}</option>`);
                district_id = $("[name='district']").select2("val");
                $.each(districtList,(index,value)=>{
                    if(value.id==district_id){
                        $.each(value.neighborhood,(i,v)=>{
                            $("[name='neighborhood']").append(`<option value=${v.id}>${v.neighborhood_name}</option>`);
                        });
                    }
                })

                $(document).on('change',"[name='neighborhood']",(e)=>{
                    $("select[name='street']").empty().append(`<option>{{__('general.loading')}}</option>`);
                    neighborhood_id = $("[name='neighborhood']").select2("val");
                    fetch('/locations/'+neighborhood_id+'/street?sort=+street_name', options)
                    .then(response => response.json())
                    .then(body => {
                        $("select[name='street']").empty().append(`<option>{{__('general.please_select')}}</option>`);
                        $("[name='neighborhood']").append(`<option>{{__('general.please_select')}}</option>`);
                        $.each(body,(index,value)=>{
                            $("[name='street']").append(`<option value=${value.id}>${value.street_name}</option>`);
                        });
                    });
                });
            });
        })();
    </script>
@endpush