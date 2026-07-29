<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Bootstrap\Auth;
use App\Events\EventDispatcher;
use App\Events\UserLoggedInEvent;
use App\Events\UserLoggedOutEvent;
use App\Events\UserRegisteredEvent;
use App\Managers\Users\DTO\StoreUserDTO;
use App\Managers\Users\UserStoreManager;
use App\Models\User;
use App\Services\ValidationService\Contracts\ValidatorServiceInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ServerRequestInterface;

class AuthController
{
    public function __construct(
        private readonly ValidatorServiceInterface $validator,
        private readonly UserStoreManager $userStore,
        private readonly EventDispatcher $dispatcher,
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

        $data = $result->getData();
        $authResult = Auth::instance()->login($data['email'], $data['password']);

        if ($authResult['error']) {
            return $this->render('auth/login', ['error' => $authResult['message']]);
        }

        $currentUser = Auth::instance()->getCurrentUser();
        $this->dispatcher->dispatch(new UserLoggedInEvent((int) ($currentUser['id'] ?? 0)));

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

        $data = $result->getData();

        if (User::where('email', $data['email'])->exists()) {
            return $this->render('auth/register', ['error' => 'Email is already taken.']);
        }

        $user = $this->userStore->store(new StoreUserDTO(...$data));

        $this->dispatcher->dispatch(new UserRegisteredEvent($user->id));

        return new RedirectResponse('/login');
    }

    public function logout(): RedirectResponse
    {
        $auth = Auth::instance();
        $user = $auth->getCurrentUser();
        $hash = $auth->getCurrentSessionHash();

        if ($user) {
            $this->dispatcher->dispatch(new UserLoggedOutEvent((int) $user['id']));
        }

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
