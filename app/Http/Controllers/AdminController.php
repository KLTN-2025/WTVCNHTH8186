<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Major;
use App\Models\University;
use App\Models\AdminLog;
use App\Models\SurveyResult;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Trang tổng quan quản trị
     */
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_majors' => Major::count(),
            'total_universities' => University::count(),
            'total_surveys' => SurveyResult::count(),
        ];

        $latest_logs = AdminLog::orderByDesc('created_at')->take(10)->get();

        return view('admin.dashboard', compact('stats', 'latest_logs'));
    }
    /**
     * Xem log hành động admin
     */
    public function logs(Request $request)
    {
        $keyword = $request->input('keyword');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $query = AdminLog::query();

        // Tìm theo từ khóa
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('action', 'like', "%{$keyword}%")
                ->orWhere('user_name', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%")
                ->orWhere('ip_address', 'like', "%{$keyword}%");
            });
        }

        // Lọc theo thời gian
        if (!empty($fromDate) && !empty($toDate)) {
            $query->whereBetween('created_at', [
                $fromDate . ' 00:00:00',
                $toDate . ' 23:59:59'
            ]);
        } elseif (!empty($fromDate)) {
            $query->whereDate('created_at', '>=', $fromDate);
        } elseif (!empty($toDate)) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        $logs = $query->orderByDesc('created_at')
                    ->paginate(20)
                    ->appends($request->all());

        return view('admin.logs.index', compact('logs', 'keyword', 'fromDate', 'toDate'));
    }
}
