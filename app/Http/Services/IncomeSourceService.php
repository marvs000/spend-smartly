<?php

namespace App\Http\Services;

use DataTables;
use App\Models\IncomeSource;

class IncomeSourceService 
{
    public function incomeSourceDatatable()
    {
        $data = IncomeSource::with('category')
                ->with('type')
                ->withSum('actual_incomes', 'amount')
                ->get();

        return DataTables::of($data)
            ->addColumn('category', function (IncomeSource $source) {
                return $source->category->title;
            })
            ->addColumn('type', function (IncomeSource $source) {
                return $source->type->title;
            })
            ->addColumn('action', function ($row) {
                $actions = '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                data-bs-target="#add-income-logs" data-id="'. $row->id .'"><i class="bx bx-show-alt me-1"></i> View</a>
                        </div>
                    </div>';
                return $actions;
            })
            ->toJson();
    }
}