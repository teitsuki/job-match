<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\JobOfferView;
use App\Models\Occupation;
use Illuminate\Http\Request;
use App\Http\Requests\JobOfferRequest;
use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;

class JobOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $jobOffers = JobOffer::with(['company', 'occupation'])
        //     ->openData()->latest()->paginate(5);
        $params = $request->query();
        $jobOffers = JobOffer::search($params)
            ->openData()
            ->order($params)
            ->with(['company', 'occupation'])
            ->paginate(5);

        $occupation = $request->occupation;
        $jobOffers->appends(compact('occupation'));

        $search_occupation = empty($occupation) ? [] : ['occupation' => $occupation];
        $sort = empty($request->sort) ? [] : ['sort' => $request->sort];

        $occupations = Occupation::all();
        return view('job_offers.index')
            ->with(compact(
                'jobOffers',
                'occupations',
                'search_occupation',
                'sort',
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $occupations = Occupation::all();
        return view('job_offers.create', compact('occupations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\JobofferRequest  $JobofferRequest
     * @return \Illuminate\Http\Response
     */
    public function store(JobofferRequest $request)
    {
        $jobOffer = new JobOffer($request->all());
        $jobOffer->company_id = $request->user()->id;

        try {
            $jobOffer->save();
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors('求人情報登録処理でエラーが発生しました');
        }

        return redirect()
            ->route('job_offers.show', $jobOffer)
            ->with('notice', '求人情報を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Http\Response
     */
    public function show(JobOffer $jobOffer)
    {
        if (Auth::guard(UserConst::GUARD)->check()) {
            JobOfferView::updateOrCreate([
                'job_offer_id' => $jobOffer->id,
                'user_id' => Auth::user()->id,
            ]);
        }
        return view('job_offers.show', compact('jobOffer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(JobOffer $jobOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\JobofferRequest  $JobofferRequest
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Http\Response
     */
    public function update(JobofferRequest $JobofferRequest, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOffer $jobOffer)
    {
        //
    }
}
