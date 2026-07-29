<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Bootstrap\Auth;
use App\Models\User;
use App\Services\ValidationService\Contracts\ValidatorServiceInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;

class AuthController
{
    public function __construct(
        private readonly ValidatorServiceInterface $validator,
    ) {
    }

    public function loginForm(): HtmlResponse
    {
        return $this->render('auth/login');
    }

    public function login(ServerRequestInterface $request): HtmlResponse|RedirectResponse
    {
        $result = $this->validator->validateLogin($request->getParsedBody());

        if (!$result->isValid()) {
            return $this->render('auth/login', ['error' => $result->getFirstError()]);
        }

        $dto = $result->getData();
        $authResult = Auth::instance()->login($dto->email, $dto->password);

        if ($authResult['error']) {
            return $this->render('auth/login', ['error' => $authResult['message']]);
        }

        return new RedirectResponse('/');
    }

    public function registerForm(): HtmlResponse
    {
        return $this->render('auth/register');
    }

    public function register(ServerRequestInterface $request): HtmlResponse|RedirectResponse
    {
        $result = $this->validator->validateRegister($request->getParsedBody());

        if (!$result->isValid()) {
            return $this->render('auth/register', ['error' => $result->getFirstError()]);
        }

        $dto = $result->getData();

        if (User::where('email', $dto->email)->exists()) {
            return $this->render('auth/register', ['error' => 'Email is already taken.']);
        }

        User::create([
            'email'    => $dto->email,
            'password' => password_hash($dto->password, PASSWORD_BCRYPT, ['cost' => 10]),
            'name'     => $dto->name,
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
