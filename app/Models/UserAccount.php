<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserAccount extends Model
{
    use HasFactory;
    
    protected $table = 'user_account';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
