<?php

namespace App\Services;

use App\Models\CandidateStatistic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CandidateService
{
    /** Statistic Service function for state of candidate
     * @param int $candidateId
     * @param string $newState
     * @param string|null $previousState
     * @return void
     */

        public function updateStatisticsOnCandidateUpdate( int $candidateId, string$newState, string$previousState = null): void
    {
        try {
            $statistic = CandidateStatistic::first();
            if (!$statistic) {
                $statistic = CandidateStatistic::create([
                    'total_count' => 0,
                    'new_count' => 0,
                    'working_count' => 0,
                    'archive_count' => 0,
                    'interview_count' => 0,
                    'hired_count' => 0,
                    'new_percentage' => 0,
                    'working_percentage' => 0,
                    'archive_percentage' => 0,
                    'interview_percentage' => 0,
                    'hired_percentage' => 0,
                ]);
            }



            $this->logStateChange($candidateId, $previousState, $newState);


            if ($previousState) {
                $this->updateCount($statistic, $previousState, -1);
            }
            $this->updateCount($statistic, $newState, 1); // $candidate->state olishni to'g'rilash kerak bo'lishi mumkin

            $statistic->total_count = $statistic->new_count + $statistic->working_count + $statistic->archive_count + $statistic->interview_count + $statistic->hired_count;
            $statistic->save();

            $this->updatePercentages($statistic);
        } catch (\Exception $e) {
            Log::error('Statisticani yangilashda xato: ' . $e->getMessage());
        }
    }


    private function updateCount($statistic, $state, $change): void
    {
        switch ($state) {
            case 'new':
                $statistic->increment('new_count', $change);
                break;
            case 'working':
                $statistic->increment('working_count', $change);
                break;
            case 'interview':
                $statistic->increment('interview_count', $change);
                break;
            case 'archive':
                $statistic->increment('archive_count', $change);
                break;
                case 'hired':
                    $statistic->increment('hired_count', $change);
                    break;
            default:
                Log::info('No matching state found for increment.');
                break;
        }
    }

    private function updatePercentages($statistic): void
    {
        try {
            $totalCandidate = $statistic->total_count;

            if ($totalCandidate == 0) {
                $statistic->update([
                    'new_percentage' => 0,
                    'working_percentage' => 0,
                    'archive_percentage' => 0,
                    'interview_percentage' => 0,
                    'hired_percentage' => 0,
                ]);
                return;
            }

            $newPercentage = round(($statistic->new_count / $totalCandidate) * 100, 2);
            $workingPercentage = round(($statistic->working_count / $totalCandidate) * 100, 2);
            $archivePercentage = round(($statistic->archive_count / $totalCandidate) * 100, 2);
            $interviewPercentage = round(($statistic->interview_count / $totalCandidate) * 100, 2);
            $hiredPercentage = round(($statistic->hired_count / $totalCandidate) * 100, 2);


            $statistic->update([
                'new_percentage' => $newPercentage,
                'working_percentage' => $workingPercentage,
                'archive_percentage' => $archivePercentage,
                'interview_percentage' => $interviewPercentage,
                'hired_percentage' => $hiredPercentage
            ]);
        } catch (\Exception $e) {
            Log::error('Percentlarni yangilashda xato: ' . $e->getMessage());
        }
    }
    public function getStatistics()
    {

        try {
            $stats = CandidateStatistic::select('new_count', 'working_count', 'archive_count', 'interview_count', 'hired_count', 'new_percentage', 'working_percentage', 'archive_percentage', 'interview_percentage', 'hired_percentage')
                ->first();

            if (!$stats) {
                return (object)[
                    'new_count' => 0,
                    'working_count' => 0,
                    'archive_count' => 0,
                    'interview_count' => 0,
                    'hired_count' => 0,

                    'new_percentage' => 0.00,
                    'working_percentage' => 0.00,
                    'archive_percentage' => 0.00,
                    'interview_percentage' => 0.00,
                    'hired_percentage' => 0.00,
                ];
            }

            return $stats;
        } catch (\Exception $e) {
            Log::error('Statistikani olishda xato: ' . $e->getMessage());
            return $e->getMessage();
        }
    }
    private function logStateChange($candidateId, $previousState, $newState): void
    {
        try {
            DB::table('candidate_state_log')->insert([
                'candidate_id' => $candidateId,
                'previous_state' => $previousState,
                'new_state' => $newState,
                'changed_at' => now(),
            ]);
        } catch (\Exception $e) {
            Log::error('State logga yozishda xato: CANDIDATE ' . $e->getMessage() . ' ' . $e->getFile() . ' qator ' . $e->getLine());
        }
    }




}
