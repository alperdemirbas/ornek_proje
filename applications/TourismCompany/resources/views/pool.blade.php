@extends('layouts.admin')
@section('title', trans('title.activity_pool'))

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="filter cm-content-box box-primary">
                <div class="content-title SlideToolHeader">
                    <div class="cpa">
                        <i class="fa-sharp fa-solid fa-filter me-2"></i>@lang('general.filter')
                    </div>
                    <div class="tools">
                        <a href="javascript:void(0);" class="expand handle"><i class="fal fa-angle-down"></i></a>
                    </div>
                </div>
                <div class="cm-content-body form excerpt">
                    <form id="filter" method="GET">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">@lang('general.category')</label>
                                    <select class="form-control select2 h-auto wide" id="activity_categories" name="filter[activity_category_id]">
                                        <option selected disabled>@lang('general.category')</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-3 col-sm-6 mb-3 mb-xl-0">
                                    <label class="form-label">@lang('filter.price.range')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control me-2" placeholder="En Az" name="min_price" value="{{ $filters['min_price'] ?? '' }}">
                                        <input type="text" class="form-control" placeholder="En Çok" name="max_price" value="{{ $filters['max_price'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-sm-6 align-self-end">
                                    <div>
                                        <button class="btn btn-primary me-2" type="submit"><i class="fa fa-filter me-1"></i>@lang('filter.button')</button>
                                        <button class="btn btn-danger light" id="removeFilter" type="button">@lang('filter.remove.button')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($activities as $activity)
            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                <div class="card product-grid-card">
                    <div class="card-body">
                        <div class="new-arrival-product">
                            <div class="new-arrivals-img-contnent">
                                @foreach($activity->images as $image)
                                    @if($image->order === 0)
                                        <img class="img-fluid" src="{{ $image->path }}" alt="">
                                    @endif
                                @endforeach
                            </div>
                            <div class="new-arrival-content text-start mt-3">
                                <h4><a href="{{ _route('tourism.activity.show', ['id' => $activity->id]) }}">{{ $activity->name }}</a></h4>
                                <ul class="star-rating">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa-regular fa-star"></i></li>
                                    <li><i class="fa-regular fa-star"></i></li>
                                </ul>
                                <span class="price float-none">@foreach($activity->prices as $price) @if($price->type = "ALL") {{ $price->price }} @endif @endforeach {{ $activity->currency }}</span>
                                <div class="mt-3">
                                    <a href="{{ _route('supplier.activity.show', ['id' => $activity->id]) }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye me-2"></i>@lang('activity.review.and.add')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/nouislider/nouislider.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/wnumb/wNumb.js') }}"></script>
    <script>

        $('#filter input').on('input', function() {
            let inputValue = $(this).val();
            let sanitizedValue = inputValue.replace(/[^0-9]/g, '');
            $(this).val(sanitizedValue);
        });

        @if(isset($filters['filter']['activity_category_id']))
            $('[name="filter[activity_category_id]"] option[value="{{ $filters['filter']['activity_category_id'] }}"]').prop("selected", true);
        @endif

        $('#removeFilter').click(function() {
            const form = $('#filter');
            const select = $('.default-select');
            select.selectpicker('destroy');
            $('select', form).val($('select option:eq(0)', form).val());
            select.selectpicker('render');
            form[0].reset();
            window.location.replace("{{ _route('tourism.activity.list') }}");
        });
    </script>
@endpush