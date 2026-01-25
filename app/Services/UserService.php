<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Lấy thông tin user hiện tại
     *
     * @return \App\Models\User|null
     */
    public function getCurrentUser()
    {
        return Auth::user(); // trả về model User hoặc null nếu chưa login
    }

    /**
     * Lấy ID của user hiện tại
     *
     * @return int|null
     */
    public function getCurrentUserId()
    {
        return Auth::id(); // trả về ID hoặc null nếu chưa login
    }
}
