{{-- PASKIBRA WiraPurusa E-Learning UI Components Library --}}

{{-- Primary Button Component --}}
@php
    $buttonClasses = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary', 
        'success' => 'btn-success',
        'warning' => 'btn-warning',
        'danger' => 'btn-danger',
        'outline' => 'btn-outline'
    ];
    
    $buttonSizes = [
        'sm' => 'btn-sm',
        'md' => '',
        'lg' => 'btn-lg'
    ];
@endphp

{{-- Button Component --}}
<div class="component-example">
    <h3 class="text-lg font-semibold mb-4">Buttons</h3>
    
    {{-- Primary Buttons --}}
    <div class="space-x-4 mb-4">
        <button class="btn-primary">Primary Button</button>
        <button class="btn-secondary">Secondary Button</button>
        <button class="btn-success">Success Button</button>
        <button class="btn-warning">Warning Button</button>
        <button class="btn-danger">Danger Button</button>
        <button class="btn-outline">Outline Button</button>
    </div>
    
    {{-- Button Sizes --}}
    <div class="space-x-4 mb-4">
        <button class="btn-primary btn-sm">Small</button>
        <button class="btn-primary">Medium</button>
        <button class="btn-primary btn-lg">Large</button>
    </div>
    
    {{-- Button with Icons --}}
    <div class="space-x-4 mb-4">
        <button class="btn-primary">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add Item
        </button>
        
        <button class="btn-success">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Complete
        </button>
        
        <button class="btn-danger">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            Delete
        </button>
    </div>
</div>

