<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcement::with('creator');

        $search = trim((string) $request->get('search', ''));
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $type = (string) $request->get('type', 'all');
        if ($type !== '' && $type !== 'all') {
            $query->where('type', $type);
        }

        $status = (string) $request->get('status', 'all');
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $pin = (string) $request->get('pin', 'all');
        if ($pin === 'pinned') {
            $query->where('is_pinned', true);
        } elseif ($pin === 'unpinned') {
            $query->where('is_pinned', false);
        }

        $announcements = $query->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(12)
            ->appends($request->query());

        return view('admin.reports.index', [
            'announcements' => $announcements,
            'typeOptions' => $this->announcementTypes(),
            'filters' => [
                'search' => $search,
                'type' => $type,
                'status' => $status,
                'pin' => $pin,
            ],
        ]);
    }

    public function create()
    {
        return view('admin.reports.create', [
            'typeOptions' => $this->announcementTypes(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateAnnouncement($request);

        Announcement::create($data + [
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.reports.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function edit(Announcement $report)
    {
        return view('admin.reports.edit', [
            'announcement' => $report,
            'typeOptions' => $this->announcementTypes(),
        ]);
    }

    public function update(Request $request, Announcement $report)
    {
        $data = $this->validateAnnouncement($request);

        $report->update($data);

        return redirect()->route('admin.reports.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $report)
    {
        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Pengumuman dihapus.');
    }

    private function validateAnnouncement(Request $request): array
    {
        $typeOptions = array_keys($this->announcementTypes());

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in($typeOptions)],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'is_pinned' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_pinned'] = $request->boolean('is_pinned');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['published_at'] = $validated['published_at']
            ? Carbon::parse($validated['published_at'])
            : Carbon::now();

        return $validated;
    }

    private function announcementTypes(): array
    {
        return [
            'urgent' => 'Mendesak',
            'important' => 'Penting',
            'general' => 'Umum',
            'event' => 'Kegiatan',
        ];
    }
}
