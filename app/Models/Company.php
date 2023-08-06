<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Company extends Authenticatable
{
    use HasFactory,
        HasApiTokens,
        HasUuids;

        protected $primaryKey = 'id';
        protected $keyType = 'string';
        public $incrementing = false;

        protected $fillable = [
            'name',
            'email',
            'logo',
            'password',
        ];
    
        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];
    
        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
}
