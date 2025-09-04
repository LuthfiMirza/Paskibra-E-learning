@extends('template-modern')

@section('title', 'Mengerjakan Quiz - PASKIBRA E-Learning')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="bg-slate-800 rounded-xl p-8 text-white relative overflow-hidden border-l-4 border-orange-600">
        <div class="absolute inset-0 bg-gradient-to-r from-orange-600/10 via-transparent to-red-600/10"></div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Quiz Demo</h1>
                        <p class="text-lg text-white/90">Ini adalah demo quiz untuk testing</p>
                    </div>
                </div>
                
                <!-- Timer (if applicable) -->
                <div class="bg-white/20 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold" id="timer">15:00</div>
                    <div class="text-sm text-white/80">Waktu tersisa</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quiz Progress -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Progress Quiz</h3>
        <span class="text-sm text-gray-500">Soal <span id="current-question">1</span> dari <span id="total-questions">5</span></span>
    </div>
    <div class="w-full bg-gray-200 rounded-full h-3">
        <div id="progress-bar" class="bg-gradient-to-r from-blue-600 to-purple-600 h-3 rounded-full transition-all duration-500" style="width: 20%"></div>
    </div>
</div>

<!-- Quiz Form -->
<form id="quiz-form" method="POST" action="#" class="space-y-8">
    @csrf
    
    <!-- Question 1 -->
    <div class="question-card bg-white rounded-xl shadow-sm border border-gray-200 p-8" data-question="1">
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">1</div>
                <span class="text-sm text-gray-500">Soal 1 dari 5</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Apa kepanjangan dari PASKIBRA?</h3>
        </div>
        
        <div class="space-y-3">
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_1" value="a" class="mr-4 text-blue-600">
                <span class="text-gray-900">Pasukan Kibar Bendera</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_1" value="b" class="mr-4 text-blue-600">
                <span class="text-gray-900">Pasukan Pengibar Bendera Pusaka</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_1" value="c" class="mr-4 text-blue-600">
                <span class="text-gray-900">Pasukan Khusus Bendera</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_1" value="d" class="mr-4 text-blue-600">
                <span class="text-gray-900">Pasukan Pembawa Bendera</span>
            </label>
        </div>
    </div>

    <!-- Question 2 -->
    <div class="question-card bg-white rounded-xl shadow-sm border border-gray-200 p-8 hidden" data-question="2">
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">2</div>
                <span class="text-sm text-gray-500">Soal 2 dari 5</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Kapan PASKIBRA pertama kali dibentuk?</h3>
        </div>
        
        <div class="space-y-3">
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_2" value="a" class="mr-4 text-blue-600">
                <span class="text-gray-900">17 Agustus 1945</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_2" value="b" class="mr-4 text-blue-600">
                <span class="text-gray-900">17 Agustus 1967</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_2" value="c" class="mr-4 text-blue-600">
                <span class="text-gray-900">17 Agustus 1968</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_2" value="d" class="mr-4 text-blue-600">
                <span class="text-gray-900">17 Agustus 1970</span>
            </label>
        </div>
    </div>

    <!-- Question 3 -->
    <div class="question-card bg-white rounded-xl shadow-sm border border-gray-200 p-8 hidden" data-question="3">
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">3</div>
                <span class="text-sm text-gray-500">Soal 3 dari 5</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Berapa jumlah anggota PASKIBRA dalam satu tim?</h3>
        </div>
        
        <div class="space-y-3">
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_3" value="a" class="mr-4 text-blue-600">
                <span class="text-gray-900">17 orang</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_3" value="b" class="mr-4 text-blue-600">
                <span class="text-gray-900">45 orang</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_3" value="c" class="mr-4 text-blue-600">
                <span class="text-gray-900">68 orang</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_3" value="d" class="mr-4 text-blue-600">
                <span class="text-gray-900">100 orang</span>
            </label>
        </div>
    </div>

    <!-- Question 4 -->
    <div class="question-card bg-white rounded-xl shadow-sm border border-gray-200 p-8 hidden" data-question="4">
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">4</div>
                <span class="text-sm text-gray-500">Soal 4 dari 5</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Apa makna dari warna merah putih pada bendera Indonesia?</h3>
        </div>
        
        <div class="space-y-3">
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_4" value="a" class="mr-4 text-blue-600">
                <span class="text-gray-900">Merah = keberanian, Putih = kesucian</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_4" value="b" class="mr-4 text-blue-600">
                <span class="text-gray-900">Merah = darah, Putih = tulang</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_4" value="c" class="mr-4 text-blue-600">
                <span class="text-gray-900">Merah = api, Putih = air</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_4" value="d" class="mr-4 text-blue-600">
                <span class="text-gray-900">Merah = matahari, Putih = bulan</span>
            </label>
        </div>
    </div>

    <!-- Question 5 -->
    <div class="question-card bg-white rounded-xl shadow-sm border border-gray-200 p-8 hidden" data-question="5">
        <div class="mb-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm">5</div>
                <span class="text-sm text-gray-500">Soal 5 dari 5</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Siapa yang pertama kali mengibarkan bendera Merah Putih?</h3>
        </div>
        
        <div class="space-y-3">
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_5" value="a" class="mr-4 text-blue-600">
                <span class="text-gray-900">Soekarno dan Hatta</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_5" value="b" class="mr-4 text-blue-600">
                <span class="text-gray-900">Latief Hendraningrat</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_5" value="c" class="mr-4 text-blue-600">
                <span class="text-gray-900">S. Suhud</span>
            </label>
            <label class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                <input type="radio" name="question_5" value="d" class="mr-4 text-blue-600">
                <span class="text-gray-900">Fatmawati</span>
            </label>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="flex justify-between items-center bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <button type="button" id="prev-btn" class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Sebelumnya
        </button>
        
        <div class="flex space-x-2">
            <div class="w-3 h-3 bg-blue-600 rounded-full question-indicator active" data-question="1"></div>
            <div class="w-3 h-3 bg-gray-300 rounded-full question-indicator" data-question="2"></div>
            <div class="w-3 h-3 bg-gray-300 rounded-full question-indicator" data-question="3"></div>
            <div class="w-3 h-3 bg-gray-300 rounded-full question-indicator" data-question="4"></div>
            <div class="w-3 h-3 bg-gray-300 rounded-full question-indicator" data-question="5"></div>
        </div>
        
        <button type="button" id="next-btn" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            Selanjutnya
            <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <button type="button" id="submit-btn" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors hidden">
            Selesai Quiz
        </button>
    </div>
