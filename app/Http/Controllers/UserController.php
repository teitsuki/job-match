<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Consts\UserConst;

class UserController extends Controller
{
    /**
     * dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $jobOffers = JobOffer::whereHas('entries', function ($query) {
            $query->where('user_id', Auth::guard(UserConst::GUARD)->user()->id);
        })->get();

        return view('auth.user.dashboard', compact('jobOffers'));
    }
}
