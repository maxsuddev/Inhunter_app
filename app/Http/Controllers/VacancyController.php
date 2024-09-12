<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Interfaces\VacancyInterface;
use App\Models\Candidates;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VacancyController extends Controller
{
    protected VacancyInterface $vacancyRepository;

    public function __construct(VacancyInterface $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    public function index(Request $request)
    {
        try {
            $vacancies = $this->vacancyRepository->all();
            $state = $request->input('state', 'open_vacancy');

            $filterVacancies = $vacancies->filter(function ($vacancy) use ($state) {
                return $vacancy->state === $state;
            });

            $errorMessage = null;
            if (is_string($vacancies)) {
                $errorMessage = $vacancies;
            }

            return view('vacancy.index', compact('filterVacancies', 'errorMessage'));
        } catch (\Exception $e) {
            Log::error(message: 'Hech qanday vacancy topilmadi:' . ' ' . $e->getMessage() . ' ' . 'Xato qatori' . ' ' . $e->getLine());
            return redirect()->route('vacancy.index')->with('error', 'No found data!');
        }
    }



    public function create()
    {
        $category = Category::all('id', 'name');
        $company = Company::all('id', 'name');
        return view('vacancy.create', compact('category', 'company'));
    }

    public function store(VacancyRequest $request)
    {
        try {
            $this->vacancyRepository->create($request->all());
            return redirect()->route('vacancy.index')->with('success', 'Vacancy created successfully!');
        } catch (\Exception $e) {
            Log::error('Hech qanday vacancya qoshilmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No added data! Place try again.');
        }
    }
}
