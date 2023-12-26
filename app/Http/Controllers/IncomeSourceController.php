<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use App\Models\IncomeSource;
use App\Models\IncomeCategory;


class IncomeSourceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = IncomeSource::with('category')
                ->with('type')
                ->withSum('actual_incomes', 'amount')
                ->get();

            return DataTables::of($model)
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

        $categories = IncomeCategory::all();
        $types = IncomeType::all();

        return view('pages.income.source', [
            'categories' => $categories,
            'types'      => $types,
        ]);
    }
}
