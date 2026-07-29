<h1>Cow Page</h1>
<?php if ($bought): ?>
    <p>Thank you!</p>
<?php else: ?>
    <form method="post" action="/cow">
        <button type="submit" style="padding:0.75rem 2rem;font-size:1.1rem;background:#4f46e5;color:#fff;border:none;border-radius:4px;cursor:pointer">Buy a cow</button>
    </form>
<?php endif; ?>
