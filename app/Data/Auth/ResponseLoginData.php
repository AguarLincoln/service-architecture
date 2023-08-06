<?php

namespace App\Data\Auth;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Data;

class ResponseLoginData extends Data
{
    public function __construct(
      private Model $user,
      private string $token,
    ) {}
}
