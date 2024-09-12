<?php


namespace App\Services;

use App\Models\Statistic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class StatisticService
{
    public function updateStatisticsOnVacancyUpdate($vacancy, $previousState = null): void
    {
        try {
            $statistic = Statistic::first();
            if (!$statistic) {
                $statistic = Statistic::create([
                    'total_vacancies' => 0,
                    'open_count' => 0,
                    'working_count' => 0,
                    'closed_count' => 0,
                    'cancelled_count' => 0,
                    'open_percentage' => 0,
                    'working_percentage' => 0,
                    'closed_percentage' => 0,
                    'cancelled_percentage' => 0,
                ]);
            }

            if ($previousState) {
                $this->updateCount($statistic, $previousState, -1);
            }            $this->updateCount($statistic, $vacancy, 1);

            $statistic->total_vacancies = $statistic->open_count + $statistic->working_count + $statistic->closed_count + $statistic->cancelled_count;
            $statistic->save();

            $this->updatePercentages($statistic);
        } catch (\Exception $e) {
            Log::error('Statisticani yangilashda xato: ' . $e->getMessage());
        }
    }

    private function updateCount($statistic, $state, $change): void
    {
        switch ($state) {
            case 'open_vacancy':
                $statistic->increment('open_count', $change);
                break;
            case 'working_vacancy':
                $statistic->increment('working_count', $change);
                break;
            case 'close_vacancy':
                $statistic->increment('closed_count', $change);
                break;
            case 'cancel_vacancy':
                $statistic->increment('cancelled_count', $change);
                break;
            default:
                Log::info('No matching state found for increment.');
                break;
        }
    }

    private function updatePercentages($statistic): void
    {
        try {
            $totalVacancies = $statistic->total_vacancies;

            if ($totalVacancies == 0) {
                $statistic->update([
                    'open_percentage' => 0,
                    'working_percentage' => 0,
                    'closed_percentage' => 0,
                    'cancelled_percentage' => 0,
                ]);
                return;
            }

            $openPercentage = round(($statistic->open_count / $totalVacancies) * 100, 2);
            $workingPercentage = round(($statistic->working_count / $totalVacancies) * 100, 2);
            $closedPercentage = round(($statistic->closed_count / $totalVacancies) * 100, 2);
            $cancelledPercentage = round(($statistic->cancelled_count / $totalVacancies) * 100, 2);

            $statistic->update([
                'open_percentage' => $openPercentage,
                'working_percentage' => $workingPercentage,
                'closed_percentage' => $closedPercentage,
                'cancelled_percentage' => $cancelledPercentage,
            ]);
        } catch (\Exception $e) {
            Log::error('Percentlarni yangilashda xato: ' . $e->getMessage());
        }
    }


    /**
     * Get statistics based on the filter.
     *
     * @param string $filter
     * @return Model|null
     */
    public function getStatistics(string $filter): ?Model
    {
        try {
            $today = Carbon::today();
            // Bu oy va yilning birinchi va oxirgi kuni
            $startOfMonth = $today->copy()->startOfMonth();
            $endOfMonth = $today->copy()->endOfMonth();
            $startOfYear = $today->copy()->startOfYear();
            $endOfYear = $today->copy()->endOfYear();

            // Statistikani olish
            $stats = Statistic::query();
            switch ($filter) {
                case 'today':
                    $stats = $stats->whereDate('created_at', $today)->first();
                    break;
                case 'month':
                    $stats = $stats->whereBetween('created_at', [$startOfMonth, $endOfMonth])->first();
                    break;
                case 'year':
                    $stats = $stats->whereBetween('created_at', [$startOfYear, $endOfYear])->first();
                    break;
                default:
                    $stats = $stats->first();
                    break;
            }

            return $stats;
        } catch (\Exception $e) {
            // Xatoliklarni logga yozish
            Log::error('Statistikani olishda xato: ' . $e->getMessage());
            return null;
        }
    }
}
