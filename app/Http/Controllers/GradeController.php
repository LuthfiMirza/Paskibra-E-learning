<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        // Sample grade data - in a real application, this would come from a database
        $grades = [
            [
                'id' => 1,
                'course_title' => 'Dasar-dasar Paskibra',
                'course_code' => 'PSK101',
                'instructor' => 'Pembina Paskibra',
                'semester' => 'Semester 1 2024',
                'assignments' => [
                    ['name' => 'Quiz 1: Pengenalan Paskibra', 'score' => 85, 'max_score' => 100, 'weight' => 20],
                    ['name' => 'Tugas Praktik Baris Berbaris', 'score' => 92, 'max_score' => 100, 'weight' => 30],
                    ['name' => 'Quiz 2: Nilai-nilai Paskibra', 'score' => 88, 'max_score' => 100, 'weight' => 20],
                    ['name' => 'Ujian Tengah Semester', 'score' => 90, 'max_score' => 100, 'weight' => 30]
                ],
                'final_grade' => 89.1,
                'letter_grade' => 'A',
                'status' => 'Lulus',
                'completed_at' => '2024-01-15'
            ],
            [
                'id' => 2,
                'course_title' => 'Teknik Baris Berbaris',
                'course_code' => 'PSK201',
                'instructor' => 'Pelatih Senior',
                'semester' => 'Semester 1 2024',
                'assignments' => [
                    ['name' => 'Quiz 1: Teori Baris Berbaris', 'score' => 78, 'max_score' => 100, 'weight' => 25],
                    ['name' => 'Praktik Gerakan Dasar', 'score' => 85, 'max_score' => 100, 'weight' => 25],
                    ['name' => 'Praktik Formasi Tim', 'score' => 82, 'max_score' => 100, 'weight' => 25],
                    ['name' => 'Ujian Akhir Praktik', 'score' => 87, 'max_score' => 100, 'weight' => 25]
                ],
                'final_grade' => 83.0,
                'letter_grade' => 'B+',
                'status' => 'Lulus',
                'completed_at' => '2024-01-20'
            ],
            [
                'id' => 3,
                'course_title' => 'Kepemimpinan Paskibra',
                'course_code' => 'PSK301',
                'instructor' => 'Ketua Paskibra',
                'semester' => 'Semester 1 2024',
                'assignments' => [
                    ['name' => 'Essay: Konsep Kepemimpinan', 'score' => 88, 'max_score' => 100, 'weight' => 30],
                    ['name' => 'Presentasi Studi Kasus', 'score' => 91, 'max_score' => 100, 'weight' => 30],
                    ['name' => 'Proyek Kepemimpinan', 'score' => 94, 'max_score' => 100, 'weight' => 40]
                ],
                'final_grade' => 91.5,
                'letter_grade' => 'A',
                'status' => 'Lulus',
                'completed_at' => '2024-01-25'
            ],
            [
                'id' => 4,
                'course_title' => 'Protokol dan Upacara',
                'course_code' => 'PSK202',
                'instructor' => 'Protokoler Senior',
                'semester' => 'Semester 1 2024',
                'assignments' => [
                    ['name' => 'Quiz: Tata Cara Upacara', 'score' => 0, 'max_score' => 100, 'weight' => 20],
                    ['name' => 'Praktik MC Upacara', 'score' => 0, 'max_score' => 100, 'weight' => 40],
                    ['name' => 'Ujian Akhir', 'score' => 0, 'max_score' => 100, 'weight' => 40]
                ],
                'final_grade' => 0,
                'letter_grade' => '-',
                'status' => 'Sedang Berlangsung',
                'completed_at' => null
            ]
        ];

        // Calculate overall statistics
        $completedCourses = collect($grades)->where('status', 'Lulus');
        $totalCredits = $completedCourses->count() * 3; // Assuming 3 credits per course
        $gpa = $completedCourses->avg('final_grade') / 25; // Convert to 4.0 scale
        
        $stats = [
            'total_courses' => count($grades),
            'completed_courses' => $completedCourses->count(),
            'in_progress' => collect($grades)->where('status', 'Sedang Berlangsung')->count(),
            'total_credits' => $totalCredits,
            'gpa' => round($gpa, 2),
            'average_score' => round($completedCourses->avg('final_grade'), 1)
        ];

        return view('grades.index', compact('grades', 'stats'));
    }

    public function show($id)
    {
        // Sample detailed grade data for a specific course
        $grade = [
            'id' => $id,
            'course_title' => 'Dasar-dasar Paskibra',
            'course_code' => 'PSK101',
            'instructor' => 'Pembina Paskibra',
            'semester' => 'Semester 1 2024',
            'credits' => 3,
            'assignments' => [
                [
                    'id' => 1,
                    'name' => 'Quiz 1: Pengenalan Paskibra',
                    'type' => 'Quiz',
                    'score' => 85,
                    'max_score' => 100,
                    'weight' => 20,
                    'submitted_at' => '2024-01-05',
                    'graded_at' => '2024-01-06',
                    'feedback' => 'Pemahaman yang baik tentang konsep dasar Paskibra. Perlu lebih detail dalam menjelaskan sejarah organisasi.'
                ],
                [
                    'id' => 2,
                    'name' => 'Tugas Praktik Baris Berbaris',
                    'type' => 'Praktik',
                    'score' => 92,
                    'max_score' => 100,
                    'weight' => 30,
                    'submitted_at' => '2024-01-08',
                    'graded_at' => '2024-01-09',
                    'feedback' => 'Eksekusi gerakan sangat baik. Koordinasi dengan tim juga memuaskan. Pertahankan konsistensi.'
                ],
                [
                    'id' => 3,
                    'name' => 'Quiz 2: Nilai-nilai Paskibra',
                    'type' => 'Quiz',
                    'score' => 88,
                    'max_score' => 100,
                    'weight' => 20,
                    'submitted_at' => '2024-01-12',
                    'graded_at' => '2024-01-13',
                    'feedback' => 'Pemahaman nilai-nilai Paskibra sudah baik. Aplikasi dalam kehidupan sehari-hari perlu diperkuat.'
                ],
                [
                    'id' => 4,
                    'name' => 'Ujian Tengah Semester',
                    'type' => 'Ujian',
                    'score' => 90,
                    'max_score' => 100,
                    'weight' => 30,
                    'submitted_at' => '2024-01-15',
                    'graded_at' => '2024-01-16',
                    'feedback' => 'Hasil ujian sangat memuaskan. Menunjukkan pemahaman komprehensif terhadap materi yang diajarkan.'
                ]
            ],
            'final_grade' => 89.1,
            'letter_grade' => 'A',
            'status' => 'Lulus',
            'completed_at' => '2024-01-15',
            'attendance' => [
                'total_sessions' => 16,
                'attended' => 15,
                'percentage' => 93.75
            ]
        ];

        return view('grades.show', compact('grade'));
    }
}