<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Interfaces\VacancyInterface;
use App\Models\Candidates;
use App\Models\Category;
use App\Models\Company;
use App\Models\Vacancy;
use App\Services\VacancyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VacancyController extends Controller
{
    protected VacancyInterface $vacancyRepository;
    protected VacancyService $statisticService;


    public function __construct(VacancyInterface $vacancyRepository, VacancyService $statisticService)
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
            $stats = $this->statisticService->getStatistics();

            if (is_string($stats)) {
                return redirect()->back()->with('error', 'Failed to retrieve statistics: ' . $stats);
            }


            return view('vacancy.index', compact('filterVacancies', 'stats','errorMessage'));
        } catch (\Exception $e) {
            Log::error(message: 'Hech qanday vacancy topilmadi:' . ' ' . $e->getMessage() . ' ' . 'Xato qatori' . ' ' . $e->getLine());
            return redirect()->route('vacancy.index')->with('error', 'No found data!');
        }
    }


    public function store(VacancyRequest $request)
    {
        try {
            $vacancy = $this->vacancyRepository->create($request->all());
            $newState = $request->input('status');
            $this->statisticService->updateStatisticsOnVacancyUpdate(vacancyId:  $vacancy->id, newState:  $newState);

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



    public function show(Vacancy $vacancy)
    {
       return view('vacancy.show', compact('vacancy'));
    }
}
