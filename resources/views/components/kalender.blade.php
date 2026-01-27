<aside class="flex-shrink-0 w-64 m-6 ml-0 z-[100] flex flex-col gap-6">
    <div
        class="bg-white rounded-xl overflow-hidden border-[3px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] flex-[7] flex flex-col min-h-0">

        <div class="p-3 bg-[#4ade80] border-b-[3px] border-black">
            <div
                class="w-full h-[120px] border-[3px] border-black rounded-lg overflow-hidden bg-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=250&h=140&fit=crop"
                    alt="Calendar header" class="w-full h-full object-cover">
            </div>
        </div>

        <div class="px-3 pb-4 pt-4 flex-1 overflow-y-auto">
            <div class="mb-0 w-full">
                <div
                    class="flex items-center justify-center gap-2 mb-4 bg-black text-white py-1 rounded-md border-2 border-black">
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
        <div
            class="text-center py-4 px-2 text-black font-bold text-[11px] bg-gray-100 border-2 border-black rounded-lg border-dashed">
            NO EVENTS SCHEDULED
        </div>
    </div>
</aside>
