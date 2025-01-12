<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcDonationHistory extends Model
{
    use HasFactory;

    protected $table = 'hc_donation_history';

    protected $fillable = [
        'user_id',
        'donation_type',
        'purpose',
        'donation_amount',
        'donation_date',
        'payment_method',
        'transaction_id',
        'status',
        'created_date',
        'created_timestamp',
        'updated_timestamp',
        'is_show_flag',
    ];

    const CREATED_AT = 'created_timestamp';
    const UPDATED_AT = 'updated_timestamp';

    public function user()
    {
        return $this->belongsTo(HcUser::class, 'user_id');
    }
}