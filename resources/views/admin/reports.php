<h1>Activity Reports</h1>

<h2 style="margin-bottom:0.75rem">Summary</h2>
<table style="width:100%;border-collapse:collapse;margin-bottom:2rem">
    <thead>
        <tr style="background:#f1f5f9;text-align:left">
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Action</th>
            <th style="padding:0.5rem;border-bottom:2px solid #e2e8f0">Count</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($summary as $row): ?>
            <tr style="border-bottom:1px solid #f1f5f9">
                <td style="padding:0.5rem"><?= htmlspecialchars($row->action) ?></td>
                <td style="padding:0.5rem"><?= $row->count ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h2 style="margin-bottom:0.75rem">Chart</h2>
<div style="display:flex;gap:1rem;align-items:end;padding:1rem 0;min-height:200px">
    <?php
    $max = max(array_column($summary, 'count'));
    $colors = ['#4f46e5', '#dc2626', '#16a34a', '#f59e0b'];
    ?>
    <?php foreach ($summary as $i => $row): ?>
        <?php $pct = $max > 0 ? ($row->count / $max) * 100 : 0; ?>
        <div style="flex:1;text-align:center">
            <div style="height:<?= max($pct, 5) ?>px;background:<?= $colors[$i % count($colors)] ?>;border-radius:4px 4px 0 0;min-width:60px"></div>
            <div style="margin-top:0.5rem;font-size:0.85rem"><?= htmlspecialchars($row->action) ?></div>
            <div style="font-size:0.8rem;color:#64748b"><?= $row->count ?></div>
        </div>
    <?php endforeach; ?>
</div>
