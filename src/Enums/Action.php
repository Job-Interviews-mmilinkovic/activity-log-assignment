<?php

declare(strict_types=1);

namespace App\Enums;

enum Action: string
{
    case Login = 'login';
    case Logout = 'logout';
    case Register = 'register';
    case CowPageVisited = 'cow_page_visited';
    case DownloadPageVisited = 'download_page_visited';
    case BuyCow = 'buy_cow';
    case Download = 'download';
}
