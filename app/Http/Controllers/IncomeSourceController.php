<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\IncomeType;
use Illuminate\Http\Request;
use App\Models\IncomeSource;
use App\Models\IncomeCategory;
use App\Models\ActualIncomeBreakdown;
use App\Http\Services\IncomeSourceService;

class IncomeSourceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return (new IncomeSourceService())->incomeSourceDatatable();
        }

        $categories = IncomeCategory::all();
        $types = IncomeType::all();

        return view('pages.income.source', [
            'categories' => $categories,
            'types'      => $types,
        ]);
    }

    public function store(Request $request)
    {
        $income_source_inputs = $request->except(['actual_income']);
        $source = IncomeSource::create($income_source_inputs);

        $actual_income_input = $request->only(['actual_income']);
        $actual_income = ActualIncomeBreakdown::create([
            'income_source_id' => $source->id,
            'amount' => $actual_income_input['actual_income'],
        ]);

        return response()->json([ 'result' => $source ]);
    }
}
