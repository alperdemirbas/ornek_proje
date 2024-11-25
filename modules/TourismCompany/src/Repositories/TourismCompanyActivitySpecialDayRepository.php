<?php

namespace Rezyon\TourismCompany\Repositories;

use Rezyon\TourismCompany\Models\TourismCompanyActivitySpecialDay;

class TourismCompanyActivitySpecialDayRepository
{
    protected TourismCompanyActivitySpecialDay $model;

    public function __construct(TourismCompanyActivitySpecialDay $model)
    {
        $this->model = $model;
    }

    public function create(int $companyId, array $data)
    {
        return $this->model->newQuery()->create([
            'profitability' => $data['profitability'],
            'companies_id' => $companyId,
            'activity_id' => $data['activity_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
    }

    public function delete(int $id)
    {
        return $this->model->newQuery()->where('id', $id)->delete();
    }
}