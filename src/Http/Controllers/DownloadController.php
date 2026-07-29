<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Bootstrap\Auth;
use App\Events\EventDispatcher;
use App\Events\UserDownloadedFileEvent;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Stream;
use Psr\Http\Message\ServerRequestInterface;

class DownloadController extends BaseController
{
    public function __construct(
        private readonly EventDispatcher $dispatcher,
    ) {
    }

    public function index(ServerRequestInterface $request): \Laminas\Diactoros\Response\HtmlResponse
    {
        return $this->render('download/index');
    }

    public function download(ServerRequestInterface $request): Response
    {
        $userId = (int) (Auth::instance()->getCurrentUser()['id'] ?? 0);

        $this->dispatcher->dispatch(new UserDownloadedFileEvent($userId));

        $body = "This is a dummy .exe file";

        $stream = new Stream('php://memory', 'wb+');
        $stream->write($body);

        return new Response(
            $stream,
            200,
            [
                'Content-Type'        => 'application/x-msdownload',
                'Content-Disposition' => 'attachment; filename="setup.exe"',
                'Content-Length'      => (string) strlen($body),
            ]
        );
    }
}
