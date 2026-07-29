<h1>Activity Stats</h1>

<form method="get" style="margin-bottom:1.5rem;display:flex;gap:0.75rem;align-items:end;flex-wrap:wrap">
    <div>
        <label for="action" style="display:block;font-size:0.85rem;margin-bottom:0.25rem">Action</label>
        <select name="action" id="action" style="padding:0.4rem;border:1px solid #ddd;border-radius:4px">
            <option value="">All</option>
            <option value="buy_cow" <?= ($filterAction === 'buy_cow') ? 'selected' : '' ?>>Buy Cow</option>
            <option value="download" <?= ($filterAction === 'download') ? 'selected' : '' ?>>Download</option>
        </select>
    </div>
    <div>
        <label for="user_id" style="display:block;font-size:0.85rem;margin-bottom:0.25rem">User ID</label>
        <input type="number" name="user_id" id="user_id" value="<?= htmlspecialchars((string) $filterUserId) ?>" style="padding:0.4rem;border:1px solid #ddd;border-radius:4px;width:100px">
    </div>
    <button type="submit" style="padding:0.4rem 1rem;background:#4f46e5;color:#fff;border:none;border-radius:4px;cursor:pointer">Filter</button>
</form>

<table style="width:100%;border-collapse:collapse">
    <thead>
        <tr style="background:#f1f5f9;text-align:left">
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">ID</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">User</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Action</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($logs)): ?>
            <tr><td colspan="4" style="padding:1rem;text-align:center;color:#94a3b8">No activity yet</td></tr>
        <?php else: ?>
            <?php foreach ($logs as $log): ?>
                <tr style="border-bottom:1px solid #f1f5f9">
                    <td style="padding:0.5rem"><?= $log->id ?></td>
                    <td style="padding:0.5rem"><?= htmlspecialchars($log->user->name ?? 'Unknown') ?></td>
                    <td style="padding:0.5rem"><?= htmlspecialchars($log->action) ?></td>
                    <td style="padding:0.5rem"><?= $log->created_at ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
