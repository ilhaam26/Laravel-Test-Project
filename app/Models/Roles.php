<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    protected $table = 'roles';

    public $timestamps = true;

    protected $perPage = 20;

    protected $fillable = ['name', 'guard_name'];

    public function user()
    {
        return $this->hasMany(User::class,'id');
    }

}
