<x-filament-widgets::widget>
    <!-- Estilos CSS Personalizados -->
    <style>
        aside header .fi-user-name, 
        header .fi-user-name, 
        .fi-topbar .fi-user-name,
        header nav span.font-medium.text-sm {
            font-size: 0.75rem !important;
        }

        .salon-calendar-grid > div {
            height: 56px !important;
            width: 100% !important;
        }

        .custom-pink-badge {
            background-color: rgba(236, 72, 153, 0.15) !important;
            border-color: rgba(236, 72, 153, 0.4) !important;
            color: #ec4899 !important;
        }

        .custom-pink-btn {
            background-color: rgba(236, 72, 153, 0.1) !important;
            border: 1px solid rgba(236, 72, 153, 0.3) !important;
            color: #ec4899 !important;
            transition: all 0.2s ease;
        }

        .custom-pink-btn:hover {
            background-color: rgba(236, 72, 153, 0.25) !important;
            border-color: #ec4899 !important;
        }

        .custom-day-box {
            background-color: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(51, 65, 85, 0.8);
            border-radius: 0.375rem;
            padding: 0.25rem 0.375rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .custom-day-box.has-appointment {
            background-color: #1e293b !important;
            border-color: rgba(236, 72, 153, 0.5) !important;
        }

        .custom-day-box.is-today {
            background-color: rgba(236, 72, 153, 0.2) !important;
            border-color: #ec4899 !important;
            box-shadow: 0 4px 12px rgba(236, 72, 153, 0.25);
        }

        .dot-pink {
            background-color: #ec4899 !important;
            box-shadow: 0 0 8px #ec4899;
        }
    </style>

    <!-- Adicionamos max-w-xl mx-auto para limitar a largura e centralizar se necessário -->
    <div class="max-w-xl mx-auto">
        <x-filament::section>
            <div class="space-y-4">
                
                <!-- Cabeçalho -->
                <div class="flex flex-col justify-between items-start gap-2">
                    <div>
                        <h2 class="text-base font-bold tracking-tight text-white">Calendário de Agendamentos</h2>
                        <p class="text-xs text-gray-400">Acompanhe os dias e o fluxo do salão.</p>
                    </div>
                    <div class="flex gap-2 w-full justify-between">
                        <span class="px-2 py-0.5 custom-pink-badge rounded-lg text-[11px] font-semibold">
                            Hoje: {{ $todayAppointments }} agendamentos
                        </span>
                        <span class="px-2 py-0.5 bg-slate-900 border border-slate-800 text-slate-300 rounded-lg text-[11px] font-semibold">
                            Clientes: {{ $totalClients }}
                        </span>
                    </div>
                </div>

                <!-- Bloco do Calendário Mensal -->
                <div class="bg-slate-900 border rounded-xl p-3 shadow-lg shadow-black/40" style="border-color: rgba(236, 72, 153, 0.3);">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-sm font-bold text-white capitalize flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full dot-pink"></span>
                            {{ $currentMonthName }}
                        </h3>
                        
                        <!-- Botões de Navegação -->
                        <div class="flex items-center gap-1.5">
                            <button wire:click="previousMonth" type="button" class="px-2 py-1 custom-pink-btn rounded-lg text-[11px] font-semibold">
                                &larr; Ant.
                            </button>
                            <button wire:click="nextMonth" type="button" class="px-2 py-1 custom-pink-btn rounded-lg text-[11px] font-semibold">
                                Próx. &rarr;
                            </button>
                        </div>
                    </div>

                    <!-- Dias da Semana -->
                    <div class="grid grid-cols-7 gap-1 text-center text-[11px] font-semibold mb-2" style="color: #ec4899;">
                        <div>Dom</div>
                        <div>Seg</div>
                        <div>Ter</div>
                        <div>Qua</div>
                        <div>Qui</div>
                        <div>Sex</div>
                        <div>Sáb</div>
                    </div>

                    <!-- Grade do Calendário -->
                    <div class="grid grid-cols-7 gap-1 salon-calendar-grid">
                        @foreach($daysInMonth as $day)
                            @if($day['empty'])
                                <div></div>
                            @else
                                <div class="custom-day-box {{ $day['isToday'] ? 'is-today' : ($day['hasAppointments'] ? 'has-appointment' : '') }}">
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-[11px] font-bold" style="color: {{ $day['isToday'] ? '#ec4899' : '#e2e8f0' }};">
                                            {{ $day['dayNumber'] }}
                                        </span>
                                        @if($day['hasAppointments'])
                                            <span class="w-1.5 h-1.5 rounded-full dot-pink animate-pulse"></span>
                                        @endif
                                    </div>

                                    <div>
                                        @if($day['hasAppointments'])
                                            <span class="text-[9px] block rounded px-0.5 py-0.2 text-center font-medium custom-pink-badge">
                                                {{ $day['count'] }} ag.
                                            </span>
                                        @else
                                            <span class="text-[9px] block text-gray-500 text-center">Livre</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>