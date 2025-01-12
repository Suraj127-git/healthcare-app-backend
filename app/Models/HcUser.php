<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HcUser extends Model
{
    use HasFactory;

    protected $table = 'hc_user';

    protected $fillable = [
        'name',
        'mobile_no',
        'email',
        'password',
        'created_date',
        'created_timestamp',
        'updated_timestamp',
        'is_show_flag',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}