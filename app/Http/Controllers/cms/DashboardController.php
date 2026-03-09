<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $sessions = DB::table('user_sessions')->count();
        return view('cms.dashboard', compact('sessions'));
    }
}