</form>

<!-- Submit Confirmation Modal -->
<div id="submit-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl p-8 max-w-md mx-4">
        <div class="text-center">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Selesaikan Quiz?</h3>
            <p class="text-gray-600 mb-6">Pastikan semua jawaban sudah benar. Anda tidak dapat mengubah jawaban setelah mengirim.</p>
            <div class="flex space-x-3">
                <button type="button" id="cancel-submit" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </button>
                <button type="button" id="confirm-submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    Ya, Selesai
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Quiz Result Modal -->
<div id="result-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full mx-4 overflow-hidden shadow-2xl">
        <!-- Modal Header -->
        <div id="result-header" class="px-8 py-6 text-center">
            <!-- Success Header -->
            <div id="success-header" class="hidden">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-green-800 mb-2">🎉 Selamat!</h3>
                <p class="text-green-600 font-medium">Anda berhasil lulus quiz!</p>
            </div>
            
            <!-- Failure Header -->
            <div id="failure-header" class="hidden">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-red-800 mb-2">😔 Belum Berhasil</h3>
                <p class="text-red-600 font-medium">Anda belum mencapai nilai minimum</p>
            </div>
        </div>
        
        <!-- Modal Body -->
        <div class="px-8 pb-6">
            <!-- Score Display -->
            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2" id="score-display">0%</div>
                    <div class="text-gray-600 mb-4">Nilai Anda</div>
                    
                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                        <div id="score-progress" class="h-3 rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-green-600" id="correct-count">0</div>
                            <div class="text-sm text-gray-500">Benar</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-red-600" id="wrong-count">0</div>
                            <div class="text-sm text-gray-500">Salah</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-blue-600" id="total-count">5</div>
                            <div class="text-sm text-gray-500">Total</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional Info -->
            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-blue-800 font-medium">Nilai Minimum:</span>
                    <span class="text-blue-600">70%</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-2">
                    <span class="text-blue-800 font-medium">Waktu Pengerjaan:</span>
                    <span class="text-blue-600" id="time-taken">-</span>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex space-x-3">
                <button type="button" id="review-answers" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat Jawaban
                </button>
                <button type="button" id="back-to-quiz" class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6a2 2 0 01-2 2H10a2 2 0 01-2-2V5z"></path>
                    </svg>
                    Kembali ke Quiz
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentQuestion = 1;
const totalQuestions = 5;
let timeLeft = 15 * 60; // 15 minutes in seconds

