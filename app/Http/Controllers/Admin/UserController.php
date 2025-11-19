<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filters
        if ($search = $request->query('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->query('role')) {
            if (in_array($role, ['admin', 'instructor', 'student'])) {
                $query->where('role', $role);
            }
        }

        if ($status = $request->query('status')) {
            if (in_array($status, ['active', 'inactive', 'alumni'])) {
                $query->where('status', $status);
            }
        }

        if (($tingkatan = $request->query('tingkatan')) !== null && $tingkatan !== '') {
            $query->where('angkatan', (int) $tingkatan);
        }

        // Export CSV if requested
        if ($request->query('export') === 'csv') {
            $exportQuery = clone $query;
            $filename = 'users-' . now()->format('Ymd_His') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];
            $callback = function () use ($exportQuery) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['ID', 'Name', 'Email', 'Role', 'Status', 'Created At']);
                $exportQuery->orderBy('id')->chunk(500, function ($rows) use ($handle) {
                    foreach ($rows as $u) {
                        fputcsv($handle, [
                            $u->id,
                            $u->name,
                            $u->email,
                            $u->role,
                            $u->status,
                            optional($u->created_at)->format('Y-m-d H:i:s'),
                        ]);
                    }
                });
                fclose($handle);
            };
            return response()->stream($callback, 200, $headers);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        // Stats
        $stats = [
            'students'    => User::where('role', 'student')->count(),
            'instructors' => User::where('role', 'instructor')->count(),
            'active'      => User::where('status', 'active')->count(),
            'admins'      => User::where('role', 'admin')->count(),
        ];

        $tingkatanOptions = User::whereNotNull('angkatan')
            ->select('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan')
            ->toArray();

        return view('admin.users', compact('users', 'stats', 'tingkatanOptions'));
    }

    public function create()
    {
        return view('admin.users-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
            'role' => ['required', Rule::in(['admin', 'instructor', 'student'])],
            'status' => ['required', Rule::in(['active', 'inactive', 'alumni'])],
            'nis' => ['nullable', 'string', 'max:20', 'unique:users,nis'],
            'angkatan' => ['nullable', 'integer'],
            'learning_level' => ['required', Rule::in(['umum', 'calon_paskibra', 'wiramuda', 'wiratama', 'instruktur_muda', 'instruktur'])],
            'avatar' => ['nullable', 'url'],
            'bio' => ['nullable', 'string'],
        ]);

        $user = new User();
        $user->fill(collect($data)->except(['password'])->toArray());
        $user->password = $data['password'];
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dibuat.');
    }

    public function edit(User $user)
    {
        return view('admin.users-edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'role' => ['required', Rule::in(['admin', 'instructor', 'student'])],
            'status' => ['required', Rule::in(['active', 'inactive', 'alumni'])],
            'nis' => ['nullable', 'string', 'max:20', Rule::unique('users', 'nis')->ignore($user->id)],
            'angkatan' => ['nullable', 'integer'],
            'learning_level' => ['required', Rule::in(['umum', 'calon_paskibra', 'wiramuda', 'wiratama', 'instruktur_muda', 'instruktur'])],
            'avatar' => ['nullable', 'url'],
            'bio' => ['nullable', 'string'],
        ]);

        $user->fill(collect($data)->except(['password'])->toArray());
        if (!empty($data['password'])) {
            $user->password = $data['password'];
        }
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
