<?php

namespace App\Filament\Widgets;

use App\Models\Agendamento;
use App\Models\Cliente;
use Filament\Widgets\Widget;
use Carbon\Carbon;

class SalonDashboardWidget extends Widget
{
    protected static string $view = 'filament.widgets.salon-dashboard-widget';

    protected int|string|array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    // Variável para controlar o ano e mês atual exibidos no calendário
    public ?int $year = null;
    public ?int $month = null;

    public function mount()
    {
        $this->year = Carbon::now()->year;
        $this->month = Carbon::now()->month;
    }

    // Ações para mudar de mês
    public function previousMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->year, $this->month, 1)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function getViewData(): array
    {
        $today = Carbon::today();
        
        // Se year ou month estiverem vazios, define o atual
        $currentYear = $this->year ?? Carbon::now()->year;
        $currentMonthNumber = $this->month ?? Carbon::now()->month;

        $targetDate = Carbon::create($currentYear, $currentMonthNumber, 1);

        // Busca os agendamentos do mês selecionado
        $appointments = Agendamento::whereMonth('data', $currentMonthNumber)
            ->whereYear('data', $currentYear)
            ->get();

        $daysInMonth = [];
        $startOfMonth = $targetDate->copy()->startOfMonth();
        $endOfMonth = $targetDate->copy()->endOfMonth();

        $startDayOfWeek = $startOfMonth->dayOfWeek;

        for ($i = 0; $i < $startDayOfWeek; $i++) {
            $daysInMonth[] = ['empty' => true];
        }

        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $dateString = $date->format('Y-m-d');
            
            $dayAppointments = $appointments->filter(function ($app) use ($dateString) {
                return Carbon::parse($app->data)->format('Y-m-d') === $dateString;
            });

            $daysInMonth[] = [
                'empty' => false,
                'date' => $date->copy(),
                'dayNumber' => $date->day,
                'isToday' => $date->isToday(),
                'hasAppointments' => $dayAppointments->count() > 0,
                'count' => $dayAppointments->count(),
            ];
        }

        return [
            'totalClients' => Cliente::count(),
            'todayAppointments' => Agendamento::whereDate('data', $today)->count(),
            'currentMonthName' => ucfirst($targetDate->locale('pt_BR')->monthName) . ' de ' . $targetDate->year,
            'daysInMonth' => $daysInMonth,
        ];
    }
}