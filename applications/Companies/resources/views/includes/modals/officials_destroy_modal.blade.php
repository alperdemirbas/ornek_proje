<!-- Start : Kayıtlı bir yetkiliyi silme işlemi -->
<form action="{{ route('applications.companies.official.destroy') }}" method="POST">
    @csrf
    <div class="row">

        <!-- Start : Yetkiliyi silmek istediğinize emin misiniz ? -->
        <div class="col-12">
            <p>{{__('company.destroy_official_body')}}</p>
        </div>

        <div class="col-12 text-end">
            <input type="number" value="" name="official_id" hidden>
            <button class="btn btn-sm btn-light" data-bs-dismiss="modal" id="company_official_cancel" type="button">{{__('general.cancel')}}</button>
            <button class="btn btn-sm btn-primary" id="company_official_delete" type="submit">{{__('general.delete')}}</button>
        </div>

    </div>
</form>