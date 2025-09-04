<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Sample notification data - in a real application, this would come from a database
        $notifications = [
            [
                'id' => 1,
                'type' => 'announcement',
                'title' => 'Pengumuman Baru: Latihan Rutin Minggu Ini',
                'message' => 'Latihan rutin akan dilaksanakan pada hari Sabtu, 4 Januari 2025 pukul 07:00 WIB di lapangan sekolah. Harap membawa perlengkapan lengkap.',
                'icon' => 'megaphone',
                'color' => 'blue',
                'is_read' => false,
                'created_at' => '2024-01-03 12:30:00',
                'action_url' => '/announcements',
                'action_text' => 'Lihat Pengumuman'
            ],
            [
                'id' => 2,
                'type' => 'quiz_completed',
                'title' => 'Quiz "Sejarah PASKIBRA" Selesai',
                'message' => 'Selamat! Anda telah menyelesaikan quiz dengan nilai 85%. Hasil ini sudah tercatat dalam sistem.',
                'icon' => 'check-circle',
                'color' => 'green',
                'is_read' => false,
                'created_at' => '2024-01-03 09:45:00',
                'action_url' => '/quizzes-history',
                'action_text' => 'Lihat Hasil'
            ],
            [
                'id' => 3,
                'type' => 'reminder',
                'title' => 'Reminder: Deadline Tugas Besok',
                'message' => 'Jangan lupa untuk mengumpulkan tugas "Analisis Gerakan PBB" sebelum pukul 23:59 besok.',
                'icon' => 'exclamation-triangle',
                'color' => 'yellow',
                'is_read' => false,
                'created_at' => '2024-01-02 16:00:00',
                'action_url' => '/courses/1',
                'action_text' => 'Lihat Tugas'
            ],
            [
                'id' => 4,
                'type' => 'achievement',
                'title' => 'Badge Baru: Quiz Master!',
                'message' => 'Selamat! Anda telah meraih badge "Quiz Master" karena berhasil mendapat nilai 90+ pada 5 quiz berturut-turut.',
                'icon' => 'trophy',
                'color' => 'purple',
                'is_read' => false,
                'created_at' => '2024-01-02 14:20:00',
                'action_url' => '/achievements',
                'action_text' => 'Lihat Badge'
            ],
            [
                'id' => 5,
                'type' => 'course',
                'title' => 'Materi Baru: "Teknik Dasar PBB"',
                'message' => 'Materi pembelajaran baru telah ditambahkan ke kursus "Dasar-dasar Paskibra". Silakan pelajari materi terbaru ini.',
                'icon' => 'book-open',
                'color' => 'indigo',
                'is_read' => true,
                'created_at' => '2024-01-01 10:15:00',
                'action_url' => '/courses/1',
                'action_text' => 'Pelajari Sekarang'
            ],
            [
                'id' => 6,
                'type' => 'ranking',
                'title' => 'Naik Peringkat!',
                'message' => 'Selamat! Peringkat Anda naik dari #5 ke #4 dalam ranking kelas. Pertahankan prestasi Anda!',
                'icon' => 'trending-up',
                'color' => 'green',
                'is_read' => true,
                'created_at' => '2023-12-31 15:30:00',
                'action_url' => '/rankings',
                'action_text' => 'Lihat Ranking'
            ],
            [
                'id' => 7,
                'type' => 'system',
                'title' => 'Pemeliharaan Sistem Terjadwal',
                'message' => 'Sistem akan menjalani pemeliharaan pada Minggu, 7 Januari 2025 pukul 02:00-04:00 WIB. Layanan mungkin tidak tersedia sementara.',
                'icon' => 'cog',
                'color' => 'gray',
                'is_read' => true,
                'created_at' => '2023-12-30 09:00:00',
                'action_url' => null,
                'action_text' => null
            ]
        ];

        return view('notifications.index', compact('notifications'));
    }

    public function getUnreadCount()
    {
        // In a real application, this would query the database
        $unreadCount = 4; // Sample count
        
        return response()->json(['count' => $unreadCount]);
    }

    public function markAsRead($id)
    {
        // In a real application, this would update the database
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        // In a real application, this would update all notifications for the user
        return response()->json(['success' => true]);
    }

    public function getRecent()
    {
        // Sample recent notifications for dropdown
        $notifications = [
            [
                'id' => 1,
                'type' => 'announcement',
                'title' => 'Pengumuman Baru: Latihan Rutin Minggu Ini',
                'message' => 'Latihan rutin akan dilaksanakan pada hari Sabtu, 4 Januari 2025 pukul 07:00 WIB.',
                'icon' => 'megaphone',
                'color' => 'blue',
                'is_read' => false,
                'created_at' => '2024-01-03 12:30:00',
                'time_ago' => '2 jam yang lalu'
            ],
            [
                'id' => 2,
                'type' => 'quiz_completed',
                'title' => 'Quiz "Sejarah PASKIBRA" Selesai',
                'message' => 'Selamat! Anda telah menyelesaikan quiz dengan nilai 85%.',
                'icon' => 'check-circle',
                'color' => 'green',
                'is_read' => false,
                'created_at' => '2024-01-03 09:45:00',
                'time_ago' => '5 jam yang lalu'
            ],
            [
                'id' => 3,
                'type' => 'reminder',
                'title' => 'Reminder: Deadline Tugas Besok',
                'message' => 'Jangan lupa untuk mengumpulkan tugas "Analisis Gerakan PBB" sebelum pukul 23:59.',
                'icon' => 'exclamation-triangle',
                'color' => 'yellow',
                'is_read' => false,
                'created_at' => '2024-01-02 16:00:00',
                'time_ago' => '1 hari yang lalu'
            ],
            [
                'id' => 4,
                'type' => 'achievement',
                'title' => 'Badge Baru: Quiz Master!',
                'message' => 'Selamat! Anda telah meraih badge "Quiz Master".',
                'icon' => 'trophy',
                'color' => 'purple',
                'is_read' => false,
                'created_at' => '2024-01-02 14:20:00',
                'time_ago' => '1 hari yang lalu'
            ],
            [
                'id' => 5,
                'type' => 'course',
                'title' => 'Materi Baru: "Teknik Dasar PBB"',
                'message' => 'Materi pembelajaran baru telah ditambahkan ke kursus Anda.',
                'icon' => 'book-open',
                'color' => 'indigo',
                'is_read' => true,
                'created_at' => '2024-01-01 10:15:00',
                'time_ago' => '3 hari yang lalu'
            ]
        ];

        return response()->json($notifications);
    }
}