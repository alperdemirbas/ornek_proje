@extends('layouts.datatable')
@push('scripts')
    <script>
        !(function(){
            const confirmFlight = function(){
                swal({
                    title: '@lang('general.warning')',
                    text: '@lang('flight.confirm_landed')',
                    type: "warning",
                    confirmButtonText: '@lang('general.confirm')',
                    showCancelButton: 1,
                    cancelButtonText: '@lang('general.cancel')',
                }).then((response) => {
                    if(response.value === true) {
                        const id = $(this).data('id');
                        const role = $(this).data('role');
                        let url = '{{ _route('flights.statusAction', ['flight' => '__id'])  }}';
                        url = url.replace('__id', id);
                        $.post(url, { _token: csrf , id, role } , function(response) {
                            toast({
                                title: "@lang('general.success')",
                                type: "success",
                                message: "@lang('flight.landed_success')"
                            });
                        }).fail(function(err) {
                            toast({
                                title: "@lang('general.error')",
                                type: "error",
                                message: "@lang('general.error_occurred')"
                            });
                        }).always(function(){
                            window.LaravelDataTables['flights-table'].ajax.reload();
                        });
                    }
                })
            }
            const returnFlight = function(){
                swal({
                    title: '@lang('general.warning')',
                    text: '@lang('flight.confirm_returned')',
                    type: "warning",
                    confirmButtonText: '@lang('general.confirm')',
                    showCancelButton: 1,
                    cancelButtonText: '@lang('general.cancel')',
                }).then((response) => {
                    if(response.value === true) {
                        const id = $(this).data('id');
                        const role = $(this).data('role');
                        let url = '{{ _route('flights.statusAction', ['flight' => '__id'])  }}';
                        url = url.replace('__id', id);
                        $.post(url, { _token: csrf , id, role } , function(response) {
                            toast({
                                title: "@lang('general.success')",
                                type: "success",
                                message: "@lang('flight.returned_success')"
                            });
                        }).fail(function(err) {
                            toast({
                                title:"@lang('general.error')",
                                type: "error",
                                message: "@lang('general.error_occurred')"
                            });
                        }).always(function(){
                            window.LaravelDataTables['flights-table'].ajax.reload();
                        });
                    }
                })
            }
            const cancelFlight = function(){
                swal({
                    title: '@lang('general.warning')',
                    text: '@lang('flight.confirm_cancelled')',
                    type: "warning",
                    confirmButtonText: '@lang('general.confirm')',
                    showCancelButton: 1,
                    cancelButtonText: '@lang('general.cancel')',
                }).then((response) => {
                    if(response.value === true) {
                        const id = $(this).data('id');
                        const role = $(this).data('role');
                        let url = '{{ _route('flights.statusAction', ['flight' => '__id'])  }}';
                        url = url.replace('__id', id);
                        $.post(url,{ _token: csrf , id, role } , function(response) {
                            toast({
                                title: "@lang('general.success')",
                                type: "success",
                                message: "@lang('flight.cancelled_success')"
                            });
                        }).fail(function(err) {
                            toast({
                                title:"hata",
                                type: "error",
                                message: "@lang('general.error_occurred')"
                            });
                        }).always(function(){
                            window.LaravelDataTables['flights-table'].ajax.reload();
                        });
                    }
                })
            }
            const editFlight = function(){
                const id = $(this).data('id');
                const role = $(this).data('role');
                $.post('{{ _route('flights.getRow')  }}',{ _token: csrf , id } , function(response) {
                    $.each(response.data, function( key, value ) {
                        let elem = $(`#${key}`);
                        if(elem) {
                            elem.val(value);
                        }
                    });
                }).fail(function(err) {
                    toast({
                        title:"@lang('general.error')",
                        type: "error",
                        message: "@lang('general.error_occurred')"
                    });
                });
            }
            let $body = $('body');
            $body.on("click", '[data-role="edit"]', editFlight )
            $body.on("click", '[data-role="confirm"]', confirmFlight )
            $body.on("click", '[data-role="return"]', returnFlight )
            $body.on("click", '[data-role="cancel"]', cancelFlight )
        })();
    </script>
@endpush