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
            return (new IncomeSourceService())->incomeSourceDatatable($request);
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
        $source = IncomeSource::create($request->all());

        return response()->json([ 'result' => $source ]);
    }

    public function edit($id)
    {
        $source = IncomeSource::find($id);

        return response()->json([ 'result' => $source ]);
    }

    public function update(Request $request, $id)
    {
        $source = IncomeSource::find($id)->update($request->all());

        return response()->json([ 'result' => $source ]);
    }

    public function delete($id)
    {
        $source = IncomeSource::find($id)->delete();

        return response()->json([ 'result' => $source ]);
    }
}
