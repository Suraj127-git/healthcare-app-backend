<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcDoctor extends Model
{
    use HasFactory;

    protected $table = 'hc_doctors';

    protected $fillable = [
        'name',
        'speciality',
        'qualification',
        'experiance',
        'availability_status',
        'contact_number',
        'email',
        'clinic_address',
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