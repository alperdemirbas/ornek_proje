@extends('layouts.datatable')
@section('title', 'Transferler')
@section('MainPageUrl', url('/dashboard'))
@section('MainPage', 'Panel')
@section('SubPage', 'Transferler')
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