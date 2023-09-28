<?php

namespace App\Service\Filter\Interface;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface FilterInterface
{
    public function handle(): Builder;
}