@extends('layouts.datatable')
@section('title', 'Araçlar')
@section('MainPageUrl', url('/dashboard'))
@section('MainPage', 'Panel')
@section('SubPage', 'Araçlar')
@push('scripts')
    <script>
        $(document).on('submit', '.deleteAction', function(event) {
            event.preventDefault();
            _Swal({
                title: "Emin misin?",
                text: "Bu işlemi geri alamazsınız.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Evet, Sil!",
                cancelButtonText: "Hayır, İptal Et!"
            }).then((result) => {
                if (result.isConfirmed) {
                    _Swal({
                        title: "Lütfen Bekleyiniz...",
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    this.submit();
                }
                return false;
            });
        });
    </script>
@endpush