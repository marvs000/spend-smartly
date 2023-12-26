<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeSource;
use App\Models\IncomeCategory;
use App\Models\IncomeType;

class IncomeSourceController extends Controller
{
    public function index()
    {
        $sources = IncomeSource::withSum('actual_incomes', 'amount')->paginate(10);
        $categories = IncomeCategory::all();
        $types = IncomeType::all();

        return view('pages.income.source', [
            'sources'    => $sources,
            'categories' => $categories,
            'types'      => $types,
        ]);
    }
}
