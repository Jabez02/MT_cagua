<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get list of admin users for chat selection
     */
    public function index()
    {
        $admins = User::where('usertype', 'admin')
                     ->select('id', 'name', 'email')
                     ->orderBy('name')
                     ->get();

        return response()->json([
            'admins' => $admins
        ]);
    }
}
