<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\Action;
use App\Models\ActivityLog;
use Illuminate\Database\Capsule\Manager as Capsule;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class AdminController extends BaseController
{
    private const TRACKED_ACTIONS = [
        Action::CowPageVisited,
        Action::DownloadPageVisited,
        Action::BuyCow,
        Action::Download,
    ];

    public function stats(ServerRequestInterface $request): HtmlResponse
    {
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');

        $params = $request->getQueryParams();

        if (!empty($params['action'])) {
            $query->where('action', $params['action']);
        }

        if (!empty($params['email'])) {
            $query->whereHas('user', fn($q) => $q->where('email', 'like', '%' . $params['email'] . '%'));
        }

        if (!empty($params['date_from'])) {
            $query->where('created_at', '>=', $params['date_from'] . ' 00:00:00');
        }

        if (!empty($params['date_to'])) {
            $query->where('created_at', '<=', $params['date_to'] . ' 23:59:59');
        }

        $logs = $query->get();

        return $this->render('admin/stats', [
            'logs'         => $logs,
            'filterAction' => $params['action'] ?? '',
            'filterEmail'  => $params['email'] ?? '',
            'filterDateFrom' => $params['date_from'] ?? '',
            'filterDateTo'   => $params['date_to'] ?? '',
        ]);
    }

    public function reports(ServerRequestInterface $request): HtmlResponse
    {
        $rows = ActivityLog::query()
            ->select(
                Capsule::raw('DATE(created_at) as date'),
                'action',
                Capsule::raw('COUNT(*) as count'),
            )
            ->whereIn('action', array_map(fn(Action $a) => $a->value, self::TRACKED_ACTIONS))
            ->groupBy(Capsule::raw('DATE(created_at)'), 'action')
            ->orderBy('date', 'desc')
            ->get();

        $actionValues = array_map(fn(Action $a) => $a->value, self::TRACKED_ACTIONS);
        $dates = [];
        foreach ($rows as $row) {
            $date = $row->date;
            if (!isset($dates[$date])) {
                $dates[$date] = array_fill_keys($actionValues, 0);
            }
            $dates[$date][$row->action] = (int) $row->count;
        }

        return $this->render('admin/reports', ['dates' => $dates]);
    }
}
