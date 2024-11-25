@extends('layouts.admin')
@section('title', 'Transfer Detayı')
@section('MainPageUrl', _route('transfers.index'))
@section('MainPage', 'Transferler')
@section('SubPage', 'Transfer Detayı')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Araçtaki Yolcular</h4>
                    <div class="card-header-buttons">
                        <button type="button" id="add-customer" class="btn btn-primary"><i class="fa-solid fa-user-group me-2"></i>Yolcu Ekle</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {!! $customersDataTable->table() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Araçtaki Görevliler</h4>
                    <div class="card-header-buttons">
                        <button type="button" id="add-user" class="btn btn-primary"><i class="fa-solid fa-user-tie me-2"></i>Görevli Ekle</button>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {!! $usersDataTable->table() !!}
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
    {!! $customersDataTable->scripts() !!}
    {!! $usersDataTable->scripts() !!}
@endpush

@push('scripts')
    <script>
        let $users = @JSON($users);
        let $customers = @JSON($customers);

        $('#add-customer').click(function () {
            _Swal({
                title: 'Yolcu Ekle',
                html: '<select id="customer-select" class="form-control select2" multiple="multiple" style="width: 100%"></select>',
                showCancelButton: true,
                cancelButtonText: "@lang('general.cancel')",
                confirmButtonText: "@lang('general.add')",
                didOpen: () => {
                    let formattedCustomers = Object.values($customers).map(customer => ({
                        id: customer.id,
                        text: customer.firstname + ' ' + customer.lastname
                    }));
                    $('#customer-select').select2({
                        data: formattedCustomers,
                        dropdownParent: $(".swal2-container") // Select2 dropdown'u SweetAlert modal içinde doğru konumlandırmak için
                    });
                },
                preConfirm: () => {
                    return $('#customer-select').select2('data').map((customer) => customer.id);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Seçilen kullanıcıları $customers objesinden çıkar
                    $customers = Object.values($customers).filter(customer => !result.value.includes(customer.id.toString()));
                    console.log($customers); // Güncellenmiş $customers objesini konsolda göster
                    window.LaravelDataTables['transfercustomers-table'].ajax.reload();
                }
            });
        });

        $('#add-user').click(function () {
            _Swal({
                title: 'Görevli Ekle',
                html: '<select id="user-select" class="form-control select2" multiple="multiple" style="width: 100%"></select>',
                showCancelButton: true,
                cancelButtonText: "@lang('general.cancel')",
                confirmButtonText: "@lang('general.add')",
                didOpen: () => {
                    let formattedCustomers = Object.values($users).map(user => ({
                        id: user.id,
                        text: user.firstname + ' ' + user.lastname
                    }));
                    $('#user-select').select2({
                        data: formattedCustomers,
                        dropdownParent: $(".swal2-container") // Select2 dropdown'u SweetAlert modal içinde doğru konumlandırmak için
                    });
                },
                preConfirm: () => {
                    return $('#user-select').select2('data').map((user) => user.id);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Seçilen kullanıcıları $users objesinden çıkar
                    $users = Object.values($users).filter(user => !result.value.includes(user.id.toString()));
                    console.log($users); // Güncellenmiş $users objesini konsolda göster
                    window.LaravelDataTables['transferusers-table'].ajax.reload();
                }
            });
        });
    </script>
@endpush