<?php

namespace App\Http\Services;

use DataTables;
use App\Models\IncomeSource;

class IncomeSourceService
{
    public function incomeSourceDatatable($request)
    {

        $data = IncomeSource::with('category')
            ->with('type')
            ->withSum('actual_incomes', 'amount')
            ->whereRaw('YEAR(income_date) = COALESCE(?, YEAR(CURDATE()))', [$request->year])
            ->whereRaw('MONTH(income_date) = COALESCE(?, MONTH(CURDATE()))', [$request->month]);
            // ->ddRawSql();
            // ->get();

        return DataTables::eloquent($data)
            ->addColumn('category', function (IncomeSource $source) {
                return $source->category->title;
            })
            ->addColumn('type', function (IncomeSource $source) {
                return $source->type->title;
            })
            ->addColumn('action', function ($row) {
                $actions = '
                    <div class="d-inline-block text-nowrap">
                        <span class="action-tooltip" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" title="Edit">
                            <button class="btn btn-sm btn-icon edit-log" data-id="' . $row->id . '" data-bs-toggle="offcanvas"
                            data-bs-target="#incomeLogOffcanvas" aria-controls="editLog"><i class="bx bx-edit"></i></button>
                        </span>
                        <span class="action-tooltip" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" title="Delete">
                            <button class="btn btn-sm btn-icon delete-log" data-id="' . $row->id . '"><i class="bx bx-trash"></i></button>
                        </span>
                    </div>
                ';
                return $actions;
            })
            ->toJson();
    }
}
