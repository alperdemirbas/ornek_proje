<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class CheckPackageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::guard('companies')->check()) {
            $domain = $request->subdomain;
            //dd($domain);
            if($domain !== null) {
                $service = app()->make(CompaniesServiceInterface::class);
                $companies = $service->findWithPackageByDomain($domain);
                $package = $companies->packages->last();
                $checkUserIsOfficial = Auth::guard('companies')->user()->company->officials->first()->email === Auth::guard('companies')->user()->email;

                if ($package->end_date->lt(Carbon::now())) {
                    $this->service->setPackageStatus($package->id, PaymentStatusesEnums::WAITING_PAYMENT);
                    $message = ['redirect' => 'payment.page', 'message' => trans('validation.payment.due')];
                } else {
                    switch ($package->payment_status) {
                        case PaymentStatusesEnums::WAITING_PAYMENT;
                            $message = ['redirect' => 'payment.page', 'message' => trans('validation.payment.waiting.payment')];
                            break;
                        case PaymentStatusesEnums::WAITING_APPROVAL;
                            $message = ['redirect' => 'payment.waiting.approval.page', 'message' => trans('validation.payment.waiting.approval')];
                            break;
                        case PaymentStatusesEnums::PAYMENT_ERROR;
                            $this->service->setPackageStatus($package->id, PaymentStatusesEnums::WAITING_PAYMENT);
                            $message = ['redirect' => 'payment.page', 'message' => trans('validation.payment.error')];
                            break;
                        case PaymentStatusesEnums::FINISHED;
                            $message = ['redirect' => 'payment.page', 'message' => trans('validation.payment.finished')];
                            break;
                        default;
                            return $next($request);
                    }
                }
                if($checkUserIsOfficial) {
                    return redirect()->route($message['redirect'], ['subdomain'=>$domain]);
                } else {
                    $domain = Route::getCurrentRoute()->subdomain;
                    Auth::guard('companies')->logout();
                    return redirect()->route('companies.login', ['subdomain'=>$domain])->withErrors(['error' => [trans('validation.company.auth.fail')]]);
                }
            }
        }
        return $next($request);
    }
}
