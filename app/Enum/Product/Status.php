<?php

namespace App\Enum\Product;

enum Status: bool
{
    case ACTIVE = true;
    case INACTIVE = false;

}