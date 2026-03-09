<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProgressController extends Controller
{
    public function index()
    {

        $totalSessions  =   DB::table('user_sessions')->count();
        $speakingAvg    =   DB::table('user_sessions')->where('type','speaking')->avg('score');
        $listeningAvg   =   DB::table('user_sessions')->where('type','listening')->avg('score');
        $readingAvg     =   DB::table('user_sessions')->where('type','reading')->avg('score');
        $recent         =   DB::table('user_sessions')->latest()->limit(10)->get();

        return view('cms.progress',[
            'totalSessions'=>$totalSessions,
            'speakingAvg'=>round($speakingAvg),
            'listeningAvg'=>round($listeningAvg),
            'readingAvg'=>round($readingAvg),
            'recent'=>$recent
        ]);
    }
}
