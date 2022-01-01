<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\JobOffer;

class CompanyController extends Controller
{
    /**
     * dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        $params = $request->query();

        $jobOffers = JobOffer::latest()
            ->with('entries')
            ->MyJobOffer()
            ->searchStatus($params)
            ->paginate(5);

        return view('auth.company.dashboard', compact('jobOffers'));
    }
}
