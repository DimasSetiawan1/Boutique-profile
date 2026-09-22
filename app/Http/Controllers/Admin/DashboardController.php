<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\TeamMember;
use App\Models\Philosophy;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard.
     */
    public function index()
    {
        $stats = [
            'philosophies' => Philosophy::count(),
            'services' => Service::count(),
            'portfolios' => Portfolio::count(),
            'team_members' => TeamMember::count(),
            'messages_total' => ContactMessage::count(),
            'messages_unread' => ContactMessage::where('status', 'unread')->count(),
        ];

        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }
}
