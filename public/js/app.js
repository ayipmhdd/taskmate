// TaskMate - Main JavaScript File
// All JavaScript functionality for TaskMate application

// ============================================
// SIDEBAR TOGGLE FUNCTIONALITY
// ============================================
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const chevronIcon = document.getElementById('chevronIcon');
    const toggleButton = document.getElementById('toggleButton');
    const toggleArea = document.getElementById('toggleArea');
    const body = document.body;

    // Toggle sidebar width: w-64 (256px) <-> w-20 (80px)
    sidebar.classList.toggle('w-64');
    sidebar.classList.toggle('w-20');

    // Toggle sidebar-collapsed class on body for floating toggle positioning
    body.classList.toggle('sidebar-collapsed');

    // Hide/show text elements
    const sidebarTexts = sidebar.querySelectorAll('.sidebar-text');
    const profileCard = sidebar.querySelector('.profile-card');
    const sidebarHeader = sidebar.querySelector('.sidebar-header');
    const menuItems = sidebar.querySelectorAll('.menu-item');
    const menuIcons = sidebar.querySelectorAll('.menu-icon');

    if (sidebar.classList.contains('w-20')) {
        // Collapsed state (w-20 = 80px + margin 24px = 104px)
        sidebarTexts.forEach(el => el.classList.add('hidden'));
        if (profileCard) profileCard.classList.add('hidden');
        if (sidebarHeader) sidebarHeader.classList.add('justify-center');
        menuItems.forEach(el => {
            el.classList.add('justify-center', 'p-3');
        });
        menuIcons.forEach(el => el.classList.remove('hidden'));
        chevronIcon.innerHTML = '<polyline points="9 18 15 12 9 6"></polyline>';

        // Update toggle button and area position for collapsed state
        toggleArea.style.left = '104px'; // 80px sidebar + 24px margin
        toggleButton.style.left = '116px'; // 104px + 12px offset
    } else {
        // Expanded state (w-64 = 256px + margin 24px = 280px)
        sidebarTexts.forEach(el => el.classList.remove('hidden'));
        if (profileCard) profileCard.classList.remove('hidden');
        if (sidebarHeader) sidebarHeader.classList.remove('justify-center');
        menuItems.forEach(el => {
            el.classList.remove('justify-center', 'p-3');
        });
        menuIcons.forEach(el => el.classList.add('hidden'));
        chevronIcon.innerHTML = '<polyline points="15 18 9 12 15 6"></polyline>';

        // Update toggle button and area position for expanded state
        toggleArea.style.left = '256px'; // 256px sidebar width
        toggleButton.style.left = '268px'; // 256px + 12px offset
    }
}

// ============================================
// DIGITAL CLOCK FUNCTIONALITY
// ============================================
function updateClock() {
    const clockTimeEl = document.getElementById('clock-time');
    const clockDateEl = document.getElementById('clock-date');
    const clockGreetingEl = document.getElementById('clock-greeting');

    // Check if elements exist (for pages that don't have clock)
    if (!clockTimeEl || !clockDateEl || !clockGreetingEl) {
        return;
    }

    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');

    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
    ];

    const dayName = days[now.getDay()];
    const monthName = months[now.getMonth()];
    const date = now.getDate();
    const year = now.getFullYear();

    clockTimeEl.innerHTML =
        `${hours}:${minutes}:<span class="text-blue-500">${seconds}</span>`;
    clockDateEl.textContent = `${dayName}, ${monthName} ${date}, ${year}`;

    // Update greeting
    const hour = now.getHours();
    let greeting = 'Good Evening!';
    if (hour < 12) greeting = 'Good Morning!';
    else if (hour < 18) greeting = 'Good Afternoon!';

    clockGreetingEl.textContent = greeting;
}

// ============================================
// CALENDAR FUNCTIONALITY
// ============================================
function generateCalendar() {
    const calendarGridEl = document.getElementById('calendar-grid');
    const calendarMonthEl = document.getElementById('calendar-month');
    const calendarYearEl = document.getElementById('calendar-year');

    // Check if elements exist (for pages that don't have calendar)
    if (!calendarGridEl || !calendarMonthEl || !calendarYearEl) {
        return;
    }

    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth();
    const today = now.getDate();

    const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
    ];
    calendarMonthEl.textContent = months[month];
    calendarYearEl.textContent = year;

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const daysInPrevMonth = new Date(year, month, 0).getDate();

    calendarGridEl.innerHTML = '';

    // Day names
    const dayNames = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
    dayNames.forEach(day => {
        const dayEl = document.createElement('div');
        dayEl.className = 'text-center text-[10px] font-black text-black pb-2';
        dayEl.textContent = day;
        calendarGridEl.appendChild(dayEl);
    });

    // Previous month days
    for (let i = firstDay - 1; i >= 0; i--) {
        const dayEl = document.createElement('div');
        dayEl.className =
            'aspect-square flex items-center justify-center text-[10px] font-bold text-gray-400 opacity-50';
        dayEl.textContent = daysInPrevMonth - i;
        calendarGridEl.appendChild(dayEl);
    }

    // Current month days
    for (let day = 1; day <= daysInMonth; day++) {
        const dayEl = document.createElement('div');
        let classes =
            'aspect-square flex items-center justify-center text-[11px] font-bold border-2 border-transparent hover:border-black hover:bg-[#4ade80] transition-all cursor-pointer rounded-md';

        if (day === today) {
            classes =
                'aspect-square flex items-center justify-center text-[11px] font-black bg-[#4ade80] border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-md';
        }

        dayEl.className = classes;
        dayEl.textContent = day;
        calendarGridEl.appendChild(dayEl);
    }

    // Next month days
    const totalCellsSoFar = calendarGridEl.children.length - 7;
    const remainingCells = 42 - totalCellsSoFar;
    for (let day = 1; day <= remainingCells; day++) {
        const dayEl = document.createElement('div');
        dayEl.className =
            'aspect-square flex items-center justify-center text-[10px] font-bold text-gray-400 opacity-50';
        dayEl.textContent = day;
        calendarGridEl.appendChild(dayEl);
    }
}

// ============================================
// INITIALIZATION
// ============================================
document.addEventListener('DOMContentLoaded', function () {
    // Initialize clock if element exists
    if (document.getElementById('clock-time')) {
        updateClock();
        setInterval(updateClock, 1000);
    }

    // Initialize calendar if element exists
    if (document.getElementById('calendar-grid')) {
        generateCalendar();
    }
});
