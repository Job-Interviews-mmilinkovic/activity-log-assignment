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
        <label for="email" style="display:block;font-size:0.85rem;margin-bottom:0.25rem">Email</label>
        <input type="text" name="email" id="email" value="<?= htmlspecialchars($filterEmail) ?>" style="padding:0.4rem;border:1px solid #ddd;border-radius:4px;width:200px">
    </div>
    <div>
        <label for="date_from" style="display:block;font-size:0.85rem;margin-bottom:0.25rem">From</label>
        <input type="date" name="date_from" id="date_from" value="<?= htmlspecialchars($filterDateFrom) ?>" style="padding:0.4rem;border:1px solid #ddd;border-radius:4px">
    </div>
    <div>
        <label for="date_to" style="display:block;font-size:0.85rem;margin-bottom:0.25rem">To</label>
        <input type="date" name="date_to" id="date_to" value="<?= htmlspecialchars($filterDateTo) ?>" style="padding:0.4rem;border:1px solid #ddd;border-radius:4px">
    </div>
    <button type="submit" style="padding:0.4rem 1rem;background:#4f46e5;color:#fff;border:none;border-radius:4px;cursor:pointer">Filter</button>
</form>

<table style="width:100%;border-collapse:collapse">
    <thead>
        <tr style="background:#f1f5f9;text-align:left">
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">User</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Email</th>
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
                    <td style="padding:0.5rem"><?= htmlspecialchars($log->user->name ?? 'Unknown') ?></td>
                    <td style="padding:0.5rem"><?= htmlspecialchars($log->user->email ?? '') ?></td>
                    <td style="padding:0.5rem"><?= htmlspecialchars($log->action) ?></td>
                    <td style="padding:0.5rem"><?= $log->created_at ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
