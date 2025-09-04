/**
 * PASKIBRA E-Learning Dashboard JavaScript
 * Enhanced functionality for the dashboard interface
 */

class Dashboard {
    constructor() {
        this.init();
        this.bindEvents();
        this.loadUserData();
    }

    init() {
        this.loadTheme();
        this.initializeAnimations();
        this.setupNotifications();
        this.initializeTooltips();
    }

    bindEvents() {
        // Theme toggle
        document.getElementById('theme-toggle')?.addEventListener('click', () => this.toggleTheme());
        
        // Sidebar toggle for mobile
        document.querySelector('.mobile-menu-toggle')?.addEventListener('click', () => this.toggleSidebar());
        
        // User menu toggle
        document.querySelector('.user-menu')?.addEventListener('click', (e) => this.toggleUserMenu(e));
        
        // Quick action cards
        document.querySelectorAll('.action-card:not(.locked)').forEach(card => {
            card.addEventListener('click', (e) => this.handleQuickAction(e));
        });
        
        // Navigation items
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', (e) => this.handleNavigation(e));
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => this.handleOutsideClick(e));
        
        // Handle window resize
        window.addEventListener('resize', () => this.handleResize());
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));
    }

    // Theme Management
    toggleTheme() {
        const body = document.body;
        const themeIcon = document.getElementById('theme-icon');
        
        body.classList.toggle('dark');
        
        if (body.classList.contains('dark')) {
            themeIcon.className = 'fas fa-sun';
            localStorage.setItem('theme', 'dark');
            this.showNotification('Mode gelap diaktifkan', 'success');
        } else {
            themeIcon.className = 'fas fa-moon';
            localStorage.setItem('theme', 'light');
            this.showNotification('Mode terang diaktifkan', 'success');
        }
    }

    loadTheme() {
        const savedTheme = localStorage.getItem('theme');
        const themeIcon = document.getElementById('theme-icon');
        
        if (savedTheme === 'dark') {
            document.body.classList.add('dark');
            if (themeIcon) themeIcon.className = 'fas fa-sun';
        }
    }

    // Sidebar Management
    toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar?.classList.toggle('open');
    }

    // User Menu Management
    toggleUserMenu(e) {
        e.stopPropagation();
        
        // Create dropdown if it doesn't exist
        let dropdown = document.querySelector('.user-dropdown');
        if (!dropdown) {
            dropdown = this.createUserDropdown();
            document.querySelector('.user-menu').appendChild(dropdown);
        }
        
        dropdown.classList.toggle('show');
    }

    createUserDropdown() {
        const dropdown = document.createElement('div');
        dropdown.className = 'dropdown-content user-dropdown';
        dropdown.innerHTML = `
            <a href="/profile" class="dropdown-item">
                <i class="fas fa-user"></i> Profil Saya
            </a>
            <a href="/settings" class="dropdown-item">
                <i class="fas fa-cog"></i> Pengaturan
            </a>
            <div class="dropdown-divider"></div>
            <a href="/logout" class="dropdown-item" onclick="event.preventDefault(); this.closest('form')?.submit() || this.handleLogout()">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        `;
        return dropdown;
    }

    // Quick Actions
    handleQuickAction(e) {
        const card = e.currentTarget;
        const title = card.querySelector('.action-title')?.textContent;
        
        // Add loading state
        this.setCardLoading(card, true);
        
        setTimeout(() => {
            this.setCardLoading(card, false);
            
            switch(title) {
                case 'Mulai Belajar':
                    this.startLearning();
                    break;
                case 'Kerjakan Quiz':
                    this.takeQuiz();
                    break;
                case 'Lihat Nilai':
                    this.viewGrades();
                    break;
                default:
                    this.showNotification('Fitur dalam pengembangan', 'info');
            }
        }, 1000);
    }

    setCardLoading(card, loading) {
        const icon = card.querySelector('.action-icon i');
        if (loading) {
            icon.className = 'fas fa-spinner fa-spin';
            card.style.pointerEvents = 'none';
        } else {
            // Restore original icon based on card type
            const title = card.querySelector('.action-title').textContent;
            switch(title) {
                case 'Mulai Belajar':
                    icon.className = 'fas fa-book';
                    break;
                case 'Kerjakan Quiz':
                    icon.className = 'fas fa-check-circle';
                    break;
                case 'Lihat Nilai':
                    icon.className = 'fas fa-chart-bar';
                    break;
            }
            card.style.pointerEvents = 'auto';
        }
    }

    startLearning() {
        this.showNotification('Mengarahkan ke halaman pembelajaran...', 'info');
        // Simulate navigation
        setTimeout(() => {
            window.location.href = '/courses';
        }, 1500);
    }

    takeQuiz() {
        this.showNotification('Memuat quiz tersedia...', 'info');
        // Simulate navigation
        setTimeout(() => {
            window.location.href = '/quizzes';
        }, 1500);
    }

    viewGrades() {
        this.showNotification('Membuka laporan nilai...', 'info');
        // Simulate navigation
        setTimeout(() => {
            window.location.href = '/grades';
        }, 1500);
    }

    // Navigation
    handleNavigation(e) {
        e.preventDefault();
        const item = e.currentTarget;
        const text = item.textContent.trim();
        
        // Remove active class from all nav items
        document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
        
        // Add active class to clicked item
        item.classList.add('active');
        
        // Show loading and navigate
        this.showNotification(`Memuat ${text}...`, 'info');
        
        // Simulate navigation based on menu item
        setTimeout(() => {
            switch(text) {
                case 'Dashboard':
                    window.location.href = '/dashboard';
                    break;
                case 'Pengumuman':
                    window.location.href = '/announcements';
                    break;
                case 'Laporan Nilai':
                    window.location.href = '/reports';
                    break;
                case 'Data Siswa Nilai':
                    window.location.href = '/student-data';
                    break;
                case 'Ranking Kelas':
                    window.location.href = '/rankings';
                    break;
                case 'Top 3':
                    window.location.href = '/leaderboard';
                    break;
            }
        }, 1000);
    }

    // Event Handlers
    handleOutsideClick(e) {
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.querySelector('.mobile-menu-toggle');
        const userDropdown = document.querySelector('.user-dropdown');
        const userMenu = document.querySelector('.user-menu');
        
        // Close sidebar on mobile
        if (window.innerWidth <= 768 && 
            sidebar && !sidebar.contains(e.target) && 
            toggleButton && !toggleButton.contains(e.target) &&
            sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
        }
        
        // Close user dropdown
        if (userDropdown && !userMenu?.contains(e.target)) {
            userDropdown.classList.remove('show');
        }
    }

    handleResize() {
        const sidebar = document.getElementById('sidebar');
        if (window.innerWidth > 768 && sidebar) {
            sidebar.classList.remove('open');
        }
    }

    handleKeyboard(e) {
        // ESC key closes modals and dropdowns
        if (e.key === 'Escape') {
            document.querySelector('.user-dropdown')?.classList.remove('show');
            document.querySelector('.modal-overlay.active')?.classList.remove('active');
        }
        
        // Alt + M toggles sidebar on mobile
        if (e.altKey && e.key === 'm' && window.innerWidth <= 768) {
            e.preventDefault();
            this.toggleSidebar();
        }
        
        // Alt + T toggles theme
        if (e.altKey && e.key === 't') {
            e.preventDefault();
            this.toggleTheme();
        }
    }

    // Notifications
    setupNotifications() {
        // Create notification container if it doesn't exist
        if (!document.querySelector('.notification-container')) {
            const container = document.createElement('div');
            container.className = 'notification-container';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                pointer-events: none;
            `;
            document.body.appendChild(container);
        }
    }

    showNotification(message, type = 'info', duration = 3000) {
        const container = document.querySelector('.notification-container');
        const notification = document.createElement('div');
        
        const colors = {
            info: 'var(--primary-color)',
            success: 'var(--success-color)',
            warning: '#f59e0b',
            error: '#ef4444'
        };
        
        const icons = {
            info: 'fas fa-info-circle',
            success: 'fas fa-check-circle',
            warning: 'fas fa-exclamation-triangle',
            error: 'fas fa-times-circle'
        };
        
        notification.style.cssText = `
            background: ${colors[type]};
            color: white;
            padding: 16px 24px;
            border-radius: 8px;
            box-shadow: var(--shadow-hover);
            margin-bottom: 12px;
            animation: slideIn 0.3s ease;
            pointer-events: auto;
            display: flex;
            align-items: center;
            gap: 8px;
            max-width: 300px;
        `;
        
        notification.innerHTML = `
            <i class="${icons[type]}"></i>
            <span>${message}</span>
        `;
        
        container.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, duration);
    }

    // Animations
    initializeAnimations() {
        // Add fade-in animation to elements
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.1}s`;
        });

        // Animate progress bar
        setTimeout(() => {
            const progressFill = document.querySelector('.progress-fill');
            if (progressFill) {
                progressFill.style.width = '65%';
            }
        }, 500);

        // Animate stat values
        this.animateStatValues();
    }

    animateStatValues() {
        const statValues = document.querySelectorAll('.stat-value');
        statValues.forEach(stat => {
            const finalValue = parseFloat(stat.textContent);
            let currentValue = 0;
            const increment = finalValue / 50;
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    currentValue = finalValue;
                    clearInterval(timer);
                }
                stat.textContent = Math.floor(currentValue);
            }, 30);
        });
    }

    // Tooltips
    initializeTooltips() {
        document.querySelectorAll('[data-tooltip]').forEach(element => {
            element.addEventListener('mouseenter', (e) => {
                this.showTooltip(e.target, e.target.dataset.tooltip);
            });
            
            element.addEventListener('mouseleave', () => {
                this.hideTooltip();
            });
        });
    }

    showTooltip(element, text) {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip-popup';
        tooltip.textContent = text;
        tooltip.style.cssText = `
            position: absolute;
            background: var(--secondary-color);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            z-index: 10000;
            pointer-events: none;
            white-space: nowrap;
        `;
        
        document.body.appendChild(tooltip);
        
        const rect = element.getBoundingClientRect();
        tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
        tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
        
        setTimeout(() => {
            tooltip.style.opacity = '1';
        }, 10);
    }

    hideTooltip() {
        const tooltip = document.querySelector('.tooltip-popup');
        if (tooltip) {
            tooltip.remove();
        }
    }

    // Data Loading
    loadUserData() {
        // Simulate loading user data
        this.showLoadingSkeleton();
        
        setTimeout(() => {
            this.hideLoadingSkeleton();
            this.updateUserStats();
        }, 1500);
    }

    showLoadingSkeleton() {
        // Add skeleton loading to cards
        document.querySelectorAll('.stat-value').forEach(stat => {
            stat.classList.add('skeleton');
        });
    }

    hideLoadingSkeleton() {
        document.querySelectorAll('.skeleton').forEach(element => {
            element.classList.remove('skeleton');
        });
    }

    updateUserStats() {
        // Update stats with real data (simulate API call)
        const stats = {
            totalMaterials: 24,
            completedQuizzes: 18,
            averageGrade: 85.2
        };
        
        // Update the values with animation
        this.animateStatValues();
    }

    // Utility Methods
    formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }

    formatDate(date) {
        return new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }).format(new Date(date));
    }

    // Modal Management
    openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    // Performance Monitoring
    measurePerformance() {
        if ('performance' in window) {
            window.addEventListener('load', () => {
                const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
                console.log(`Dashboard loaded in ${loadTime}ms`);
                
                if (loadTime > 3000) {
                    this.showNotification('Dashboard membutuhkan waktu lama untuk dimuat', 'warning');
                }
            });
        }
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.dashboard = new Dashboard();
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
        color: transparent !important;
    }
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
`;
document.head.appendChild(style);