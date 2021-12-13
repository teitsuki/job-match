<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'occupation_id',
        'due_date',
        'description',
    ];
    
    public function company()
    {
        return $this->belingsTo(Company::class);
    }

    public function occupation()
    {
        return $this->belingsTo(Occupation::class);
    }
}
