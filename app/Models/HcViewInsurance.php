<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcViewInsurance extends Model
{
    use HasFactory;

    protected $table = 'hc_view_insurance';

    protected $fillable = [
        'user_id',
        'insurance_count',
        'active_policies',
        'total_premium',
        'total_coverage',
        'updated_timestamp',
        'is_show_flag',
    ];

    public function user()
    {
        return $this->belongsTo(HcUser::class, 'user_id');
    }
}