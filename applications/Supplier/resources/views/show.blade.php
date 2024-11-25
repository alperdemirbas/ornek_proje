@extends('layouts.admin')
@section('title', trans('title.activity.detail'))

@section('main-content')
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if($activity->companies_id === auth()->user()->companies_id)
                        <div class="col-12">
                            @if($activity->status === \Rezyon\Supplier\Enums\ActivityStatusEnum::REJECTED)
                            <div class="alert alert-danger left-icon-big alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                </button>
                                <div class="media">
                                    <div class="alert-left-icon-big">
                                        <span><i class="fa-solid fa-triangle-exclamation"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-1 mb-2">@lang('activity.rejected.title')</h5>
                                        <p class="mb-0">@lang('activity.rejected.text', ['reason' => $activity->rejected_reason])</p>
                                    </div>
                                </div>
                            </div>
                            @elseif($activity->status === \Rezyon\Supplier\Enums\ActivityStatusEnum::INACTIVE)
                                <div class="alert alert-warning left-icon-big alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                    </button>
                                    <div class="media">
                                        <div class="alert-left-icon-big">
                                            <span><i class="fa-solid fa-circle-question"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-1 mb-2">@lang('activity.inactive.title')</h5>
                                            <p class="mb-0">@lang('activity.inactive.text')</p>
                                        </div>
                                    </div>
                                </div>
                            @elseif($activity->status === \Rezyon\Supplier\Enums\ActivityStatusEnum::WAITING)
                                <div class="alert alert-danger left-icon-big alert-dismissible fade show">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i class="mdi mdi-btn-close"></i></span>
                                    </button>
                                    <div class="media">
                                        <div class="alert-left-icon-big">
                                            <span><i class="fa-solid fa-triangle-exclamation"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-1 mb-2">@lang('activity.waiting.title')</h5>
                                            <p class="mb-0">@lang('activity.waiting.text')</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @endif
                        <div class="col-12 col-lg-4">
                            <!-- Tab panes -->
                            <div class="tab-content" id="nav-tabContent">
                                @foreach($activity->images as $image)
                                    <div class="tab-pane fade @if($image->order === 0) show active @endif" id="nav{{ $image->id }}" role="tabpanel" aria-labelledby="navTab{{ $image->id }}">
                                        <img class="img-fluid rounded" src="{{ $image->path }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                            <nav>
                                <div class="product-detail-tab nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($activity->images as $image)
                                        <button class="nav-link @if($image->order === 0) active @endif" id="navTab{{ $image->id }}" data-bs-toggle="tab" data-bs-target="#nav{{ $image->id }}" type="button" role="tab" aria-controls="nav{{ $image->id }}" aria-selected="true">
                                            <img class="img-fluid  rounded" src="{{ $image->path }}" alt="" width="100">
                                        </button>
                                    @endforeach
                                </div>
                            </nav>
                        </div>
                        <!--Tab slider End-->
                        <div class="col-12 col-lg-8">
                            <div class="product-detail-content mt-5">
                                <!--Product details-->
                                <div class="new-arrival-content pr">
                                    <div class="row border-bottom mb-3 pb-3 w-100">
                                        <div class="col-12 col-lg-6">
                                            <h4>{{ $activity->name }}</h4>
                                            <span class="badge badge-primary light mb-3"><i class="{{ $activity->category->icon }}"></i> {{ $activity->category->name }}</span>
                                            <div class="comment-review star-rating d-flex">
                                                <ul class="mb-2">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span class="review-text ms-2">/ (<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#reviews">@lang('activity.comments', ['comments' => 34])</a>)</span>
                                            </div>
                                            <p class="text-content mb-3">{{ $activity->description }}</p>
                                        </div>
                                        @if(auth()->user()->company->type === \Rezyon\Companies\Enums\CompanyTypeEnums::TOURISM_COMPANY)
                                        <div class="col-12 col-lg-6">
                                            <div class="card float-end justify-content-end shadow-none w-100 border-0">
                                                <div class="card-body d-grid justify-content-lg-center p-0 p-lg-3 text-lg-center">
                                                    <p class="price float-start d-block" id="allPrice"></p>
                                                    <div class="accordion accordion-primary" id="accordion-one">
                                                        <div class="accordion-item mb-1">
                                                            <a href="javascript:void(0)" class="text-primary" data-bs-toggle="collapse" data-bs-target="#default-collapseOne" aria-expanded="true" aria-controls="default-collapseOne">
                                                                @lang('activity.show_all_prices')
                                                            </a>

                                                            <div id="default-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordion-one">
                                                                <div class="accordion-body p-0 py-2">
                                                                    <ul>
                                                                        @foreach($activity->prices as $price)
                                                                            @if($price->type !== "ALL")
                                                                                <li>
                                                                                    <strong>@lang("general.".strtolower($price->type)):</strong>
                                                                                    {{ $price->price }}
                                                                                    {{ $activity->currency }}
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span>@lang('activity.total_excluding_taxes')</span>
                                                    <div class="shopping-cart my-2">
                                                        <a class="btn btn-primary" href="javascript:void();" data-bs-toggle="modal" data-bs-target="#addToPool">
                                                            <i class="fa fa-shopping-basket me-2"></i>
                                                            @lang('activity.add_pool_button')
                                                        </a>
                                                    </div>
                                                    <span>@lang('activity.add_pool_desc')</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row border-bottom mb-3 pb-3 w-100">
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <h6>@lang('activity.author'): {{ $activity->company->name }}</h6>
                                                <span>@lang('activity.more_supply', ['count' => 5])</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row border-bottom mb-3 pb-3 w-100">
                                        <div class="col-12">
                                            <div class="d-flex">
                                                <i class="fa-regular fa-circle my-auto me-3 fs-3"></i>
                                                <div class="d-grid my-auto">
                                                    <h6 class="m-0">@lang('activity.duration.title'): @lang('activity.duration.text', ['hours' => $activity->duration['hours'], 'minutes' => $activity->duration['minutes']])</h6>
                                                    <span>@lang('activity.duration.desc')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($activity->sessions) === 0)
                                        <div class="row border-bottom mb-3 pb-3 w-100">
                                            <div class="col-12 d-flex">
                                                <div class="d-flex me-5">
                                                    <i class="fa-regular fa-circle my-auto me-3 fs-3"></i>
                                                    <div class="d-grid my-auto">
                                                        <h6 class="m-0">@lang('activity.opening_time'): {{ $activity->start_time->format('H:i') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <i class="fa-regular fa-circle my-auto me-3 fs-3"></i>
                                                    <div class="d-grid my-auto">
                                                        <h6 class="m-0">@lang('activity.closing_time'): {{ $activity->end_time->format('H:i') }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border-bottom mb-3 pb-3 w-100">
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <i class="fa-regular fa-circle my-auto me-3 fs-3"></i>
                                                    <div class="d-grid my-auto">
                                                        <h6 class="m-0">@lang('activity.day_based.title')</h6>
                                                        <span>@lang('activity.day_based.desc')</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row border-bottom mb-3 pb-3 w-100">
                                            <div class="col-12">
                                                <div class="d-flex">
                                                    <i class="fa-regular fa-circle my-auto me-3 fs-3"></i>
                                                    <div class="d-grid my-auto">
                                                        <h6 class="m-0">@lang('activity.session_based.title')</h6>
                                                        <span>@lang('activity.session_based.desc')</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row border-bottom mb-3 pb-3 w-100">
                                                <div class="col-12">
                                                    <h4>@lang('activity.sessions.title'):</h4>
                                                    <div class="row">
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        @foreach($activity->sessions as $session)
                                                            <div class="col-6 col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <ul>
                                                                            <li>
                                                                                <strong>@lang('activity.sessions.start_time'):</strong>
                                                                                {{ $session->start_time->format('H:i') }}
                                                                            </li>
                                                                            <li>
                                                                                <strong>@lang('activity.sessions.end_time'):</strong>
                                                                                {{ $session->end_time->format('H:i') }}
                                                                            </li>
                                                                            <li>
                                                                                <strong>@lang('activity.sessions.capacity'):</strong>
                                                                                {{ $session->capacity }}
                                                                            </li>
                                                                            <li>
                                                                                <strong>@lang('activity.sessions.days'):</strong>
                                                                                {{ $session->day }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php
                                                                if($i === 2) {
                                                                    break;
                                                                } else {
                                                                    $i++;
                                                                }
                                                            @endphp
                                                        @endforeach
                                                        <div class="col-12">
                                                            <button class="btn btn-primary btn-sm m-auto h-100 w-auto" data-bs-toggle="modal" data-bs-target="#activitySessions">@lang('general.show_more')</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                    <div class="row border-bottom mb-3 pb-3 w-100">
                                        <div class="col-12">
                                            <h4>@lang('activity.rules.title'):</h4>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="flex-list mb-3">
                                                        <ul>
                                                            @php
                                                                $i = 0;
                                                            @endphp
                                                            @foreach($activity->rules as $rule)
                                                                <li class="d-flex m-auto"><i class="fa-regular fa-circle my-auto me-3"></i>{{ __("activity.rules.age", ["age" => $rule->age]) }} {{ __("activity.rules.operator.".strtolower($rule->operator)) }} {{ $rule->gender !== "ALL" ? __("activity.rules.gender.".strtolower($rule->gender)) : '' }} {{ __("activity.rules.rule.".strtolower($rule->rule)) }}</li>
                                                                @php
                                                                    if($i === 3) {
                                                                        break;
                                                                    } else {
                                                                        $i++;
                                                                    }
                                                                @endphp
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-sm w-auto" data-bs-toggle="modal" data-bs-target="#activityRules">@lang('general.show_more')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row border-bottom mb-3 pb-3 w-100">
                                        <div class="col-12">
                                            <h4>@lang('activity.cancellation_conditions'):</h4>
                                            <div class="row">
                                                <div class="flex-list">
                                                    <ul>
                                                        @foreach($activity->cancellationConditions as $condition)
                                                            <li class="d-flex m-auto"><i class="fa-regular fa-circle my-auto me-3"></i>@lang('activity.cancellation.conditions', ['hour' => $condition->hour, 'discount' => $condition->discount_rate])</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">@lang('activity.supplier_more_activities')</h4>
                    <div class="owl-carousel card-slider">
                        @foreach($activity->company->activities as $item)
                            <div class="items">
                                <div class="card">
                                    <div class="card-body product-grid-card">
                                        <a href="{{ _route('supplier.activity.show', ['id' => $item->id]) }}">
                                            <div class="new-arrival-product">
                                                <div class="new-arrivals-img-contnent">
                                                    @foreach($item->images as $image)
                                                        @if($image->order === 0)
                                                            <img class="img-fluid rounded" src="{{ $image->path }}" alt="">
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="new-arrival-content text-center mt-3">
                                                    <h4>{{ $item->name }}</h4>
                                                    <ul class="star-rating">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    @foreach($item->prices as $price)
                                                        @if($price->type === "ALL")
                                                            <span class="price">{{ $price->price }} {{ $item->currency }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('styles')
    <link href="{{ asset('assets/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
@endpush

@push('library.js')
    <script src="{{ asset('assets/vendor/star-rating/jquery.star-rating-svg.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/owl.carousel.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMLAnIhqwBiSRkwpU0PPQ-XB8197QOzZk"></script>
@endpush
@push('scripts')


    <script>
        let map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: {{ $activity->address->latitude }}, lng: {{ $activity->address->longitude }} },
            zoom: 14
        });

        let marker = new google.maps.Marker({
            position: {lat: {{ $activity->address->latitude }}, lng: {{ $activity->address->longitude }} },
            map: map
        });

        const prices = @json($activity->prices);
        const currency = "{{ $activity->currency }}";
        let allPrice = null;
        $.each(prices, function(index, item) {
            if (item.type === "ALL") {
                allPrice = item.price;
                $('#allPrice').text(allPrice + ' ' + currency)
                return false;
            }
        });

        function cardsCenter()
        {
            $('.card-slider').owlCarousel({
                loop:true,
                margin:20,
                nav:false,
                autoplay:true,
                rtl:true,
                //center:true,
                slideSpeed: 3000,
                paginationSpeed: 3000,
                dots: false,
                navText: ['', ''],
                responsive:{
                    0:{
                        items:1
                    },
                    576:{
                        items:3
                    },
                    800:{
                        items:3
                    },
                    991:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            })
        }

        $(window).on('load',function(){
            setTimeout(function(){
                cardsCenter();
            }, 1000);
        });

        $('#profit_rate').on('input', function() {
            const currency = "{{ $activity->currency }}";
            let inputValue = $(this).val();
            let sanitizedValue = inputValue.replace(/[^0-9]/g, '');
            $(this).val(sanitizedValue);
            let profit = allPrice / 100 * sanitizedValue;
            $('#profit').html(profit + " " + currency);
            $('#total_price').html((profit + allPrice) + " " + currency);
        });
    </script>
@endpush