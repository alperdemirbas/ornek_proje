@extends('layouts.admin')
@section('MainPage',$mainPage ?? "")
@section('SubPage', $subPage ??"")
@section('main-content')
    <div class="row">
        <div class="col-12">
            @if(isset($modals))
                @foreach($modals as $modal)
                    @if(isset($modal['hasButton']))
                        <div class="card h-auto">
                            <div class="card-body">
                                <button type="button"
                                        class="btn btn-rounded btn-info float-end"
                                        data-bs-toggle="modal"
                                        data-bs-target="#{{ $modal['targetId'] }}"><span class="btn-icon-start {{ $modal['textIcon'] ?? 'text-info' }}"><i
                                                class="fa {{ $modal['icon'] ?? 'fa-plus' }} {{ $modal['color'] ?? 'color-info' }}"></i></span>@lang($modal['buttonTitle'] ?? "add")</button>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            <!-- Start : Filtre  -->
            @yield('sub-content')

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title ?? "" }}</h4>
                    @if(isset($buttons))
                        <div class="card-header-buttons">
                            @foreach($buttons as $button)
                                @if($button['element'] === "button")
                                    <button type="{{ $button['type'] }}" class="{{ $button['class'] }}"
                                        @if(isset($button['attributes']))
                                            @foreach($button['attributes'] as $key => $value)
                                                {{ $key }}="{{ $value }}"
                                            @endforeach
                                        @endif
                                    >{!! $button['icon'] ?? "" !!} {{ $button['text'] }}</button>
                                @else
                                    <a href="{{ $button['href'] }}" class="{{ $button['class'] }}"
                                    @if(isset($button['attributes']))
                                        @foreach($button['attributes'] as $key => $value)
                                            {{ $key }}="{{ $value }}"
                                        @endforeach
                                    @endif
                                    >{!! $button['icon'] ?? "" !!} {{ $button['text'] }}</a>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-body table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@prepend('library.css')
    <link href="{{ asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endprepend
@push('library.js')
    <script src="{{ asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/js/datatable-init.js') }}"></script>
    {{ $dataTable->scripts() }}
@endpush