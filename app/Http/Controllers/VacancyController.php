<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Interfaces\VacancyInterface;
use App\Models\Candidates;
use App\Models\Category;
use App\Models\Company;
use App\Models\Vacancy;
use App\Services\StatisticService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VacancyController extends Controller
{
    protected VacancyInterface $vacancyRepository;
    protected StatisticService $statisticService;


    public function __construct(VacancyInterface $vacancyRepository,  StatisticService $statisticService)
    {
        $this->vacancyRepository = $vacancyRepository;
        $this->statisticService = $statisticService;
    }

    public function index(Request $request)
    {
        try {
            $vacancies = Vacancy::latest()->paginate(10);
            $state = $request->input('state', 'open_vacancy');

            $filterVacancies = $vacancies->filter(function ($vacancy) use ($state) {
                return $vacancy->state === $state;
            });


            $errorMessage = null;
            if (is_string($vacancies)) {
                $errorMessage = $vacancies;
            }
            // Optional: Get statistics if needed
            $filter = $request->query('filter', 'today');
            $stats = $this->statisticService->getStatistics($filter);

            return view('vacancy.index', compact('filterVacancies', 'stats', 'filter','errorMessage'));
        } catch (\Exception $e) {
            Log::error(message: 'Hech qanday vacancy topilmadi:' . ' ' . $e->getMessage() . ' ' . 'Xato qatori' . ' ' . $e->getLine());
            return redirect()->route('vacancy.index')->with('error', 'No found data!');
        }
    }


    public function store(VacancyRequest $request)
    {
        try {
            $vacancy = $this->vacancyRepository->create($request->all());
            $vacancy_state = $request->input('status');
            $this->statisticService->updateStatisticsOnVacancyUpdate($vacancy_state);

            return redirect()->route('vacancy.index')->with('success', 'Vacancy created successfully!');
        } catch (\Exception $e) {
            Log::error('Vacancy qo\'shishda xato: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Vacancy qo\'shishda xato yuz berdi! Iltimos, qayta urinib ko\'ring.');
        }
    }


    public function create()
    {
        $category = Category::all('id', 'name');
        $company = Company::all('id', 'name');
        return view('vacancy.create', compact('category', 'company'));
    }





    public function changeState(Vacancy $vacancy)
    {   $vacancy_state = 'working_vacancy';
        $this->statisticService->updateStatisticsOnVacancyUpdate($vacancy_state, $vacancy->state);
        $vacancy->user_id = Auth::id();
        $vacancy->state = $vacancy_state;
        $vacancy->save();

        return redirect()->back()->with('success', 'Vacancy state changed to working_vacancy.');
    }
}
