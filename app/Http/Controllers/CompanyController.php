<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\ElasticService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $elastic;

    public function __construct(ElasticService $elastic)
    {
        $this->elastic = $elastic;
    }

    public function store(Request $request)
    {
        $company = Company::create($request->all());
        $this->elastic->indexCompany($company);

        return response()->json($company);
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $result = $this->elastic->searchCompany($query);

        return response()->json($result);
    }
}
