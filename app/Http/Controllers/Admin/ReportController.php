<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('creator')->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'filters' => 'nullable',
        ]);

        $report = new Report();
        $report->fill([
            'title' => $data['title'],
            'type' => $data['type'],
            'period_start' => $data['period_start'] ?? null,
            'period_end' => $data['period_end'] ?? null,
            'filters' => $this->parseFilters($request->input('filters')),
            'created_by' => auth()->id(),
        ]);
        $report->save();

        return redirect()->route('admin.reports.index')->with('success', 'Report preset dibuat.');
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'period_start' => 'nullable|date',
            'period_end' => 'nullable|date|after_or_equal:period_start',
            'filters' => 'nullable',
        ]);

        $report->update([
            'title' => $data['title'],
            'type' => $data['type'],
            'period_start' => $data['period_start'] ?? null,
            'period_end' => $data['period_end'] ?? null,
            'filters' => $this->parseFilters($request->input('filters')),
        ]);

        return redirect()->route('admin.reports.index')->with('success', 'Report preset diperbarui.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Report preset dihapus.');
    }

    private function parseFilters($filters)
    {
        if (is_array($filters)) return $filters;
        if (is_string($filters)) {
            $json = json_decode($filters, true);
            return json_last_error() === JSON_ERROR_NONE ? $json : null;
        }
        return null;
    }
}

