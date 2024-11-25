@extends('layouts.admin')

@section('main-content')
    <div class="row">
        <div class="col-xl-12">
            <form method="POST" action="{{ _route('company.users.update', ['user' => $user->id]) }}">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">@lang('user.user_info')</h4>
                        <div class="row">
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label  class="form-label">@lang('general.firstname')<span class="text-danger scale5 ms-2">*</span></label>
                                <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" placeholder="Ahmet" aria-label="firstname">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label  class="form-label">@lang('general.lastname')<span class="text-danger scale5 ms-2">*</span></label>
                                <input type="text" class="form-control" name="lastname" placeholder="Demir" value="{{ $user->lastname }}" aria-label="lastname">
                            </div>
                            <div class="col-xl-6  col-md-6 mb-4">
                                <label  class="form-label">@lang('general.email')<span class="text-danger scale5 ms-2">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="ahmet.demir@example.com" value="{{ $user->email }}" aria-label="email">
                            </div>
                        </div>
                        @if(isset($permissions))
                            <h4>@lang('user.permissions')</h4>
                            <div class="row">
                                    @foreach($permissions as $permission)
                                        <div class="col-xl-6  col-md-6 mb-4">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input me-3" type="checkbox" name="permissions[{{ $permission->name }}]" role="switch" id="{{ $permission->name }}" @if($user->hasPermissionTo($permission->name)) checked @endif>
                                                <label class="form-check-label" for="{{ $permission->name }}">{{ __('permission.'.$permission->name) }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <div>
                            <button type="submit" class="btn btn-primary">@lang('general.save')</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection