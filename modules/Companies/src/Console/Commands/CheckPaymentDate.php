<?php

namespace Rezyon\Companies\Console\Commands;

use Illuminate\Console\Command;
use Rezyon\Companies\Enums\PaymentStatusesEnums;
use Rezyon\Companies\Interfaces\CompaniesServiceInterface;

class CheckPaymentDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-payment-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CompaniesServiceInterface $service)
    {
        $expiredPackages = $service->getExpiredPackage();
        foreach ($expiredPackages as $package){
            $service->setPackageStatus($package->id, PaymentStatusesEnums::WAITING_PAYMENT);
        }
    }
}
