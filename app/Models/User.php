<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Organization;
use App\Models\ApplyFile;

class User extends Authenticatable
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'org_id',
        'name',
        'birthday',
        'email',
        'account',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function organization() {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function applyFiles() {
        return $this->hasMany(ApplyFile::class, 'user_id');
    }

}
