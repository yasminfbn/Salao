<x-filament-widgets::widget>
    <!-- Estilo para diminuir o texto de boas-vindas do usuário no topo direito -->
    <style>
        aside header .fi-user-name, 
        header .fi-user-name, 
        .fi-topbar .fi-user-name,
        header nav span.font-medium.text-sm {
            font-size: 0.75rem !important;
        }
    </style>

    <x-filament::section>
        <div class="space-y-6">
            
            <!-- Cabeçalho -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-xl font-bold tracking-tight text-white">Calendário de Agendamentos</h2>
                    <p class="text-sm text-gray-400">Acompanhe os dias e o fluxo de atendimento do salão.</p>
                </div>
                <div class="flex gap-3">
                    <span class="px-3 py-1 bg-pink-500/10 border border-pink-500/20 text-pink-400 rounded-lg text-xs font-semibold">
                        Hoje: {{ $todayAppointments }} agendamentos
                    </span>
                    <span class="px-3 py-1 bg-slate-900 border border-slate-800 text-slate-300 rounded-lg text-xs font-semibold">
                        Total Clientes: {{ $totalClients }}
                    </span>
                </div>
            </div>

            <!-- Bloco do Calendário Mensal com Toque Rosa -->
            <div class="bg-slate-900 border border-pink-500/30 rounded-xl p-4 md:p-6 shadow-lg shadow-pink-950/20">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-white capitalize flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-pink-500"></span>
                        {{ $currentMonthName }}
                    </h3>
                    
                    <!-- Botões de Navegação Rosa -->
                    <div class="flex items-center gap-2">
                        <button wire:click="previousMonth" type="button" class="px-3 py-1.5 bg-pink-500/10 hover:bg-pink-500/20 border border-pink-500/30 text-pink-300 rounded-lg text-xs font-semibold transition flex items-center gap-1 shadow-sm">
                            &larr; Mês Anterior
                        </button>
                        <button wire:click="nextMonth" type="button" class="px-3 py-1.5 bg-pink-500/10 hover:bg-pink-500/20 border border-pink-500/30 text-pink-300 rounded-lg text-xs font-semibold transition flex items-center gap-1 shadow-sm">
                            Próximo Mês &rarr;
                        </button>
                    </div>
                </div>

                <!-- Dias da Semana -->
                <div class="grid grid-cols-7 gap-2 text-center text-xs font-semibold text-pink-400/70 mb-3">
                    <div>Dom</div>
                    <div>Seg</div>
                    <div>Ter</div>
                    <div>Qua</div>
                    <div>Qui</div>
                    <div>Sex</div>
                    <div>Sáb</div>
                </div>

                <!-- Grade do Calendário -->
                <div class="grid grid-cols-7 gap-2">
                    @foreach($daysInMonth as $day)
                        @if($day['empty'])
                            <div class="h-20 bg-transparent rounded-lg"></div>
                        @else
                            <div class="h-20 p-2 rounded-lg border flex flex-col justify-between transition 
                                {{ $day['isToday'] ? 'bg-pink-500/20 border-pink-500 text-white shadow-md shadow-pink-500/10' : ($day['hasAppointments'] ? 'bg-slate-800/80 border-pink-500/40 text-gray-200' : 'bg-slate-800/40 border-slate-700/50 text-gray-400 hover:border-pink-500/20') }}">
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-bold {{ $day['isToday'] ? 'text-pink-300' : 'text-gray-200' }}">
                                        {{ $day['dayNumber'] }}
                                    </span>
                                    @if($day['hasAppointments'])
                                        <span class="w-2 h-2 rounded-full bg-pink-500 shadow-sm shadow-pink-500 animate-pulse" title="Possui agendamentos"></span>
                                    @endif
                                </div>

                                <div>
                                    @if($day['hasAppointments'])
                                        <span class="text-[10px] block bg-pink-500/20 text-pink-300 rounded px-1 py-0.5 text-center font-medium border border-pink-500/30">
                                            {{ $day['count'] }} agend.
                                        </span>
                                    @else
                                        <span class="text-[10px] block text-gray-500 text-center">Livre</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>