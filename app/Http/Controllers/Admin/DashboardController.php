<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Message;
use App\Models\Portofolio;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects' => Portofolio::count(),
            'messages' => Message::count(),
            'certificates' => Certificate::count(),
            'experiences' => count(config('portfolio.experiences')),
        ];

        $recentProjects = Portofolio::latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentMessages'));
    }
}
