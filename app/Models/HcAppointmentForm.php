<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcAppointmentForm extends Model
{
    use HasFactory;

    protected $table = 'hc_appointment_form';

    protected $fillable = [
        'user_id',
        'patient_name',
        'contact_number',
        'email',
        'appointment_date',
        'appointment_time',
        'department',
        'doctor',
        'notes',
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