<?php

namespace Rezyon\Applications\Flights\Imports;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\ImportFailed;
use Rezyon\Applications\Flights\Notifications\ImportHasFailedNotification;
use Rezyon\Users\Enums\Types;
use Rezyon\Users\User;

class UsersImport implements ToModel, WithEvents, WithChunkReading, ShouldQueue, WithCalculatedFormulas, WithHeadingRow
{
    use Queueable, SerializesModels, Importable;

    private User $importedBy;
    private Builder|Model $flight;
    private Request $request;
    private FlightCustomersDataAccessInterface $flightCustomer;

    public function __construct(
        Builder|Model $flight,
        User          $user,
    )
    {
        $this->importedBy = $user;
        $this->flight = $flight;
    }

    public function registerEvents(): array
    {
        return [
            ImportFailed::class => function (ImportFailed $event) {
                $this->importedBy->notify(new ImportHasFailedNotification);
            },
        ];
    }

    public function model(array $row)
    {

        $user = app()->make(User::class);

        $user->setPnr();
        $user->setFirstname();
        $user->setLastname();
        $user->setEmail();
        $user->setPassword();
        $user->setType(Types::CUSTOMER);


    }

    public function chunkSize(): int
    {
        return 1000;
    }
}