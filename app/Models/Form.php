<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_date',
        'request_details',
        'status',
        'guest_salutation',
        'guest_name',
        'guest_age',
        'guest_occupation',
        'guest_phone',
        'guest_house_number',
        'guest_village',
        'guest_subdistrict',
        'guest_district',
        'guest_province',
        'start_date',
        'end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function items()
    {
        return $this->hasMany(FormItem::class);
    }
}
