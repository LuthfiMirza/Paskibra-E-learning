<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\Announcement;
use App\Models\Achievement;
use App\Models\User;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@paskibra.com')->first();
        $instructor = User::where('email', 'pelatih@paskibra.com')->first();

        // Create Courses
        $courses = [
            [
                'title' => 'Dasar Kepaskibraan',
                'description' => 'Modul pembelajaran dasar tentang sejarah, visi, misi, dan nilai-nilai PASKIBRA',
                'category' => 'kepaskibraan',
                'difficulty' => 'umum',
                'duration_minutes' => 120,
                'created_by' => $instructor->id,
            ],
            [
                'title' => 'Baris Berbaris Tingkat Dasar',
                'description' => 'Pembelajaran gerakan dasar baris berbaris untuk anggota PASKIBRA',
                'category' => 'baris_berbaris',
                'difficulty' => 'calon_paskibra',
                'duration_minutes' => 180,
                'created_by' => $instructor->id,
            ],
            [
                'title' => 'Wawasan Kebangsaan',
                'description' => 'Pengetahuan tentang Pancasila, UUD 1945, dan sejarah Indonesia',
                'category' => 'wawasan',
                'difficulty' => 'wiramuda',
                'duration_minutes' => 150,
                'created_by' => $instructor->id,
            ],
            [
                'title' => 'Kepemimpinan PASKIBRA',
                'description' => 'Pengembangan jiwa kepemimpinan dan public speaking',
                'category' => 'kepemimpinan',
                'difficulty' => 'instruktur_muda',
                'duration_minutes' => 200,
                'created_by' => $instructor->id,
            ],
            [
                'title' => 'Protokoler dan Tata Upacara',
                'description' => 'Pembelajaran tentang protokol upacara dan event management',
                'category' => 'protokoler',
                'difficulty' => 'instruktur',
                'duration_minutes' => 160,
                'created_by' => $instructor->id,
            ],
        ];

        foreach ($courses as $courseData) {
            $course = Course::create($courseData);

            // Create lessons for each course
            $this->createLessonsForCourse($course);
            
            // Create quiz for each course
            $this->createQuizForCourse($course);
        }

        // Create Announcements
        $announcements = [
            [
                'title' => 'Selamat Datang di Platform E-Learning PASKIBRA WiraPurusa',
                'content' => 'Selamat datang di platform pembelajaran online resmi PASKIBRA WiraPurusa. Mulai perjalanan pembelajaran Anda dengan mengikuti modul-modul yang telah disediakan.',
                'type' => 'important',
                'is_pinned' => true,
                'published_at' => now(),
                'created_by' => $admin->id,
            ],
            [
                'title' => 'Jadwal Latihan Baris Berbaris',
                'content' => 'Latihan baris berbaris akan dilaksanakan setiap hari Sabtu pukul 07.00 WIB di lapangan sekolah. Harap semua anggota hadir tepat waktu.',
                'type' => 'event',
                'published_at' => now(),
                'created_by' => $instructor->id,
            ],
            [
                'title' => 'Evaluasi Bulanan',
                'content' => 'Evaluasi bulanan akan dilaksanakan pada akhir bulan ini. Pastikan Anda telah menyelesaikan semua modul pembelajaran.',
                'type' => 'urgent',
                'published_at' => now(),
                'created_by' => $admin->id,
            ],
        ];

        foreach ($announcements as $announcementData) {
            Announcement::create($announcementData);
        }

        // Create Achievements
        $achievements = [
            [
                'name' => 'Pemula PASKIBRA',
                'description' => 'Menyelesaikan modul Dasar Kepaskibraan',
                'type' => 'course_completion',
                'criteria' => ['course_id' => 1],
                'points' => 100,
            ],
            [
                'name' => 'Master Baris Berbaris',
                'description' => 'Menyelesaikan semua modul Baris Berbaris dengan nilai sempurna',
                'type' => 'quiz_score',
                'criteria' => ['category' => 'baris_berbaris', 'min_score' => 100],
                'points' => 200,
            ],
            [
                'name' => 'Pembelajar Konsisten',
                'description' => 'Login dan belajar selama 7 hari berturut-turut',
                'type' => 'streak',
                'criteria' => ['days' => 7],
                'points' => 150,
            ],
            [
                'name' => 'Partisipasi Aktif',
                'description' => 'Mengikuti 10 quiz dalam sebulan',
                'type' => 'participation',
                'criteria' => ['quiz_count' => 10, 'period' => 'month'],
                'points' => 120,
            ],
            [
                'name' => 'Patriot Muda',
                'description' => 'Menyelesaikan semua modul dengan nilai rata-rata di atas 85',
                'type' => 'special',
                'criteria' => ['average_score' => 85],
                'points' => 300,
            ],
        ];

        foreach ($achievements as $achievementData) {
            Achievement::create($achievementData);
        }
    }

    private function createLessonsForCourse($course)
    {
        $lessonsByCategory = [
            'kepaskibraan' => [
                ['title' => 'Sejarah PASKIBRA', 'content' => 'Pembelajaran tentang sejarah pembentukan PASKIBRA di Indonesia', 'content_type' => 'text', 'order' => 1],
                ['title' => 'Visi, Misi, dan Tujuan', 'content' => 'Memahami visi, misi, dan tujuan organisasi PASKIBRA', 'content_type' => 'text', 'order' => 2],
                ['title' => 'Kode Etik PASKIBRA', 'content' => 'Kode etik dan nilai-nilai yang harus dijunjung tinggi', 'content_type' => 'text', 'order' => 3],
                ['title' => 'Struktur Organisasi', 'content' => 'Memahami struktur organisasi PASKIBRA', 'content_type' => 'text', 'order' => 4],
            ],
            'baris_berbaris' => [
                ['title' => 'Gerakan Dasar', 'content' => 'Pembelajaran gerakan dasar dalam baris berbaris', 'content_type' => 'video', 'order' => 1],
                ['title' => 'Formasi dan Posisi', 'content' => 'Berbagai formasi dan posisi dalam baris berbaris', 'content_type' => 'video', 'order' => 2],
                ['title' => 'Komando dan Aba-aba', 'content' => 'Teknik memberikan komando dan aba-aba yang benar', 'content_type' => 'audio', 'order' => 3],
                ['title' => 'Praktik Lapangan', 'content' => 'Panduan praktik baris berbaris di lapangan', 'content_type' => 'interactive', 'order' => 4],
            ],
            'wawasan' => [
                ['title' => 'Pancasila sebagai Dasar Negara', 'content' => 'Memahami Pancasila sebagai ideologi bangsa', 'content_type' => 'text', 'order' => 1],
                ['title' => 'UUD 1945', 'content' => 'Pembelajaran tentang Undang-Undang Dasar 1945', 'content_type' => 'pdf', 'order' => 2],
                ['title' => 'Sejarah Kemerdekaan Indonesia', 'content' => 'Perjalanan perjuangan kemerdekaan Indonesia', 'content_type' => 'text', 'order' => 3],
                ['title' => 'Geografi Nusantara', 'content' => 'Pengetahuan tentang wilayah dan budaya Indonesia', 'content_type' => 'interactive', 'order' => 4],
            ],
            'kepemimpinan' => [
                ['title' => 'Dasar-dasar Kepemimpinan', 'content' => 'Konsep dasar kepemimpinan yang efektif', 'content_type' => 'text', 'order' => 1],
                ['title' => 'Public Speaking', 'content' => 'Teknik berbicara di depan umum dengan percaya diri', 'content_type' => 'video', 'order' => 2],
                ['title' => 'Team Building', 'content' => 'Membangun dan memimpin tim yang solid', 'content_type' => 'interactive', 'order' => 3],
                ['title' => 'Manajemen Waktu', 'content' => 'Mengelola waktu secara efektif dan efisien', 'content_type' => 'text', 'order' => 4],
            ],
            'protokoler' => [
                ['title' => 'Tata Upacara Bendera', 'content' => 'Protokol dan tata cara upacara bendera', 'content_type' => 'video', 'order' => 1],
                ['title' => 'MC dan Moderator', 'content' => 'Teknik menjadi MC dan moderator yang baik', 'content_type' => 'text', 'order' => 2],
                ['title' => 'Event Management', 'content' => 'Mengelola acara dan kegiatan organisasi', 'content_type' => 'interactive', 'order' => 3],
                ['title' => 'Etika Protokol', 'content' => 'Etika dan sopan santun dalam protokol resmi', 'content_type' => 'text', 'order' => 4],
            ],
        ];

        $lessons = $lessonsByCategory[$course->category] ?? [];
        
        foreach ($lessons as $lessonData) {
            $lessonData['course_id'] = $course->id;
            $lessonData['duration_minutes'] = rand(15, 45);
            Lesson::create($lessonData);
        }
    }

    private function createQuizForCourse($course)
    {
        $quiz = Quiz::create([
            'title' => 'Quiz ' . $course->title,
            'description' => 'Evaluasi pemahaman materi ' . $course->title,
            'course_id' => $course->id,
            'category' => $course->category,
            'difficulty' => $course->difficulty,
            'time_limit' => 30,
            'passing_score' => 70,
            'max_attempts' => 3,
            'randomize_questions' => true,
            'show_results_immediately' => true,
            'created_by' => $course->created_by,
        ]);

        // Create sample questions for each quiz
        $this->createQuestionsForQuiz($quiz);
    }

    private function createQuestionsForQuiz($quiz)
    {
        $questionsByCategory = [
            'kepaskibraan' => [
                [
                    'question' => 'Apa kepanjangan dari PASKIBRA?',
                    'type' => 'multiple_choice',
                    'options' => ['Pasukan Pengibar Bendera', 'Pasukan Kibar Bendera', 'Pasukan Pembawa Bendera', 'Pasukan Penaik Bendera'],
                    'correct_answer' => [0],
                    'explanation' => 'PASKIBRA adalah singkatan dari Pasukan Pengibar Bendera',
                    'points' => 10,
                    'order' => 1,
                ],
                [
                    'question' => 'PASKIBRA pertama kali dibentuk pada tahun 1946.',
                    'type' => 'true_false',
                    'options' => ['Benar', 'Salah'],
                    'correct_answer' => [1],
                    'explanation' => 'PASKIBRA pertama kali dibentuk pada tahun 1967, bukan 1946',
                    'points' => 10,
                    'order' => 2,
                ],
            ],
            'baris_berbaris' => [
                [
                    'question' => 'Apa aba-aba untuk memulai gerakan jalan di tempat?',
                    'type' => 'fill_blank',
                    'options' => null,
                    'correct_answer' => ['jalan di tempat gerak', 'jalan ditempat gerak'],
                    'explanation' => 'Aba-aba yang benar adalah "Jalan di tempat, gerak!"',
                    'points' => 15,
                    'order' => 1,
                ],
                [
                    'question' => 'Sebutkan 3 gerakan dasar dalam baris berbaris!',
                    'type' => 'essay',
                    'options' => null,
                    'correct_answer' => ['siap', 'istirahat', 'hadap kanan', 'hadap kiri', 'balik kanan'],
                    'explanation' => 'Gerakan dasar meliputi: siap, istirahat, hadap kanan/kiri, balik kanan, dll.',
                    'points' => 20,
                    'order' => 2,
                ],
            ],
            'wawasan' => [
                [
                    'question' => 'Berapa jumlah sila dalam Pancasila?',
                    'type' => 'multiple_choice',
                    'options' => ['3', '4', '5', '6'],
                    'correct_answer' => [2],
                    'explanation' => 'Pancasila terdiri dari 5 sila',
                    'points' => 10,
                    'order' => 1,
                ],
                [
                    'question' => 'Siapa proklamator kemerdekaan Indonesia?',
                    'type' => 'fill_blank',
                    'options' => null,
                    'correct_answer' => ['soekarno dan mohammad hatta', 'ir. soekarno dan drs. mohammad hatta'],
                    'explanation' => 'Proklamator kemerdekaan Indonesia adalah Ir. Soekarno dan Drs. Mohammad Hatta',
                    'points' => 15,
                    'order' => 2,
                ],
            ],
            'kepemimpinan' => [
                [
                    'question' => 'Apa yang dimaksud dengan kepemimpinan transformasional?',
                    'type' => 'essay',
                    'options' => null,
                    'correct_answer' => ['kepemimpinan yang menginspirasi', 'memotivasi pengikut', 'menciptakan perubahan positif'],
                    'explanation' => 'Kepemimpinan transformasional adalah gaya kepemimpinan yang menginspirasi dan memotivasi pengikut untuk mencapai tujuan yang lebih tinggi',
                    'points' => 25,
                    'order' => 1,
                ],
                [
                    'question' => 'Public speaking adalah kemampuan yang penting bagi seorang pemimpin.',
                    'type' => 'true_false',
                    'options' => ['Benar', 'Salah'],
                    'correct_answer' => [0],
                    'explanation' => 'Public speaking adalah kemampuan penting untuk komunikasi efektif sebagai pemimpin',
                    'points' => 10,
                    'order' => 2,
                ],
            ],
            'protokoler' => [
                [
                    'question' => 'Pada upacara bendera, kapan bendera dikibarkan?',
                    'type' => 'multiple_choice',
                    'options' => ['Saat menyanyikan lagu Indonesia Raya', 'Sebelum lagu Indonesia Raya', 'Setelah lagu Indonesia Raya', 'Saat pembacaan teks Proklamasi'],
                    'correct_answer' => [0],
                    'explanation' => 'Bendera dikibarkan bersamaan dengan menyanyikan lagu Indonesia Raya',
                    'points' => 15,
                    'order' => 1,
                ],
                [
                    'question' => 'Sebutkan tugas utama seorang MC dalam acara resmi!',
                    'type' => 'essay',
                    'options' => null,
                    'correct_answer' => ['memandu acara', 'mengatur jalannya acara', 'memperkenalkan pembicara'],
                    'explanation' => 'MC bertugas memandu jalannya acara, mengatur waktu, dan memperkenalkan pembicara',
                    'points' => 20,
                    'order' => 2,
                ],
            ],
        ];

        $questions = $questionsByCategory[$quiz->category] ?? [];
        
        foreach ($questions as $questionData) {
            $questionData['quiz_id'] = $quiz->id;
            QuizQuestion::create($questionData);
        }
    }
}
