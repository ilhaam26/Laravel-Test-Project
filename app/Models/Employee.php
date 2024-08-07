<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Province;
use App\Models\City;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = true;
    use SoftDeletes;
    protected $table = 'employee';

    protected $fillable = ['first_name', 'last_name','email','phone_number','date_of_birth','province','city','street','zip_code','ktp_number','ktp_photo','current_position','bank_account','bank_account_number'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