// Timer functionality
function updateTimer() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    document.getElementById('timer').textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    
    if (timeLeft <= 0) {
        // Auto submit when time is up
        submitQuiz();
        return;
    }
    
    timeLeft--;
}

// Start timer
const timerInterval = setInterval(updateTimer, 1000);

// Question navigation
function showQuestion(questionNum) {
    // Hide all questions
    document.querySelectorAll('.question-card').forEach(card => {
        card.classList.add('hidden');
    });
    
    // Show current question
    document.querySelector(`[data-question="${questionNum}"]`).classList.remove('hidden');
    
    // Update indicators
    document.querySelectorAll('.question-indicator').forEach(indicator => {
        indicator.classList.remove('active', 'bg-blue-600');
        indicator.classList.add('bg-gray-300');
    });
    document.querySelector(`.question-indicator[data-question="${questionNum}"]`).classList.add('active', 'bg-blue-600');
    document.querySelector(`.question-indicator[data-question="${questionNum}"]`).classList.remove('bg-gray-300');
    
    // Update progress
    const progress = (questionNum / totalQuestions) * 100;
    document.getElementById('progress-bar').style.width = `${progress}%`;
    document.getElementById('current-question').textContent = questionNum;
    
    // Update buttons
    document.getElementById('prev-btn').disabled = questionNum === 1;
    
    if (questionNum === totalQuestions) {
        document.getElementById('next-btn').classList.add('hidden');
        document.getElementById('submit-btn').classList.remove('hidden');
    } else {
        document.getElementById('next-btn').classList.remove('hidden');
        document.getElementById('submit-btn').classList.add('hidden');
    }
}

// Navigation event listeners
document.getElementById('prev-btn').addEventListener('click', () => {
    if (currentQuestion > 1) {
        currentQuestion--;
        showQuestion(currentQuestion);
    }
});

document.getElementById('next-btn').addEventListener('click', () => {
    if (currentQuestion < totalQuestions) {
        currentQuestion++;
        showQuestion(currentQuestion);
    }
});

// Submit functionality
document.getElementById('submit-btn').addEventListener('click', () => {
    document.getElementById('submit-modal').classList.remove('hidden');
});

document.getElementById('cancel-submit').addEventListener('click', () => {
    document.getElementById('submit-modal').classList.add('hidden');
});

document.getElementById('confirm-submit').addEventListener('click', () => {
    submitQuiz();
});

