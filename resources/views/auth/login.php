<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; background: #f5f5f5; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); width: 360px; }
        h1 { margin-top: 0; }
        label { display: block; margin-bottom: 0.25rem; }
        input { width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 0.75rem; background: #4f46e5; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: #dc2626; margin-bottom: 1rem; }
        p { text-align: center; }
        a { color: #4f46e5; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Login</h1>
        <?php if (isset($error)): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post" action="/login">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="/register">Register</a></p>
    </div>
</body>
</html>
