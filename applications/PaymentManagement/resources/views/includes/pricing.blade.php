<script>
    !(function () {
        const packages = @JSON($packages);
        const subscribe = {
            htmls: {
                packages: function (package, selectID) {
                    if(boxTemp === "table") {
                        return `
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 m-b30">
                                <div class="pricing-wrapper small packages rounded ${package.id === selectID ? 'border-primary selected active' : null}"
                                     data-id="${package.id}">
                                    <div class="pricing-inner">
                                        <div class="Package-title">
                                            <h4 class="title">${package.name}</h4>
                                        </div>
                                        <div class="Package-price mb-0 text-muted discount ${package.discount === "NaN" ? 'd-none' : null}">
                                            <del><span class="total-price">${package.discount}₺</span></del>
                                            <p>/${package.frequency}</p>
                                        </div>
                                        <div class="Package-price">
                                            <span class="total-price">${package.price}₺</span>
                                            <p>/${package.frequency}</p>
                                        </div>
                                        <div class="Package-list">
                                            <ul>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>1
                                                    job posting
                                                </li>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>0
                                                    featured job
                                                </li>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>job
                                                    displayed fo 20 days
                                                </li>
                                                <li class="disable"><i
                                                            class="fa-solid fa-xmark"></i>Premium
                                                    support 24/7
                                                </li>
                                            </ul>
                                        </div>
                                        <a class="btn btn-primary btn-lg" href="${package.url}">@lang('subscribe.subscribe.title')</a>
                                    </div>
                                </div>
                            </div>
                        `;
                    } else if(boxTemp === "checkbox") {
                        return `
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 m-b30">
                                <div class="pricing-wrapper small packages rounded ${package.id === selectID ? 'border-primary selected active' : null}"
                                     data-id="${package.id}">

                                    <input type="radio" class="d-none"
                                           name="package_id"
                                           value="${package.id}">
                                    <span class="ribbon fa-solid fa-check"></span>
                                    <div class="pricing-inner">
                                        <div class="Package-title">
                                            <h4 class="title">${package.name}</h4>
                                        </div>
                                        <div class="Package-price mb-0 text-muted discount ${package.discount === "NaN" ? 'd-none' : null}">
                                            <del><span class="total-price">${package.discount}₺</span></del>
                                            <p>/${package.frequency}</p>
                                        </div>
                                        <div class="Package-price">
                                            <span class="total-price">${package.price}₺</span>
                                            <p>/${package.frequency}</p>
                                        </div>
                                        <div class="Package-list">
                                            <ul>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>1
                                                    job posting
                                                </li>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>0
                                                    featured job
                                                </li>
                                                <li>
                                                    <span><i class="fa-solid fa-check"></i></span>job
                                                    displayed fo 20 days
                                                </li>
                                                <li class="disable"><i
                                                            class="fa-solid fa-xmark"></i>Premium
                                                    support 24/7
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }

                }
            },
            setPackages(type) {
                subscribe.currentPackageList = [];
                for (let k in subscribe.packages) {
                    const item = subscribe.packages[k];
                    if (item.type === type) {
                        subscribe.currentPackageList.push(item);
                    }
                }
            },
            modifyPackages(frequency, type = null) {
                const currentSelectedPackage = this.boxPackages.find('.pricing-wrapper.active').data('id');
                let html = " ";
                for (let k in subscribe.currentPackageList) {
                    const item = subscribe.currentPackageList[k];
                    const obj = {};
                    switch (frequency) {
                        case 'yearly_discount' :
                            obj.month = 12;
                            obj.frequency = "@lang('packages.annually')";
                            break;
                        case 'half_yearly_discount' :
                            obj.month = 6;
                            obj.frequency = "@lang('packages.semiannually')";
                            break;
                        case 'quarter_yearly_discount' :
                            obj.month = 3;
                            obj.frequency = "@lang('packages.quarterly')";
                            break;
                        default:
                            obj.month = 1;
                            obj.frequency = "@lang('packages.monthly')";
                            break;
                    }
                    if( frequency === 'fee' ){
                        obj.price = item.fee;
                    } else {
                        let discount = (obj.month * item.fee * item[frequency]) / 100;
                        let price = (item.fee * obj.month);
                        obj.discount = price
                        obj.price = price - discount;
                    }

                    let url = "{{ route("payment.subscribe.view", ["package" => "__package", "cycle" => "__cycle", "type" => "__type"]) }}";
                    url = url.replace('__package', item.id);
                    url = url.replace('__cycle', frequency);
                    url = url.replace('__type', type);

                    item.url = url;
                    item.price = Number(obj.price).toFixed(2);
                    item.discount = Number(obj.discount).toFixed(2);
                    item.frequency = obj.frequency;
                    html += subscribe.htmls.packages( item, currentSelectedPackage );
                }
                subscribe.boxPackages.html(html);

            },
            changeCompanyType(e) {
                const selected = $(this).val();
                subscribe.setPackages(selected);
                subscribe.modifyPackages('fee', selected);
                subscribe.changeRequirementDocsList(selected);
            },
            setPackagesList(){
                const _this = $(this);
                const coType = $('.company-type:checked').val();
                subscribe.paymentFrequency.each(function (key, item) {
                    $(item).find('a').removeClass('active');
                });
                _this.find('a').addClass('active');
                _this.find('input[name="billingCycle"]').prop(':checked', true);
                subscribe.modifyPackages(_this.find('a').data('id'), coType);
            },
            changeRequirementDocsList(type) {
                let html = '';
                if(type === "TOURISM_COMPANY") {
                    html = `<span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.tax')</span>
                    <span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.foundation')</span>
                    <span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.tursab')</span>
                    <span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.company.sign')</span>`;
                } else if (type === "SUPPLIER") {
                    html = `<span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.tax')</span>
                    <span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.foundation')</span>
                    <span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.tursab')</span>
                    <span class="mb-2 d-flex"><i
                                class="fas fa-star orange me-3 mt-1"></i>@lang('subscribe.upload.documents.company.sign')</span>`;
                }

                $('#reqDocs').html( html );
            },
            selectPackage(id, frequency, type){

                subscribe.setPackages(type);
                subscribe.modifyPackages(frequency, type);

                subscribe.changeRequirementDocsList(type);

                const typeInput = $('#type').find(`[value="${type}"]`).prop('checked', true);
                typeInput.parents('.pricing-wrapper.type').addClass('border-primary selected active');

                const el = this.boxPackages.find(`[data-id="${id}"]`);
                $('input', el).prop('checked', true);
                if (!el.is('.border-primary, .selected, .active')) {
                    el.addClass('border-primary selected active');
                }
            },
            events() {
                this.iCompanyType.change(subscribe.changeCompanyType);
                this.paymentFrequency.click(subscribe.setPackagesList);
            },
            defaults() {
                this.$body = $('body');
                this.packages = packages;
                this.currentPackageList = [];
                this.iCompanyType = $('.company-type');
                this.boxPackages = $('.packages');
                this.paymentFrequency = $('.paymentFrequency > .nav-item');
                this.companyType = "none";
                this.selectedPackage = "{{ request()->route()->package }}";
                this.selectedFrequency = "{{ request()->route()->cycle ?? "fee" }}";
                this.selectedCompanyType = "{{ request()->route()->type ?? "TOURISM_COMPANY" }}";
            },
            init() {
                this.defaults();
                this.events();
                this.selectPackage(this.selectedPackage, this.selectedFrequency, this.selectedCompanyType);
            }
        }
        subscribe.init();
    })();
</script>