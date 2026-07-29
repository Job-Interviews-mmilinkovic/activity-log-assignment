<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Bootstrap\Auth;
use App\Events\CowPageVisitedEvent;
use App\Events\EventDispatcher;
use App\Events\UserBoughtCowEvent;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class CowController extends BaseController
{
    private const PAGE_A = 'page_a';

    public function __construct(
        private readonly EventDispatcher $dispatcher,
    ) {
    }

    public function index(ServerRequestInterface $request): HtmlResponse
    {
        $userId = (int) (Auth::instance()->getCurrentUser()['id'] ?? 0);
        $this->dispatcher->dispatch(new CowPageVisitedEvent($userId));

        return $this->render('cow/index', ['bought' => false]);
    }

    public function buy(ServerRequestInterface $request): HtmlResponse
    {
        $userId = (int) (Auth::instance()->getCurrentUser()['id'] ?? 0);

        $this->dispatcher->dispatch(new UserBoughtCowEvent($userId));

        return $this->render('cow/index', ['bought' => true]);
    }
}
