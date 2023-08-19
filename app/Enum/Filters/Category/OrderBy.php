<?php

namespace App\Enum\Filters\Category;

enum OrderBy: string
{
    case NAME = 'name';
    case CREATED = 'created_at';

}
