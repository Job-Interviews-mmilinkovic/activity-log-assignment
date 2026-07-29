<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class CowController extends BaseController
{
    public function index(ServerRequestInterface $request): HtmlResponse
    {
        return $this->render('cow/index', ['bought' => false]);
    }

    public function buy(ServerRequestInterface $request): HtmlResponse
    {
        $userId = (int) (\App\Bootstrap\Auth::instance()->getCurrentUser()['id'] ?? 0);

//        ActivityLog::create([
//            'user_id' => $userId,
//            'action'  => 'buy_cow',
//        ]);

        return $this->render('cow/index', ['bought' => true]);
    }
}
