<ul class="nav nav-pills justify-content-center mb-4">
    <li class=" nav-item">
        <a href="#navpills2-1" class="nav-link active me-2" data-bs-toggle="tab" aria-expanded="false">@lang('activity.reviews.tourism')</a>
    </li>
    <li class="nav-item">
        <a href="#navpills2-2" class="nav-link" data-bs-toggle="tab" aria-expanded="false">@lang('activity.reviews.customers')</a>
    </li>
</ul>
<div class="tab-content">
    <div id="navpills2-1" class="tab-pane active">
        <div class="row">
            <div class="col-md-12">
                <div class="service-ratings">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h6 class="lh-lg">@lang('activity.reviews.service')</h6>
                        </div>
                        <div class="col-6 col-md-8">
                            <span class="px-4">4,5</span>
                            <div class="progress my-2">
                                <div class="progress-bar" style="width: 90%; height:6px;" role="progressbar">
                                    <span class="sr-only">4,5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h6 class="lh-lg">@lang('activity.reviews.fun')</h6>
                        </div>
                        <div class="col-6 col-md-8">
                            <span class="px-4">5,0</span>
                            <div class="progress my-2">
                                <div class="progress-bar" style="width: 100%; height:6px;" role="progressbar">
                                    <span class="sr-only">5,0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h6 class="lh-lg">@lang('activity.reviews.contact')</h6>
                        </div>
                        <div class="col-6 col-md-8">
                            <span class="px-4">3,9</span>
                            <div class="progress my-2">
                                <div class="progress-bar" style="width: 78%; height:6px;" role="progressbar">
                                    <span class="sr-only">3,9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="pt-3 mb-0 text-center"><span><i class="fa fa-star text-primary"></i> 4,9</span> <span class="dot"></span> 11 <span class="reviews-title">@lang('activity.rating')</span></h4>
                @for($i = 0; $i < 11; $i++)
                    <div class="card shadow-none h-auto">
                        <div class="card-header border-0 pb-0 px-0">
                            <div class="header-profile d-flex">
                                <div class="comment-title">
                                    <h4>J*** D**</h4>
                                    <span class="text-muted">23 Mart 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
    <div id="navpills2-2" class="tab-pane">
        <div class="row">
            <div class="col-md-12">
                <div class="service-ratings">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h6 class="lh-lg">@lang('activity.reviews.service')</h6>
                        </div>
                        <div class="col-6 col-md-8">
                            <span class="px-4">4,5</span>
                            <div class="progress my-2">
                                <div class="progress-bar" style="width: 90%; height:6px;" role="progressbar">
                                    <span class="sr-only">4,5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h6 class="lh-lg">@lang('activity.reviews.fun')</h6>
                        </div>
                        <div class="col-6 col-md-8">
                            <span class="px-4">5,0</span>
                            <div class="progress my-2">
                                <div class="progress-bar" style="width: 100%; height:6px;" role="progressbar">
                                    <span class="sr-only">5,0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h6 class="lh-lg">@lang('activity.reviews.contact')</h6>
                        </div>
                        <div class="col-6 col-md-8">
                            <span class="px-4">3,9</span>
                            <div class="progress my-2">
                                <div class="progress-bar" style="width: 78%; height:6px;" role="progressbar">
                                    <span class="sr-only">3,9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="pt-3 mb-0 text-center"><span><i class="fa fa-star text-primary"></i> 4,9</span> <span class="dot"></span> 11 <span class="reviews-title">@lang('activity.rating')</span></h4>
                @for($i = 0; $i < 11; $i++)
                    <div class="card shadow-none h-auto">
                        <div class="card-header border-0 pb-0 px-0">
                            <div class="header-profile d-flex">
                                <div class="comment-title">
                                    <h4>J*** D**</h4>
                                    <span class="text-muted">23 Mart 2023</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>