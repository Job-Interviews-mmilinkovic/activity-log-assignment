<h1>Welcome, <?= htmlspecialchars($currentUser['name'] ?? 'Guest') ?></h1>
<p>Logged in as: <?= htmlspecialchars($currentUser['email'] ?? '') ?></p>
<p>Use the navigation menu to access the pages.</p>
