<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeSource;

class IncomeSourceController extends Controller
{
    public function index()
    {
        $sources = IncomeSource::paginate(10);

        return view('pages.income.source', [ 'sources' => $sources ]);
    }
}
