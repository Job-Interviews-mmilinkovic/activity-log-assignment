<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Bootstrap\Auth;
use App\Models\User;
use Laminas\Diactoros\Response\HtmlResponse;

abstract class BaseController
{
    protected function render(string $view, array $data = []): HtmlResponse
    {
        $auth = Auth::instance();
        $currentUser = $auth->isLogged() ? $auth->getCurrentUser() : null;

        $isAdmin = false;
        if ($currentUser) {
            $user = User::find($currentUser['id']);
            $isAdmin = $user && $user->role && $user->role->name === 'admin';
        }

        $data['currentUser'] = $currentUser;
        $data['isAdmin'] = $isAdmin;

        extract($data);
        ob_start();
        require __DIR__ . "/../../../resources/views/{$view}.php";
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . "/../../../resources/views/layout.php";
        $output = ob_get_clean();

        return new HtmlResponse($output);
    }
}
