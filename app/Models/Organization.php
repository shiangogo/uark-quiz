<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'orgs';

    protected $fillable = [
        'title',
        'org_no',
    ];

    public function users() {
        return $this->hasMany(User::class, 'org_id');
    }
}
