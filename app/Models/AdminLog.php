<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    use HasFactory;

    protected $table = 'admin_logs';

    protected $fillable = [
        'admin_id',          // ID người thực hiện hành động
        'user_name',         // Tên hiển thị (cache để không mất khi user bị xóa)
        'action',            // Loại hành động (create/update/delete/login...)
        'description',       // Nội dung chi tiết
        'ip_address',        // IP thực hiện
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /** 
     * Quan hệ tới bảng users (admin thực hiện)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Tạo nhanh log mới
     */
    public static function record($action, $description = null)
    {
        $admin = auth()->user();

        self::create([
            'admin_id'   => $admin?->id,
            'user_name'  => $admin?->name ?? 'Hệ thống',
            'action'     => $action,
            'description'=> $description,
            'ip_address' => request()->ip(),
        ]);
    }
}
