<?php

namespace Rezyon\Applications\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Rezyon\Applications\Companies\Http\Requests\LoginRequest;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Illuminate\Validation\ValidationException;
use Rezyon\Packages\Enums\PackageTypesEnums;
use Rezyon\Users\Enums\Types;

class AuthController extends Controller
{
    public function __construct(public CompaniesServiceInterface $service)
    {

    }

    public function viewLogin()
    {
        return view('applications.companies::auth.login');
    }
    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        $domain = $request->subdomain;
        $login = Auth::guard('companies')->attempt([
            'email' => $request->post('email'),
            'password' => $request->post('password'),
            fn(Builder $query) => $query->whereHas('company',
                function ($q) use ($domain) {
                    return $q->where('domain', $domain);
                })
                ->whereIn('type', [
                    Types::TOURISM_COMPANY->value,
                    Types::SUPPLIER->value
                ]),
        ]);

        if (!$login) throw ValidationException::withMessages(['login' => trans('auth.failed')]);

        return redirect()->route('dashboard', ['subdomain'=>$domain]);
    }

    public function logout()
    {
        $domain = Route::getCurrentRoute()->subdomain;
        Auth::guard('companies')->logout();
        return redirect()->route('companies.login',['subdomain'=>$domain]);
    }
}