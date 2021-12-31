<?php

namespace App\Policies;

use App\Models\JobOffer;
use App\Models\Company;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the company can view any models.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Company $company)
    {
        //
    }

    /**
     * Determine whether the company can view the model.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Company $company, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Determine whether the company can create models.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Company $company)
    {
        //
    }

    /**
     * Determine whether the company can update the model.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Company $company, JobOffer $jobOffer)
    {
        return $company->id === $jobOffer->company_id;
    }

    /**
     * Determine whether the company can delete the model.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Company $company, JobOffer $jobOffer)
    {
        return $company->id === $jobOffer->company_id;
    }

    /**
     * Determine whether the company can restore the model.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Company $company, JobOffer $jobOffer)
    {
        //
    }

    /**
     * Determine whether the company can permanently delete the model.
     *
     * @param  \App\Models\Company  $company
     * @param  \App\Models\JobOffer  $jobOffer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Company $company, JobOffer $jobOffer)
    {
        //
    }
}