{{-- Card Components --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">Cards</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Basic Card --}}
        <div class="card">
            <div class="card-body">
                <h4 class="font-semibold text-gray-900 mb-2">Basic Card</h4>
                <p class="text-gray-600">This is a basic card component with simple styling.</p>
            </div>
        </div>
        
        {{-- Card with Header --}}
        <div class="card">
            <div class="card-header">
                <h4 class="font-semibold text-gray-900">Card with Header</h4>
            </div>
            <div class="card-body">
                <p class="text-gray-600">This card has a distinct header section.</p>
            </div>
        </div>
        
        {{-- Hover Card --}}
        <div class="card-hover">
            <div class="card-body">
                <h4 class="font-semibold text-gray-900 mb-2">Hover Card</h4>
                <p class="text-gray-600">This card has hover effects for better interaction.</p>
            </div>
        </div>
    </div>
    
    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="stat-label">Total Students</h3>
                <div class="stat-icon bg-gradient-to-br from-paskibra-navy to-paskibra-navy-light">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-value">1,234</div>
            <div class="stat-change-positive">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                <span>+12% this month</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="stat-label">Completed Courses</h3>
                <div class="stat-icon bg-gradient-to-br from-success-500 to-success-600">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-value">856</div>
            <div class="stat-change-positive">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                <span>+8% this month</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="stat-label">Average Score</h3>
                <div class="stat-icon bg-gradient-to-br from-paskibra-gold to-paskibra-gold-dark">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
            </div>
            <div class="stat-value">87.5</div>
            <div class="stat-change-positive">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                </svg>
                <span>+2.3 from last month</span>
            </div>
        </div>
    </div>
</div>

{{-- Badge Components --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">Badges</h3>
    
    <div class="space-x-4 mb-4">
        <span class="badge-primary">Primary</span>
        <span class="badge-success">Success</span>
        <span class="badge-warning">Warning</span>
        <span class="badge-danger">Danger</span>
        <span class="badge-info">Info</span>
    </div>
    
    {{-- Badge with Icons --}}
    <div class="space-x-4">
        <span class="badge-success">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            Completed
        </span>
        
        <span class="badge-warning">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Pending
        </span>
        
        <span class="badge-danger">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Failed
        </span>
    </div>
</div>

{{-- Form Components --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">Form Elements</h3>
    
    <div class="max-w-md space-y-4">
        {{-- Input Field --}}
        <div>
            <label class="form-label">Email Address</label>
            <input type="email" class="form-input" placeholder="Enter your email">
        </div>
        
        {{-- Select Field --}}
        <div>
            <label class="form-label">Select Option</label>
            <select class="form-select">
                <option>Choose an option</option>
                <option>Option 1</option>
                <option>Option 2</option>
                <option>Option 3</option>
            </select>
        </div>
        
        {{-- Textarea --}}
        <div>
            <label class="form-label">Message</label>
            <textarea class="form-textarea" rows="4" placeholder="Enter your message"></textarea>
        </div>
        
        {{-- Checkbox --}}
        <div class="flex items-center">
            <input type="checkbox" id="checkbox1" class="w-4 h-4 text-paskibra-navy bg-gray-100 border-gray-300 rounded focus:ring-paskibra-navy focus:ring-2">
            <label for="checkbox1" class="ml-2 text-sm font-medium text-gray-900">I agree to the terms and conditions</label>
        </div>
        
        {{-- Radio Buttons --}}
        <div class="space-y-2">
            <div class="flex items-center">
                <input type="radio" id="radio1" name="radio-group" class="w-4 h-4 text-paskibra-navy bg-gray-100 border-gray-300 focus:ring-paskibra-navy focus:ring-2">
                <label for="radio1" class="ml-2 text-sm font-medium text-gray-900">Option 1</label>
            </div>
            <div class="flex items-center">
                <input type="radio" id="radio2" name="radio-group" class="w-4 h-4 text-paskibra-navy bg-gray-100 border-gray-300 focus:ring-paskibra-navy focus:ring-2">
                <label for="radio2" class="ml-2 text-sm font-medium text-gray-900">Option 2</label>
            </div>
        </div>
    </div>
</div>

{{-- Alert Components --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">Alerts</h3>
    
    <div class="space-y-4">
        <div class="alert-success">
            <div class="flex">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="font-medium">Success!</h4>
                    <p class="mt-1">Your changes have been saved successfully.</p>
                </div>
            </div>
        </div>
        
        <div class="alert-warning">
            <div class="flex">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                <div>
                    <h4 class="font-medium">Warning!</h4>
                    <p class="mt-1">Please review your information before submitting.</p>
                </div>
            </div>
        </div>
        
        <div class="alert-danger">
            <div class="flex">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="font-medium">Error!</h4>
                    <p class="mt-1">There was an error processing your request.</p>
                </div>
            </div>
        </div>
        
        <div class="alert-info">
            <div class="flex">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="font-medium">Information</h4>
                    <p class="mt-1">Here's some important information you should know.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Loading Components --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">Loading States</h3>
    
    <div class="space-y-4">
        {{-- Spinner --}}
        <div class="flex items-center space-x-4">
            <div class="loading-spinner"></div>
            <span class="text-gray-600">Loading...</span>
        </div>
        
        {{-- Dots --}}
        <div class="flex items-center space-x-4">
            <div class="loading-dots">
                <div class="loading-dot"></div>
                <div class="loading-dot" style="animation-delay: 0.1s;"></div>
                <div class="loading-dot" style="animation-delay: 0.2s;"></div>
            </div>
            <span class="text-gray-600">Processing...</span>
        </div>
        
        {{-- Button Loading State --}}
        <button class="btn-primary" disabled>
            <div class="loading-spinner mr-2"></div>
            Submitting...
        </button>
    </div>
</div>

{{-- Progress Components --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">Progress Indicators</h3>
    
    <div class="space-y-6">
        {{-- Progress Bar --}}
        <div>
            <div class="flex justify-between text-sm font-medium text-gray-700 mb-2">
                <span>Course Progress</span>
                <span>75%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-gradient-to-r from-paskibra-navy to-paskibra-navy-light h-2 rounded-full transition-all duration-500" style="width: 75%"></div>
            </div>
        </div>
        
        {{-- Multi-step Progress --}}
        <div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-paskibra-navy rounded-full flex items-center justify-center text-white text-sm font-medium">1</div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Personal Info</p>
                        <p class="text-xs text-gray-500">Completed</p>
                    </div>
                </div>
                <div class="flex-1 mx-4 h-1 bg-paskibra-navy rounded"></div>
                
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-paskibra-navy rounded-full flex items-center justify-center text-white text-sm font-medium">2</div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">Course Selection</p>
                        <p class="text-xs text-gray-500">In Progress</p>
                    </div>
                </div>
                <div class="flex-1 mx-4 h-1 bg-gray-200 rounded"></div>
                
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 text-sm font-medium">3</div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-500">Payment</p>
                        <p class="text-xs text-gray-400">Pending</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Navigation Components --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">Navigation</h3>
    
    {{-- Breadcrumb --}}
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-paskibra-navy">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-paskibra-navy md:ml-2">Courses</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">PASKIBRA Basics</span>
                </div>
            </li>
        </ol>
    </nav>
    
    {{-- Tabs --}}
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="#" class="border-paskibra-navy text-paskibra-navy whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Overview
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Lessons
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Assignments
            </a>
            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Grades
            </a>
        </nav>
    </div>
</div>

{{-- Patriotic Elements --}}
<div class="component-example mt-8">
    <h3 class="text-lg font-semibold mb-4">PASKIBRA Themed Elements</h3>
    
    {{-- Patriotic Banner --}}
    <div class="relative overflow-hidden rounded-2xl bg-slate-800 p-6 text-white mb-6 border-l-4 border-red-600">
        <div class="absolute inset-0 bg-gradient-to-r from-red-600/10 via-transparent to-yellow-500/10"></div>
        <div class="relative z-10">
            <h4 class="text-xl font-bold font-display mb-2">🇮🇩 PASKIBRA WiraPurusa</h4>
            <p class="text-white/90">Membangun generasi penerus yang disiplin dan berprestasi</p>
        </div>
    </div>
    
    {{-- Achievement Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="card-hover p-4 text-center">
            <div class="text-4xl mb-2">🏆</div>
            <h5 class="font-semibold text-gray-900 mb-1">Quiz Master</h5>
            <p class="text-sm text-gray-600">Completed 10 quizzes with 90%+ score</p>
        </div>
        
        <div class="card-hover p-4 text-center">
            <div class="text-4xl mb-2">⭐</div>
            <h5 class="font-semibold text-gray-900 mb-1">Perfect Attendance</h5>
            <p class="text-sm text-gray-600">Attended all sessions this month</p>
        </div>
    </div>
    
    {{-- Motivational Quote --}}
    <div class="card bg-gradient-to-r from-gray-50 to-gray-100 border-l-4 border-paskibra-gold mt-6">
        <div class="card-body text-center">
            <div class="text-3xl mb-3">🇮🇩</div>
            <blockquote class="text-lg font-medium text-gray-900 mb-2">
                "Disiplin adalah jembatan antara tujuan dan pencapaian."
            </blockquote>
            <cite class="text-sm text-gray-600 font-medium">- Semangat PASKIBRA</cite>
        </div>
    </div>
</div>

<style>
.component-example {
    padding: 2rem;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    margin-bottom: 2rem;
    background: white;
}

.component-example h3 {
    color: #1B365D;
    border-bottom: 2px solid #F59E0B;
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
}
</style>