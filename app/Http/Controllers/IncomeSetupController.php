<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Models\IncomeType;
use App\Models\IncomeCutOff;

class IncomeSetupController extends Controller
{
    public function index()
    {
        $categories = IncomeCategory::paginate(10);
        $types = IncomeType::paginate(20);
        $cut_offs = IncomeCutOff::paginate(20);

        return view('pages.income.setup', [ 
            'categories' => $categories,
            'types' => $types,
            'cut_offs' => $cut_offs
        ]);
    }
}
