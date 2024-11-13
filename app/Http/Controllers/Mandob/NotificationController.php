<?php

namespace App\Http\Controllers\Mandob;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->paginate(10)->map(function ($notification) {
            $data = $notification->data;
            $data['message'] = json_decode($data['message'], true);
            return [
                'data' => $data,
            ];
        });

        return response()->json([
            'notifications' => $notifications,
        ]);
    }
}
