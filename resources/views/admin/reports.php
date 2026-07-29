<h1>Activity Reports</h1>

<h2 style="margin-bottom:0.75rem">Chart</h2>
<div style="display:flex;gap:1rem;align-items:end;padding:1rem 0;min-height:200px;overflow-x:auto">
    <?php
    $actions = ['cow_page_visited', 'download_page_visited', 'buy_cow', 'download'];
    $labels  = ['Cow Page Views', 'Download Page Views', 'Buy Cow Clicks', 'Download Clicks'];
    $colors  = ['#4f46e5', '#16a34a', '#dc2626', '#f59e0b'];
    $totals  = [];
    foreach ($actions as $i => $action) {
        $totals[$action] = array_sum(array_column($dates, $action));
    }
    $max = max($totals) ?: 1;
    ?>
    <?php foreach ($actions as $i => $action): ?>
        <?php $pct = ($totals[$action] / $max) * 100; ?>
        <div style="flex:1;text-align:center;min-width:80px">
            <div style="height:<?= max($pct, 5) ?>px;background:<?= $colors[$i] ?>;border-radius:4px 4px 0 0"></div>
            <div style="margin-top:0.5rem;font-size:0.85rem"><?= $labels[$i] ?></div>
            <div style="font-size:0.8rem;color:#64748b"><?= $totals[$action] ?></div>
        </div>
    <?php endforeach; ?>
</div>

<h2 style="margin-bottom:0.75rem;margin-top:2rem">Table</h2>
<table style="width:100%;border-collapse:collapse">
    <thead>
        <tr style="background:#f1f5f9;text-align:left">
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Date</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Cow Page Views</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Download Page Views</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Buy Cow</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Download</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($dates)): ?>
            <tr><td colspan="6" style="padding:1rem;text-align:center;color:#94a3b8">No activity yet</td></tr>
        <?php else: ?>
            <?php foreach ($dates as $date => $counts): ?>
                <tr style="border-bottom:1px solid #f1f5f9">
                    <td style="padding:0.5rem"><?= htmlspecialchars($date) ?></td>
                    <td style="padding:0.5rem"><?= $counts['cow_page_visited'] ?></td>
                    <td style="padding:0.5rem"><?= $counts['download_page_visited'] ?></td>
                    <td style="padding:0.5rem"><?= $counts['buy_cow'] ?></td>
                    <td style="padding:0.5rem"><?= $counts['download'] ?></td>
                    <td style="padding:0.5rem;font-weight:bold"><?= array_sum($counts) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
