<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements.
     */
    public function index(Request $request)
    {
        $query = Announcement::with('creator')
            ->active()
            ->published()
            ->latest('published_at');

        // Filter by type if specified
        if ($request->has('type') && $request->type !== 'all') {
            $query->byType($request->type);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $announcements = $query->paginate(10);

        // Get pinned announcements separately
        $pinnedAnnouncements = Announcement::with('creator')
            ->active()
            ->published()
            ->pinned()
            ->latest('published_at')
            ->take(3)
            ->get();

        // Get announcement types for filter
        $types = [
            'all' => 'Semua',
            'urgent' => 'Mendesak',
            'important' => 'Penting',
            'general' => 'Umum',
            'event' => 'Kegiatan',
        ];

        return view('announcements.index', compact(
            'announcements', 
            'pinnedAnnouncements', 
            'types'
        ));
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        // Check if announcement is active and published
        if (!$announcement->is_active || !$announcement->isPublished()) {
            abort(404);
        }

        // Get related announcements
        $relatedAnnouncements = Announcement::with('creator')
            ->active()
            ->published()
            ->where('id', '!=', $announcement->id)
            ->where('type', $announcement->type)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('announcements.show', compact('announcement', 'relatedAnnouncements'));
    }

    /**
     * Display announcements by type.
     */
    public function byType($type)
    {
        $validTypes = ['urgent', 'important', 'general', 'event'];
        
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        $announcements = Announcement::with('creator')
            ->active()
            ->published()
            ->byType($type)
            ->latest('published_at')
            ->paginate(10);

        $typeDisplay = [
            'urgent' => 'Pengumuman Mendesak',
            'important' => 'Pengumuman Penting',
            'general' => 'Pengumuman Umum',
            'event' => 'Pengumuman Kegiatan',
        ];

        $title = $typeDisplay[$type] ?? 'Pengumuman';

        return view('announcements.type', compact('announcements', 'type', 'title'));
    }
}