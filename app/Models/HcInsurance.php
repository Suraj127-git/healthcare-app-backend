<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcInsurance extends Model
{
    use HasFactory;

    protected $table = 'hc_insurance';

    protected $fillable = [
        'user_id',
        'insurance_type',
        'policy_name',
        'policy_number',
        'insurance_company',
        'start_date',
        'end_date',
        'premium_amount',
        'coverage_amount',
        'status',
        'created_date',
        'created_timestamp',
        'updated_timestamp',
    ];
    
    const CREATED_AT = 'created_timestamp';
    const UPDATED_AT = 'updated_timestamp';  

    public function user()
    {
        return $this->belongsTo(HcUser::class);
    }
}