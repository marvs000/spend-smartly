<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeCategory;
use App\Models\IncomeType;

class IncomeCategoryController extends Controller
{
    public function index()
    {
        $categories = IncomeCategory::paginate(10);
        $types = IncomeType::paginate(20);

        return view('pages.income.category', [ 'categories' => $categories, 'types' => $types ]);
    }
}
