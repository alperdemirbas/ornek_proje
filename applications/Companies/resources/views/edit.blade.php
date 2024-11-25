@php use Illuminate\Support\Str; @endphp
@php use Rezyon\Applications\Companies\Enums\AdminPermissionsEnum; @endphp
@extends('layouts.admin')
@section('title', trans('title.company.edit'))
@section('main-content')
    <div class="row">
        <div class="col-12">
            <form action="{{route('companies.update',['id'=>$detail->id])}}" method="POST">
                <div class="card card-bx m-b30">

                    <div class="card-header">
                        <h4 class="card-title">{{ Str::upper($detail->name) }}</h4>
                    </div>

                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Start : Firma Adı -->
                            <div class="col-sm-6 my-3">
                                <label class="form-label">{{__('company.name')}}</label>
                                <input required type="text" class="form-control" name="name" value="{{$detail->name}}">
                            </div>

                            <!-- Start : Email Adresi -->
                            <div class="col-sm-6 my-3">
                                <label class="form-label ">{{__('company.email')}}</label>
                                <input required type="email" class="form-control"
                                       placeholder="{{__('general.example')}} : {{__('company.email')}}" name="email"
                                       value="{{$detail->email}}">
                            </div>

                            <!-- Start : Firma Açıklama -->
                            <div class="col-12 my-3">
                                <label class="form-label ">{{__('company.description')}}</label>
                                <textarea rows="5" class="form-control"
                                          name="description">{{$detail->description}}</textarea>
                            </div>

                            <!-- Start : Adres -->
                            <div class="col-12 my-3">
                                <label class="form-label ">{{__('company.address')}}</label>
                                <textarea rows="4" class="form-control" placeholder="{{__('company.place_holder_address')}}"
                                          name="address">{{$detail->address}}</textarea>
                            </div>

                            <!-- Start : Ülke Kodu -->
                            <div class="col-sm-6 my-3">
                                <label class="form-label ">{{__('company.phone_country')}}</label>
                                <input required type="text" class="form-control"
                                       placeholder="{{__('company.phone_country')}} : {{__('company.phone_country')}}"
                                       name="phone_country" value="{{$detail->phone_country}}">
                            </div>

                            <!-- Start : Firma Telefon -->
                            <div class="col-6 my-3">
                                <label class="form-label ">{{__('company.phone')}}</label>
                                <input required type="text" class="form-control"
                                       placeholder="{{__('company.phone')}} : {{__('company.phone')}}" name="phone"
                                       value="{{$detail->phone}}">
                            </div>

                            <!-- Start : Ödeme Sıklığı  new Enum(PaymentFrequencyEnums::class) -->
                            <div class="col-12 my-3">
                                <label class="form-label ">{{__('company.payment_frequency')}}</label>
                                <select required
                                        class="select-picker nice-select default-select form-control wide mh-auto"
                                        name="payment_frequency">
                                    @foreach($paymentFrequencyEnums as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 text-end">
                                <!-- End : Yetkili Kişiler Datatable -->
                                <button class="btn btn-primary my-3">{{__('company.btn_update')}}</button>
                            </div>

                        </div>

                    </div>
                </div>


                <!-- Start : Yetkililer Datatable -->
                @can(AdminPermissionsEnum::ADMIN_OFFICIALS_LIST->value)
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{__('company.officials')}}</h4>

                                    <!-- Start : Model Click Event -->
                                    @can(AdminPermissionsEnum::ADMIN_OFFICIALS_STORE->value)
                                        <button type="button" class="float-end btn btn-sm btn-outline-primary float-end"
                                                data-bs-toggle="modal" data-bs-target="#official_add"><i
                                                    class="fa fa-plus"></i> {{__('company.add_official')}}</button>
                                    @endcan
                                </div>

                                <!-- Start : DataTable -->
                                <div class="card-body">{{$dataTable->table()}}</div>
                            </div>
                        </div>
                    </div>
                @endcan;

            </form>
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

    <script>
        $(document).on('click', 'a[data-role="destroy"]', (e) => {
            const id = $(e.currentTarget).attr("data-id");
            $("#official_destroy input[type='number'][name='official_id']").val(id);
        });
    </script>

@endpush

