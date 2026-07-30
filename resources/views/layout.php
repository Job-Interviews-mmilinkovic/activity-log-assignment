<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Activity Log</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: sans-serif; background: #f5f5f5; }
        nav { background: #1e293b; padding: 0.75rem 1.5rem; display: flex; gap: 1.5rem; align-items: center; }
        nav a, nav button { color: #fff; text-decoration: none; font-size: 0.9rem; }
        nav a:hover { text-decoration: underline; }
        nav .brand { font-weight: bold; font-size: 1.1rem; margin-right: auto; }
        nav button { background: none; border: 1px solid #fff; padding: 0.25rem 0.75rem; border-radius: 4px; cursor: pointer; }
        main { max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .error { color: #dc2626; margin-bottom: 1rem; }
        .flash { color: #16a34a; margin-bottom: 1rem; }
        h1 { margin-bottom: 1rem; }
        p { margin-bottom: 0.75rem; }
    </style>
</head>
<body>
    <nav>
        <span class="brand">Activity Log</span>
        <a href="/">Home</a>
        <a href="/cow">Cow Page</a>
        <a href="/download">Download</a>
        <?php if ($isAdmin): ?>
            <a href="/admin/stats">Stats</a>
            <a href="/admin/reports">Reports</a>
        <?php endif; ?>
        <form method="post" action="/logout" style="display:inline">
            <?= csrf_field() ?>
            <button type="submit">Logout</button>
        </form>
    </nav>
    <main>
        <div class="card">
            <?= $content ?>
        </div>
    </main>
</body>
</html>
