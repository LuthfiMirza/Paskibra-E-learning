<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use App\Models\User;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user
        $admin = User::where('email', 'admin@paskibra.com')->first();
        
        if (!$admin) {
            $admin = User::first();
        }

        // Quiz 1: Dasar Kepaskibraan
        $quiz1 = Quiz::create([
            'title' => 'Quiz Dasar Kepaskibraan',
            'description' => 'Quiz untuk menguji pengetahuan dasar tentang PASKIBRA dan sejarahnya.',
            'category' => 'kepaskibraan',
            'difficulty' => 'umum',
            'time_limit' => 15,
            'passing_score' => 70,
            'max_attempts' => 3,
            'allow_retake' => true,
            'randomize_questions' => false,
            'show_results_immediately' => true,
            'is_active' => true,
            'published_at' => now(),
            'created_by' => $admin->id,
        ]);

        // Questions for Quiz 1
        $question1 = QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Apa kepanjangan dari PASKIBRA?',
            'type' => 'multiple_choice',
            'options' => [
                'A' => 'Pasukan Pengibar Bendera',
                'B' => 'Pasukan Pengibaran Bendera', 
                'C' => 'Pasukan Kibar Bendera',
                'D' => 'Pasukan Pembawa Bendera'
            ],
            'correct_answer' => ['A'],
            'points' => 10,
            'order' => 1,
            'explanation' => 'PASKIBRA adalah singkatan dari Pasukan Pengibar Bendera, yaitu pasukan khusus yang bertugas mengibarkan bendera Merah Putih pada upacara-upacara resmi.'
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question1->id,
            'option_text' => 'Pasukan Pengibar Bendera',
            'is_correct' => true,
            'order' => 1
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question1->id,
            'option_text' => 'Pasukan Pengibaran Bendera',
            'is_correct' => false,
            'order' => 2
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question1->id,
            'option_text' => 'Pasukan Kibar Bendera',
            'is_correct' => false,
            'order' => 3
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question1->id,
            'option_text' => 'Pasukan Pembawa Bendera',
            'is_correct' => false,
            'order' => 4
        ]);

        $question2 = QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Kapan PASKIBRA pertama kali dibentuk?',
            'type' => 'multiple_choice',
            'options' => [
                'A' => '1945',
                'B' => '1946',
                'C' => '1947', 
                'D' => '1948'
            ],
            'correct_answer' => ['B'],
            'points' => 10,
            'order' => 2,
            'explanation' => 'PASKIBRA pertama kali dibentuk pada tahun 1946 untuk mengibarkan bendera Merah Putih pada upacara kemerdekaan pertama setelah proklamasi.'
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question2->id,
            'option_text' => '1945',
            'is_correct' => false,
            'order' => 1
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question2->id,
            'option_text' => '1946',
            'is_correct' => true,
            'order' => 2
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question2->id,
            'option_text' => '1947',
            'is_correct' => false,
            'order' => 3
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question2->id,
            'option_text' => '1948',
            'is_correct' => false,
            'order' => 4
        ]);

        $question3 = QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Berapa jumlah anggota PASKIBRA dalam satu regu?',
            'type' => 'multiple_choice',
            'options' => [
                'A' => '15 orang',
                'B' => '17 orang',
                'C' => '20 orang',
                'D' => '25 orang'
            ],
            'correct_answer' => ['B'],
            'points' => 10,
            'order' => 3,
            'explanation' => 'Satu regu PASKIBRA terdiri dari 17 orang, melambangkan tanggal proklamasi kemerdekaan Indonesia yaitu 17 Agustus 1945.'
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question3->id,
            'option_text' => '15 orang',
            'is_correct' => false,
            'order' => 1
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question3->id,
            'option_text' => '17 orang',
            'is_correct' => true,
            'order' => 2
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question3->id,
            'option_text' => '20 orang',
            'is_correct' => false,
            'order' => 3
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question3->id,
            'option_text' => '25 orang',
            'is_correct' => false,
            'order' => 4
        ]);

        // Quiz 2: Baris Berbaris
        $quiz2 = Quiz::create([
            'title' => 'Quiz Baris Berbaris',
            'description' => 'Quiz untuk menguji pengetahuan tentang gerakan dan aba-aba dalam baris berbaris.',
            'category' => 'baris_berbaris',
            'difficulty' => 'calon_paskibra',
            'time_limit' => 20,
            'passing_score' => 75,
            'max_attempts' => 2,
            'allow_retake' => true,
            'randomize_questions' => false,
            'show_results_immediately' => true,
            'is_active' => true,
            'published_at' => now(),
            'created_by' => $admin->id,
        ]);

        $question4 = QuizQuestion::create([
            'quiz_id' => $quiz2->id,
            'question' => 'Apa aba-aba untuk gerakan "Siap Grak"?',
            'type' => 'multiple_choice',
            'options' => [
                'A' => 'Siap... Grak!',
                'B' => 'Istirahat... Grak!',
                'C' => 'Tegap... Grak!',
                'D' => 'Lentur... Grak!'
            ],
            'correct_answer' => ['A'],
            'points' => 10,
            'order' => 1,
            'explanation' => 'Aba-aba "Siap Grak" digunakan untuk mengambil sikap siap dalam baris berbaris, dengan posisi kaki kiri melangkah ke samping dan tangan di belakang punggung.'
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question4->id,
            'option_text' => 'Siap... Grak!',
            'is_correct' => true,
            'order' => 1
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question4->id,
            'option_text' => 'Istirahat... Grak!',
            'is_correct' => false,
            'order' => 2
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question4->id,
            'option_text' => 'Tegap... Grak!',
            'is_correct' => false,
            'order' => 3
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question4->id,
            'option_text' => 'Lentur... Grak!',
            'is_correct' => false,
            'order' => 4
        ]);

        $question5 = QuizQuestion::create([
            'quiz_id' => $quiz2->id,
            'question' => 'Berapa hitungan dalam gerakan "Hormat Gerak"?',
            'type' => 'multiple_choice',
            'options' => [
                'A' => '1 hitungan',
                'B' => '2 hitungan',
                'C' => '3 hitungan',
                'D' => '4 hitungan'
            ],
            'correct_answer' => ['B'],
            'points' => 10,
            'order' => 2,
            'explanation' => 'Gerakan "Hormat Gerak" dilakukan dalam 2 hitungan: hitungan 1 untuk mengangkat tangan kanan ke pelipis, hitungan 2 untuk menurunkan tangan.'
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question5->id,
            'option_text' => '1 hitungan',
            'is_correct' => false,
            'order' => 1
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question5->id,
            'option_text' => '2 hitungan',
            'is_correct' => true,
            'order' => 2
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question5->id,
            'option_text' => '3 hitungan',
            'is_correct' => false,
            'order' => 3
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question5->id,
            'option_text' => '4 hitungan',
            'is_correct' => false,
            'order' => 4
        ]);

        // Quiz 3: Kepemimpinan
        $quiz3 = Quiz::create([
            'title' => 'Quiz Kepemimpinan PASKIBRA',
            'description' => 'Quiz untuk menguji pemahaman tentang nilai-nilai kepemimpinan dalam PASKIBRA.',
            'category' => 'kepemimpinan',
            'difficulty' => 'instruktur_muda',
            'time_limit' => 25,
            'passing_score' => 80,
            'max_attempts' => 2,
            'allow_retake' => true,
            'randomize_questions' => false,
            'show_results_immediately' => true,
            'is_active' => true,
            'published_at' => now(),
            'created_by' => $admin->id,
        ]);

        $question6 = QuizQuestion::create([
            'quiz_id' => $quiz3->id,
            'question' => 'Apa yang dimaksud dengan kepemimpinan situasional?',
            'type' => 'multiple_choice',
            'options' => [
                'A' => 'Kepemimpinan yang menyesuaikan dengan situasi',
                'B' => 'Kepemimpinan yang otoriter',
                'C' => 'Kepemimpinan yang demokratis',
                'D' => 'Kepemimpinan yang laissez-faire'
            ],
            'correct_answer' => ['A'],
            'points' => 10,
            'order' => 1,
            'explanation' => 'Kepemimpinan situasional adalah gaya kepemimpinan yang menyesuaikan pendekatan berdasarkan situasi, kondisi, dan kebutuhan anggota tim.'
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question6->id,
            'option_text' => 'Kepemimpinan yang menyesuaikan dengan situasi',
            'is_correct' => true,
            'order' => 1
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question6->id,
            'option_text' => 'Kepemimpinan yang otoriter',
            'is_correct' => false,
            'order' => 2
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question6->id,
            'option_text' => 'Kepemimpinan yang demokratis',
            'is_correct' => false,
            'order' => 3
        ]);

        QuizQuestionOption::create([
            'quiz_question_id' => $question6->id,
            'option_text' => 'Kepemimpinan yang laissez-faire',
            'is_correct' => false,
            'order' => 4
        ]);
    }
}
