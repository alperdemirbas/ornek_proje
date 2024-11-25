<form action="{{ route('applications.companies.official.store',['id'=>request()->route('id')]) }}" method="POST">
    @csrf
    <div class="row">
        <!-- Start : Yetkili Ünvanı -->
        <div class="col-12 mb-3">
            <span>{{__('company.official_title')}}</span>
            <input required class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="{{__('company.official_title_sample')}}"/>
        </div>

        <!-- Start : Yetkili Adı -->
        <div class="col-12 mb-3">
            <span>{{__('company.official_first_name')}}</span>
            <input required class="form-control" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="{{__('company.official_first_name_sample')}}"/>
        </div>

        <!-- Start : Yetkili Soyadı -->
        <div class="col-12 mb-3">
            <span>{{__('company.official_last_name')}}</span>
            <input required class="form-control" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="{{__('company.official_last_name_sample')}}"/>
        </div>

        <!-- Start : Yetkili E-posta -->
        <div class="col-12 mb-3">
            <span>{{__('company.official_email')}}</span>
            <input required class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="{{__('company.official_email_sample')}}"/>
        </div>

        <!-- Start : Yetkili Telefon Ülke Kodu -->
        <div class="col-6 mb-3">
            <span>{{__('company.official_phone_country')}}</span>
            <input required class="form-control" type="text" name="phone_country" value="{{ old('phone_country') }}" />
        </div>

        <!-- Start : Yetkili Telefon Numarası -->
        <div class="col-6 mb-3">
            <span>{{__('company.official_phone')}}</span>
            <input required class="form-control" type="tel" name="phone" value="{{ old('phone') }}" />
        </div>

        <div class="col-12 text-end">
            <button class="btn btn-sm btn-light" data-bs-dismiss="modal" id="company_official_cancel" type="button">{{__('general.cancel')}}</button>
            <button class="btn btn-sm btn-primary" id="company_official_add" type="submit">{{__('general.add')}}</button>
        </div>

    </div>
</form>