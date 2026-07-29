<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ServerRequestInterface;

class AdminController extends BaseController
{
    public function stats(ServerRequestInterface $request): \Laminas\Diactoros\Response\HtmlResponse
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

    public function reports(ServerRequestInterface $request): \Laminas\Diactoros\Response\HtmlResponse
    {
        $summary = ActivityLog::query()
            ->select('action', Capsule::raw('COUNT(*) as count'))
            ->groupBy('action')
            ->orderBy('count', 'desc')
            ->get();

        return $this->render('admin/reports', ['summary' => $summary]);
    }
}
