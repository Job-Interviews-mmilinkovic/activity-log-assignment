<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Bootstrap\Auth;
use App\Bootstrap\DatabaseManager;
use Illuminate\Database\Capsule\Manager as Capsule;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;

class AuthController
{
    public function loginForm(): HtmlResponse
    {
        return $this->render('auth/login');
    }

    public function login(ServerRequestInterface $request): HtmlResponse|RedirectResponse
    {
        $body = $request->getParsedBody();
        $email = $body['email'] ?? '';
        $password = $body['password'] ?? '';

        $result = Auth::instance()->login($email, $password);

        if ($result['error']) {
            return $this->render('auth/login', ['error' => $result['message']]);
        }

        return new RedirectResponse('/');
    }

    public function registerForm(): HtmlResponse
    {
        return $this->render('auth/register');
    }

    public function register(ServerRequestInterface $request): HtmlResponse|RedirectResponse
    {
        $body = $request->getParsedBody();
        $email = $body['email'] ?? '';
        $password = $body['password'] ?? '';
        $repeat = $body['password_repeat'] ?? '';
        $name = $body['name'] ?? '';

        if ($password !== $repeat) {
            return $this->render('auth/register', ['error' => 'Passwords do not match.']);
        }

        if (strlen($password) < 3) {
            return $this->render('auth/register', ['error' => 'Password must be at least 3 characters.']);
        }

        DatabaseManager::boot();

        $existing = Capsule::table('users')->where('email', $email)->first();
        if ($existing) {
            return $this->render('auth/register', ['error' => 'Email is already taken.']);
        }

        Capsule::table('users')->insert([
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]),
            'name'     => $name,
            'role_id'  => 2,
            'isactive' => 1,
        ]);

        return new RedirectResponse('/login');
    }

    public function logout(): RedirectResponse
    {
        $auth = Auth::instance();
        $hash = $auth->getCurrentSessionHash();
        $auth->logout($hash);

        return new RedirectResponse('/login');
    }

    private function render(string $view, array $data = []): HtmlResponse
    {
        extract($data);
        ob_start();
        require __DIR__ . "/../../../resources/views/{$view}.php";
        $content = ob_get_clean();
        return new HtmlResponse($content);
    }
}
