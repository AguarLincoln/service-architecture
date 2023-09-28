<?php

namespace App\Service\Filter\Enum;

enum FilterEnum: string
{
    case ORDER_BY = 'order_by';
    case ORDER_BY = 'order_by_type';
    case SEARCH = 'search';
    case SEARCH_FIELDS = 'search_fields';
    
}