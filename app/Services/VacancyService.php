<?php


namespace App\Services;

use App\Models\Statistic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class VacancyService
{
    /**
     * @param int $vacancyId
     * @param string $newState
     * @param string|null $previousState
     * @return void
     */
    public function updateStatisticsOnVacancyUpdate(int$vacancyId, string$newState, string$previousState = null): void
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

            $this->logStateChange($vacancyId, $previousState, $newState);

            if ($previousState) {
                $this->updateCount($statistic, $previousState, -1);
            }            $this->updateCount($statistic, $newState, 1);

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


   public function getStatistics(): object|string
   {
       try {
           $stats = Statistic::select('open_count', 'working_count', 'closed_count', 'cancelled_count', 'open_percentage', 'working_percentage', 'closed_percentage', 'cancelled_percentage')
               ->first();

           if (!$stats) {
               return (object)[
                   'open_count' => 0,
                   'working_count' => 0,
                   'closed_count' => 0,
                   'cancelled_count' => 0,
                   'open_percentage' => 0.00,
                   'working_percentage' => 0.00,
                   'closed_percentage' => 0.00,
                   'cancelled_percentage' => 0.00,
               ];
           }

           return $stats;
       } catch (\Exception $e) {
           Log::error('Statistikani olishda xato: ' . $e->getMessage());
           return $e->getMessage();
       }
   }


    private function logStateChange($vacancyId, $previousState, $newState): void
    {
        try {
            DB::table('vacancy_state_log')->insert([
                'vacancy_id' => $vacancyId,
                'previous_state' => $previousState,
                'new_state' => $newState,
                'changed_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('State logga  yozishda xato: VACANCY' . $e->getMessage() . ' ' . $e->getFile() . ' qator ' . $e->getLine());
        }
    }

}