function submitQuiz() {
    clearInterval(timerInterval);
    
    // Hide submit confirmation modal
    document.getElementById('submit-modal').classList.add('hidden');
    
    // Collect answers
    const answers = {};
    for (let i = 1; i <= totalQuestions; i++) {
        const selectedAnswer = document.querySelector(`input[name="question_${i}"]:checked`);
        if (selectedAnswer) {
            answers[`question_${i}`] = selectedAnswer.value;
        }
    }
    
    // Demo scoring (in real app, this would be done server-side)
    const correctAnswers = {
        'question_1': 'b', // Pasukan Pengibar Bendera Pusaka
        'question_2': 'b', // 17 Agustus 1967
        'question_3': 'a', // 17 orang
        'question_4': 'a', // Merah = keberanian, Putih = kesucian
        'question_5': 'b'  // Latief Hendraningrat
    };
    
    let score = 0;
    let correct = 0;
    
    for (let question in correctAnswers) {
        if (answers[question] === correctAnswers[question]) {
            correct++;
        }
    }
    
    score = Math.round((correct / totalQuestions) * 100);
    const wrong = totalQuestions - correct;
    const passed = score >= 70;
    
    // Calculate time taken
    const totalTime = 15 * 60; // 15 minutes in seconds
    const timeTaken = totalTime - timeLeft;
    const minutesTaken = Math.floor(timeTaken / 60);
    const secondsTaken = timeTaken % 60;
    const timeDisplay = `${minutesTaken}:${secondsTaken.toString().padStart(2, '0')}`;
    
    // Show result popup
    showResultModal(score, correct, wrong, passed, timeDisplay);
    
    // Clear saved answers
    clearSavedAnswers();
}

function showResultModal(score, correct, wrong, passed, timeTaken) {
    // Update score display
    document.getElementById('score-display').textContent = `${score}%`;
    document.getElementById('correct-count').textContent = correct;
    document.getElementById('wrong-count').textContent = wrong;
    document.getElementById('time-taken').textContent = timeTaken;
    
    // Show appropriate header
    if (passed) {
        document.getElementById('success-header').classList.remove('hidden');
        document.getElementById('failure-header').classList.add('hidden');
        document.getElementById('score-progress').className = 'bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-1000 ease-out';
    } else {
        document.getElementById('success-header').classList.add('hidden');
        document.getElementById('failure-header').classList.remove('hidden');
        document.getElementById('score-progress').className = 'bg-gradient-to-r from-red-500 to-red-600 h-3 rounded-full transition-all duration-1000 ease-out';
    }
    
    // Show result modal
    document.getElementById('result-modal').classList.remove('hidden');
    
    // Animate progress bar
    setTimeout(() => {
        document.getElementById('score-progress').style.width = `${score}%`;
    }, 300);
}

// Result modal event listeners
document.getElementById('back-to-quiz').addEventListener('click', () => {
    window.location.href = '{{ route("quizzes.index") }}';
});

document.getElementById('review-answers').addEventListener('click', () => {
    // In a real app, this would show detailed answer review
    alert('Fitur review jawaban akan segera tersedia!');
});

// Auto-save functionality (optional)
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', () => {
        // Save to localStorage for recovery
        const answers = {};
        for (let i = 1; i <= totalQuestions; i++) {
            const selectedAnswer = document.querySelector(`input[name="question_${i}"]:checked`);
            if (selectedAnswer) {
                answers[`question_${i}`] = selectedAnswer.value;
            }
        }
        localStorage.setItem('quiz_answers', JSON.stringify(answers));
    });
});

// Load saved answers on page load
window.addEventListener('load', () => {
    const savedAnswers = localStorage.getItem('quiz_answers');
    if (savedAnswers) {
        const answers = JSON.parse(savedAnswers);
        for (let question in answers) {
            const radio = document.querySelector(`input[name="${question}"][value="${answers[question]}"]`);
            if (radio) {
                radio.checked = true;
            }
        }
    }
});

// Clear saved answers when quiz is submitted
function clearSavedAnswers() {
    localStorage.removeItem('quiz_answers');
}
</script>
@endsection