@extends('layouts.admin')
@section('MainPage', $mainPage ?? "")
@section('SubPage', $subPage ?? "")

@push('styles')
    <link href="{{ asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
@endpush

@section('main-content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="profile-form" method="POST" action="{{ _route('flights.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card  card-bx m-b30">
                    <div class="card-header">
                        <h6 class="title">{{ $subPage ?? "" }}</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('flight.flight_number')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="flight_number" required value="{{ $flight->flight_number }}">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('flight.departure_time')<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="departure_time" required value="{{ $flight->departure_time }}">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('flight.departure_airport')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="departure_airport" required value="{{ $flight->departure_airport }}">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('flight.arrival_time')<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="arrival_time" required value="{{ $flight->arrival_time }}">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('flight.arrival_airport')<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="arrival_airport" required value="{{ $flight->arrival_airport }}">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('flight.return_time')<span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="return" required value="{{ $flight->return }}">
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label class="form-label">@lang('flight.details')</label>
                                <textarea name="detail" rows="4" class="form-control">{{ $flight->detail }}</textarea>
                            </div>
                            <div class="col-sm-6 m-b30">
                                <label for="formFile" class="form-label">@lang('flight.import_passengers')<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-md">@lang('general.save')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
@endpush