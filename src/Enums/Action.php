<?php

declare(strict_types=1);

namespace App\Enums;

enum Action: string
{
    case BuyCow = 'buy_cow';
    case Download = 'download';
}
