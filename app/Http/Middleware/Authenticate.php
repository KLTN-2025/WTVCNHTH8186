<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Nếu URL chứa /admin → chuyển về trang login admin
            if ($request->is('admin/*')) {
                return route('login'); // hoặc route('admin.login') nếu bạn có
            }

            // Ngược lại → login user
            return route('user.login');
        }
    }
}
