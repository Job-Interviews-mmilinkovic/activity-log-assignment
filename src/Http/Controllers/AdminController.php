<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Database\Capsule\Manager as Capsule;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ServerRequestInterface;

class AdminController extends BaseController
{
    private const TRACKED_ACTIONS = ['cow_page_visited', 'download_page_visited', 'buy_cow', 'download'];

    public function stats(ServerRequestInterface $request): HtmlResponse
    {
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');

        $params = $request->getQueryParams();

        if (!empty($params['action'])) {
            $query->where('action', $params['action']);
        }

        if (!empty($params['user_id'])) {
            $query->where('user_id', (int) $params['user_id']);
        }

        $logs = $query->get();

        return $this->render('admin/stats', [
            'logs'         => $logs,
            'filterAction' => $params['action'] ?? '',
            'filterUserId' => $params['user_id'] ?? '',
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
            ->whereIn('action', self::TRACKED_ACTIONS)
            ->groupBy(Capsule::raw('DATE(created_at)'), 'action')
            ->orderBy('date', 'desc')
            ->get();

        $dates = [];
        foreach ($rows as $row) {
            $date = $row->date;
            if (!isset($dates[$date])) {
                $dates[$date] = array_fill_keys(self::TRACKED_ACTIONS, 0);
            }
            $dates[$date][$row->action] = (int) $row->count;
        }

        return $this->render('admin/reports', ['dates' => $dates]);
    }
}
