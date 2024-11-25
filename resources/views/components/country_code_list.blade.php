<style>
    .select2-container {
        width: 100px !important;
        border-radius: 0!important;

    }
</style>
@php
    $phone = phone_supported_regions();
@endphp
@if(!empty($phone))

    <div class="{{$columnClass??'col-4 my-3'}}">
        <div class="row">
            <div class="col-12"><label class="form-label">{{__('company.phone')}}</label></div>
            <div class="col" style="width: 50px;">
                <select class="form-control country-code-list select2" name="{{$name?? 'phone_country'}}"
                        id="{{$id?? 'country_code'}}"></select></div>
            <div style="width:calc(100% - 100px);"><input required type="tel" class="form-control" value="{{$detail->phone}}" name="phone"></div>
        </div>
    </div>

@endif


@push('scripts')
    <script src="{{ asset('assets/js/phone-codes.js') }}"></script>
    <script>
        !(() => {
            const select = $(".country-code-list");
            const supportedRegions = @JSON($phone);
            const filteredPhoneList = phoneList.filter(item => supportedRegions.includes(item.code));
            filteredPhoneList.sort((a, b) => (a.code === "TR" ? -1 : b.code === "TR" ? 1 : 0));
            let htmlPhone = "";
            filteredPhoneList.forEach(item => {
                htmlPhone += `<option data-mask="${item.mask}" value="${item.code}">${item.emoji} ${item.dial_code}</option>`
            });
            select.html(htmlPhone);
            $(document).ready(()=>{
                $(".country-code-list").css({
                    width: 'resolve',
                });
            });
        })();
    </script>
@endpush