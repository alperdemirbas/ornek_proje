@extends('layouts.admin')
@section('title', 'Araç Düzenle')
@section('MainPageUrl', _route('cars.index'))
@section('MainPage', 'Araçlar')
@section('SubPage', 'Araç Düzenle')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card  card-bx m-b30">
                <div class="card-header">
                    <h6 class="title">Araç Düzenle</h6>
                </div>
                <form action="{{ _route('cars.update', ['car' => $car->id]) }}" method="POST">
                    @method("PUT")
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 my-3">
                                <label class="form-label">Araç Adı<span class="text-red">*</span></label>
                                <input required type="text" class="form-control" placeholder="Minivan" name="name[tr]" value="{{ $car->name }}">
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">Araç Kapasitesi<span class="text-red">*</span></label>
                                <input required type="number" min="1" step="1" class="form-control" name="capacity" value="{{ $car->capacity }}">
                            </div>

                            <div class="col-sm-4 my-3">
                                <label class="form-label">Araç Numarası</label>
                                <input type="text" class="form-control" placeholder="214" name="number" value="{{ $car->number }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">@lang('general.save')</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('form').submit(function(event) {
            _Swal({
                title: "Lütfen Bekleyiniz...",
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    </script>
@endpush