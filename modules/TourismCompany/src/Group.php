<?php

namespace Rezyon\TourismCompany;

use App\Traits\ToArrayTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Rezyon\Companies\Models\Users;
use Rezyon\TourismCompany\Enums\GroupStatus;
use Rezyon\TourismCompany\Enums\GroupTypes;

class Group implements Arrayable
{
    use ToArrayTrait;
    protected ?string $name = null;
    protected ?GroupTypes $type = null;
    protected ?GroupStatus $status = null;

    protected ?Carbon $arrivalDate;
    protected ?Carbon $dateOfReturn;
    private ?Users $user = null;

    public function __construct(?Users $user = null)
    {
        if( !empty($user)){
            $this->user = $user;
        }
    }

    public function getType(): ?GroupTypes
    {
        return $this->type;
    }

    public function setType(GroupTypes $type): void
    {
        $this->type = $type;
    }

    public function getStatus(): ?GroupStatus
    {
        return $this->status;
    }

    public function setStatus(GroupStatus $status): void
    {
        $this->status = $status;
    }

    public function getArrivalDate(): ?Carbon
    {
        return $this->arrivalDate ?? null;
    }

    public function setArrivalDate(Carbon $arrivalDate): void
    {
        $this->arrivalDate = $arrivalDate;
    }

    public function getDateOfReturn(): ?Carbon
    {
        return $this->dateOfReturn ?? null;
    }

    public function setDateOfReturn(Carbon $dateOfReturn): void
    {
        $this->dateOfReturn = $dateOfReturn;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function toArray():array
    {
        $result = $this->toFillable($this);
        if( empty( !$this->user )){
            $result['users_id'] = $this->user->id;
        }
        return $result;
    }
}