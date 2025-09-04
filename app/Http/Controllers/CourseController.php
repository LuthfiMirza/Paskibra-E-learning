<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Sample course data - in a real application, this would come from a database
        $courses = [
            [
                'id' => 1,
                'title' => 'Dasar-dasar Paskibra',
                'description' => 'Pelajari dasar-dasar menjadi anggota Paskibra yang baik dan benar',
                'instructor' => 'Pembina Paskibra',
                'duration' => '4 minggu',
                'level' => 'Pemula',
                'image' => 'https://via.placeholder.com/300x200?text=Dasar+Paskibra',
                'enrolled' => 45,
                'rating' => 4.8
            ],
            [
                'id' => 2,
                'title' => 'Teknik Baris Berbaris',
                'description' => 'Menguasai teknik baris berbaris yang benar sesuai standar Paskibra',
                'instructor' => 'Pelatih Senior',
                'duration' => '6 minggu',
                'level' => 'Menengah',
                'image' => 'https://via.placeholder.com/300x200?text=Baris+Berbaris',
                'enrolled' => 32,
                'rating' => 4.9
            ],
            [
                'id' => 3,
                'title' => 'Kepemimpinan Paskibra',
                'description' => 'Mengembangkan jiwa kepemimpinan dalam organisasi Paskibra',
                'instructor' => 'Ketua Paskibra',
                'duration' => '8 minggu',
                'level' => 'Lanjutan',
                'image' => 'https://via.placeholder.com/300x200?text=Kepemimpinan',
                'enrolled' => 28,
                'rating' => 4.7
            ],
            [
                'id' => 4,
                'title' => 'Sejarah dan Filosofi Paskibra',
                'description' => 'Memahami sejarah dan filosofi di balik organisasi Paskibra',
                'instructor' => 'Guru Sejarah',
                'duration' => '3 minggu',
                'level' => 'Pemula',
                'image' => 'https://via.placeholder.com/300x200?text=Sejarah+Paskibra',
                'enrolled' => 52,
                'rating' => 4.6
            ],
            [
                'id' => 5,
                'title' => 'Protokol dan Upacara',
                'description' => 'Menguasai protokol dan tata cara upacara bendera yang benar',
                'instructor' => 'Protokoler Senior',
                'duration' => '5 minggu',
                'level' => 'Menengah',
                'image' => 'https://via.placeholder.com/300x200?text=Protokol+Upacara',
                'enrolled' => 38,
                'rating' => 4.8
            ],
            [
                'id' => 6,
                'title' => 'Pengembangan Karakter',
                'description' => 'Membangun karakter yang kuat sebagai anggota Paskibra',
                'instructor' => 'Konselor Sekolah',
                'duration' => '7 minggu',
                'level' => 'Lanjutan',
                'image' => 'https://via.placeholder.com/300x200?text=Karakter',
                'enrolled' => 41,
                'rating' => 4.9
            ]
        ];

        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        // Sample course data
        $courses = [
            1 => [
                'id' => 1,
                'title' => 'Dasar-dasar Paskibra',
                'description' => 'Pelajari dasar-dasar menjadi anggota Paskibra yang baik dan benar. Course ini akan mengajarkan Anda tentang nilai-nilai, etika, dan tanggung jawab sebagai anggota Paskibra.',
                'instructor' => 'Pembina Paskibra',
                'duration' => '4 minggu',
                'level' => 'Pemula',
                'image' => 'https://via.placeholder.com/600x300?text=Dasar+Paskibra',
                'enrolled' => 45,
                'rating' => 4.8,
                'price' => 'Gratis',
                'modules' => [
                    ['title' => 'Pengenalan Paskibra', 'duration' => '30 menit', 'completed' => false],
                    ['title' => 'Nilai-nilai Paskibra', 'duration' => '45 menit', 'completed' => false],
                    ['title' => 'Etika dan Tata Krama', 'duration' => '40 menit', 'completed' => false],
                    ['title' => 'Tanggung Jawab Anggota', 'duration' => '35 menit', 'completed' => false]
                ],
                'requirements' => [
                    'Siswa aktif sekolah',
                    'Memiliki motivasi tinggi',
                    'Siap mengikuti pelatihan'
                ],
                'learning_outcomes' => [
                    'Memahami nilai-nilai dasar Paskibra',
                    'Menerapkan etika yang baik',
                    'Memiliki tanggung jawab sebagai anggota',
                    'Siap mengikuti pelatihan lanjutan'
                ]
            ],
            2 => [
                'id' => 2,
                'title' => 'Teknik Baris Berbaris',
                'description' => 'Menguasai teknik baris berbaris yang benar sesuai standar Paskibra. Pelajari gerakan dasar, formasi, dan koordinasi dalam baris berbaris.',
                'instructor' => 'Pelatih Senior',
                'duration' => '6 minggu',
                'level' => 'Menengah',
                'image' => 'https://via.placeholder.com/600x300?text=Baris+Berbaris',
                'enrolled' => 32,
                'rating' => 4.9,
                'price' => 'Gratis',
                'modules' => [
                    ['title' => 'Gerakan Dasar Baris Berbaris', 'duration' => '45 menit', 'completed' => false],
                    ['title' => 'Formasi dan Posisi', 'duration' => '50 menit', 'completed' => false],
                    ['title' => 'Koordinasi Tim', 'duration' => '40 menit', 'completed' => false],
                    ['title' => 'Praktik Lapangan', 'duration' => '60 menit', 'completed' => false]
                ],
                'requirements' => [
                    'Telah menyelesaikan kursus dasar',
                    'Kondisi fisik yang baik',
                    'Komitmen untuk latihan rutin'
                ],
                'learning_outcomes' => [
                    'Menguasai gerakan dasar baris berbaris',
                    'Mampu berkoordinasi dalam tim',
                    'Memahami formasi dan posisi',
                    'Siap untuk praktik lapangan'
                ]
            ],
            3 => [
                'id' => 3,
                'title' => 'Kepemimpinan Paskibra',
                'description' => 'Mengembangkan jiwa kepemimpinan dalam organisasi Paskibra. Pelajari cara memimpin dengan teladan dan integritas.',
                'instructor' => 'Ketua Paskibra',
                'duration' => '8 minggu',
                'level' => 'Lanjutan',
                'image' => 'https://via.placeholder.com/600x300?text=Kepemimpinan',
                'enrolled' => 28,
                'rating' => 4.7,
                'price' => 'Gratis',
                'modules' => [
                    ['title' => 'Dasar-dasar Kepemimpinan', 'duration' => '50 menit', 'completed' => false],
                    ['title' => 'Komunikasi Efektif', 'duration' => '45 menit', 'completed' => false],
                    ['title' => 'Pengambilan Keputusan', 'duration' => '55 menit', 'completed' => false],
                    ['title' => 'Memimpin dengan Teladan', 'duration' => '40 menit', 'completed' => false]
                ],
                'requirements' => [
                    'Pengalaman organisasi minimal 1 tahun',
                    'Kemampuan komunikasi yang baik',
                    'Motivasi untuk memimpin'
                ],
                'learning_outcomes' => [
                    'Memahami prinsip kepemimpinan',
                    'Mampu berkomunikasi efektif',
                    'Dapat mengambil keputusan yang tepat',
                    'Menjadi pemimpin yang inspiratif'
                ]
            ]
        ];

        $course = $courses[$id] ?? abort(404, 'Course not found');

        return view('courses.show', compact('course'));
    }

    public function lesson($courseId, $moduleIndex)
    {
        // Sample lesson data for all courses
        $lessons = [
            1 => [
                0 => [
                    'title' => 'Pengenalan Paskibra',
                    'duration' => '30 menit',
                    'content' => [
                        'introduction' => 'Selamat datang di materi Pengenalan Paskibra. Dalam modul ini, Anda akan mempelajari dasar-dasar tentang organisasi Paskibra.',
                        'objectives' => [
                            'Memahami sejarah singkat Paskibra',
                            'Mengenal struktur organisasi Paskibra',
                            'Memahami peran dan fungsi Paskibra'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Sejarah Paskibra dimulai dari...',
                            'Paskibra merupakan singkatan dari Pasukan Pengibar Bendera...',
                            'Fungsi utama Paskibra adalah...'
                        ]
                    ]
                ],
                1 => [
                    'title' => 'Nilai-nilai Paskibra',
                    'duration' => '45 menit',
                    'content' => [
                        'introduction' => 'Modul ini akan membahas nilai-nilai fundamental yang harus dimiliki setiap anggota Paskibra.',
                        'objectives' => [
                            'Memahami nilai-nilai dasar Paskibra',
                            'Menerapkan nilai-nilai dalam kehidupan sehari-hari',
                            'Menjadi teladan bagi siswa lain'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Nilai Kedisiplinan',
                            'Nilai Tanggung Jawab',
                            'Nilai Kepemimpinan',
                            'Nilai Kerjasama'
                        ]
                    ]
                ],
                2 => [
                    'title' => 'Etika dan Tata Krama',
                    'duration' => '40 menit',
                    'content' => [
                        'introduction' => 'Pelajari etika dan tata krama yang harus diterapkan sebagai anggota Paskibra.',
                        'objectives' => [
                            'Memahami etika dalam berorganisasi',
                            'Menerapkan tata krama yang baik',
                            'Menjaga nama baik organisasi'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Etika dalam berpakaian',
                            'Tata krama dalam berkomunikasi',
                            'Sopan santun dalam berorganisasi'
                        ]
                    ]
                ],
                3 => [
                    'title' => 'Tanggung Jawab Anggota',
                    'duration' => '35 menit',
                    'content' => [
                        'introduction' => 'Memahami tanggung jawab sebagai anggota Paskibra dalam berbagai situasi.',
                        'objectives' => [
                            'Memahami tugas dan tanggung jawab',
                            'Melaksanakan kewajiban dengan baik',
                            'Menjadi anggota yang dapat diandalkan'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Tanggung jawab dalam upacara',
                            'Tanggung jawab dalam latihan',
                            'Tanggung jawab sebagai teladan'
                        ]
                    ]
                ]
            ],
            2 => [
                0 => [
                    'title' => 'Gerakan Dasar Baris Berbaris',
                    'duration' => '45 menit',
                    'content' => [
                        'introduction' => 'Pelajari gerakan-gerakan dasar dalam baris berbaris yang menjadi fondasi untuk formasi yang lebih kompleks.',
                        'objectives' => [
                            'Menguasai posisi siap dan istirahat',
                            'Memahami gerakan hadap kanan/kiri',
                            'Menguasai langkah biasa dan tegap'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Posisi dasar: siap, istirahat, hormat',
                            'Gerakan hadap: kanan, kiri, belakang',
                            'Jenis langkah: biasa, tegap, dan maju'
                        ]
                    ]
                ],
                1 => [
                    'title' => 'Formasi dan Posisi',
                    'duration' => '50 menit',
                    'content' => [
                        'introduction' => 'Memahami berbagai formasi dalam baris berbaris dan cara mengatur posisi yang tepat.',
                        'objectives' => [
                            'Memahami formasi baris dan kolom',
                            'Menguasai perpindahan formasi',
                            'Menjaga jarak dan interval yang tepat'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Formasi baris: satu baris, dua baris',
                            'Formasi kolom: satu kolom, dua kolom',
                            'Teknik perpindahan formasi yang rapi'
                        ]
                    ]
                ],
                2 => [
                    'title' => 'Koordinasi Tim',
                    'duration' => '40 menit',
                    'content' => [
                        'introduction' => 'Belajar berkoordinasi dengan anggota tim lain untuk menciptakan gerakan yang kompak dan seragam.',
                        'objectives' => [
                            'Memahami pentingnya koordinasi',
                            'Menguasai teknik sinkronisasi gerakan',
                            'Mengembangkan kepekaan terhadap tim'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Prinsip koordinasi dalam tim',
                            'Teknik sinkronisasi langkah',
                            'Komunikasi non-verbal dalam formasi'
                        ]
                    ]
                ],
                3 => [
                    'title' => 'Praktik Lapangan',
                    'duration' => '60 menit',
                    'content' => [
                        'introduction' => 'Aplikasi semua teknik yang telah dipelajari dalam praktik lapangan yang sesungguhnya.',
                        'objectives' => [
                            'Menerapkan semua gerakan dalam praktik',
                            'Menampilkan formasi yang rapi',
                            'Menunjukkan koordinasi tim yang baik'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Simulasi upacara bendera',
                            'Praktik formasi kompleks',
                            'Evaluasi dan perbaikan gerakan'
                        ]
                    ]
                ]
            ],
            3 => [
                0 => [
                    'title' => 'Dasar-dasar Kepemimpinan',
                    'duration' => '50 menit',
                    'content' => [
                        'introduction' => 'Memahami konsep dasar kepemimpinan dan karakteristik seorang pemimpin yang efektif.',
                        'objectives' => [
                            'Memahami definisi dan konsep kepemimpinan',
                            'Mengenal gaya-gaya kepemimpinan',
                            'Mengidentifikasi karakteristik pemimpin yang baik'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Teori kepemimpinan modern',
                            'Gaya kepemimpinan: demokratis, otoriter, laissez-faire',
                            'Karakteristik pemimpin yang inspiratif'
                        ]
                    ]
                ],
                1 => [
                    'title' => 'Komunikasi Efektif',
                    'duration' => '45 menit',
                    'content' => [
                        'introduction' => 'Mengembangkan kemampuan komunikasi yang efektif sebagai seorang pemimpin.',
                        'objectives' => [
                            'Menguasai teknik komunikasi verbal dan non-verbal',
                            'Memahami cara mendengarkan aktif',
                            'Mengembangkan kemampuan presentasi'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Prinsip komunikasi efektif',
                            'Teknik mendengarkan aktif',
                            'Cara menyampaikan pesan dengan jelas'
                        ]
                    ]
                ],
                2 => [
                    'title' => 'Pengambilan Keputusan',
                    'duration' => '55 menit',
                    'content' => [
                        'introduction' => 'Mempelajari proses pengambilan keputusan yang tepat dan efektif dalam berbagai situasi.',
                        'objectives' => [
                            'Memahami proses pengambilan keputusan',
                            'Menguasai teknik analisis masalah',
                            'Mengembangkan kemampuan berpikir kritis'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Model pengambilan keputusan',
                            'Teknik analisis SWOT',
                            'Mengelola risiko dalam keputusan'
                        ]
                    ]
                ],
                3 => [
                    'title' => 'Memimpin dengan Teladan',
                    'duration' => '40 menit',
                    'content' => [
                        'introduction' => 'Belajar menjadi pemimpin yang memberikan contoh baik dan menginspirasi orang lain.',
                        'objectives' => [
                            'Memahami pentingnya keteladanan',
                            'Mengembangkan integritas pribadi',
                            'Menginspirasi dan memotivasi tim'
                        ],
                        'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                        'materials' => [
                            'Prinsip kepemimpinan teladan',
                            'Membangun integritas dan kredibilitas',
                            'Teknik motivasi dan inspirasi tim'
                        ]
                    ]
                ]
            ]
        ];

        // Course data for lessons
        $courses = [
            1 => [
                'id' => 1,
                'title' => 'Dasar-dasar Paskibra',
                'description' => 'Pelajari dasar-dasar menjadi anggota Paskibra yang baik dan benar.',
                'instructor' => 'Pembina Paskibra',
                'level' => 'Pemula'
            ],
            2 => [
                'id' => 2,
                'title' => 'Teknik Baris Berbaris',
                'description' => 'Menguasai teknik baris berbaris yang benar sesuai standar Paskibra.',
                'instructor' => 'Pelatih Senior',
                'level' => 'Menengah'
            ],
            3 => [
                'id' => 3,
                'title' => 'Kepemimpinan Paskibra',
                'description' => 'Mengembangkan jiwa kepemimpinan dalam organisasi Paskibra.',
                'instructor' => 'Ketua Paskibra',
                'level' => 'Lanjutan'
            ]
        ];

        $course = $courses[$courseId] ?? abort(404, 'Course not found');
        $lesson = $lessons[$courseId][$moduleIndex] ?? abort(404, 'Lesson not found');

        return view('courses.lesson', compact('course', 'lesson', 'courseId', 'moduleIndex'));
    }
}