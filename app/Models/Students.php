<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;



class Students extends Model
{
    use HasFactory;


    protected $fillable = [

        'full_name' ,
        'email',
        'password',
        'phone_number',
        'country_code',
        'country',
        'gender',
        'is_married',
        'have_child'
    ];




}
