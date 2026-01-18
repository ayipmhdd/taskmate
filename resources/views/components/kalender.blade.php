<aside class="flex-shrink-0 w-64 m-6 ml-0 z-[100] flex flex-col gap-6">
    <div
        class="bg-white rounded-xl overflow-hidden border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex-[7] flex flex-col min-h-0">
        
        <div class="p-3 bg-[#4ade80] border-b-[3px] border-black">
            <div class="w-full h-[120px] border-[3px] border-black rounded-lg overflow-hidden bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=250&h=140&fit=crop"
                    alt="Calendar header" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="px-3 pb-4 pt-4 flex-1 overflow-y-auto">
            <div class="mb-0 w-full">
                <div class="flex items-center justify-center gap-2 mb-4 bg-black text-white py-1 rounded-md border-2 border-black">
                    <span id="calendar-month" class="text-sm font-black uppercase tracking-wider">January</span>
                    <span id="calendar-year" class="text-sm font-medium opacity-80">2026</span>
                </div>

                <div id="calendar-grid" class="grid grid-cols-7 gap-1 w-full">
                    </div>
            </div>
        </div>
    </div>

    <div
        class="bg-white rounded-xl p-4 border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex-[3] flex flex-col min-h-0">
        <h3 class="text-sm font-black uppercase mb-3 pb-2 border-b-[3px] border-black">Today's Agenda</h3>
        <div class="text-center py-4 px-2 text-black font-bold text-[11px] bg-gray-100 border-2 border-black rounded-lg border-dashed">
            NO EVENTS SCHEDULED
        </div>
    </div>
</aside>

<script>
    function generateCalendar() {
        const now = new Date();
        const year = now.getFullYear();
        const month = now.getMonth();
        const today = now.getDate();

        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];
        document.getElementById('calendar-month').textContent = months[month];
        document.getElementById('calendar-year').textContent = year;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();

        const calendarGrid = document.getElementById('calendar-grid');
        calendarGrid.innerHTML = '';

        // Day names
        const dayNames = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
        dayNames.forEach(day => {
            const dayEl = document.createElement('div');
            dayEl.className = 'text-center text-[10px] font-black text-black pb-2';
            dayEl.textContent = day;
            calendarGrid.appendChild(dayEl);
        });

        // Previous month days
        for (let i = firstDay - 1; i >= 0; i--) {
            const dayEl = document.createElement('div');
            dayEl.className = 'aspect-square flex items-center justify-center text-[10px] font-bold text-gray-400 opacity-50';
            dayEl.textContent = daysInPrevMonth - i;
            calendarGrid.appendChild(dayEl);
        }

        // Current month days
        for (let day = 1; day <= daysInMonth; day++) {
            const dayEl = document.createElement('div');
            let classes = 'aspect-square flex items-center justify-center text-[11px] font-bold border-2 border-transparent hover:border-black hover:bg-[#4ade80] transition-all cursor-pointer rounded-md';

            if (day === today) {
                classes = 'aspect-square flex items-center justify-center text-[11px] font-black bg-[#4ade80] border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-md';
            }

            dayEl.className = classes;
            dayEl.textContent = day;
            calendarGrid.appendChild(dayEl);
        }

        // Next month days
        const totalCellsSoFar = calendarGrid.children.length - 7;
        const remainingCells = 42 - totalCellsSoFar;
        for (let day = 1; day <= remainingCells; day++) {
            const dayEl = document.createElement('div');
            dayEl.className = 'aspect-square flex items-center justify-center text-[10px] font-bold text-gray-400 opacity-50';
            dayEl.textContent = day;
            calendarGrid.appendChild(dayEl);
        }
    }
    
    // Panggil fungsi saat load
    generateCalendar();
</script>