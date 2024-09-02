<?php

namespace App\Http\Controllers;

use App\Interfaces\VacancyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VacancyController extends Controller
{
    protected VacancyInterface $vacancyRepository;


    public function __construct(VacancyInterface $vacancyRepository)
    {
        $this->vacancyRepository = $vacancyRepository;
    }

    public function index()
    {
        try {
            $vacancies = $this->vacancyRepository->all();

            $errorMessage = null;
            if(is_string($vacancies)) {
                $errorMessage = $vacancies;
            }
            return view('vacancy.index', compact('vacancies', 'errorMessage'));
        }catch (\Exception $e){
            Log::error(message: 'Hech qanday vacancy topilmadi:' .' '. $e->getMessage() .' '. 'Xato qatori'.' ' . $e->getLine());
            return  redirect()->route('vacancy.index')->with('error', 'No found data!');
        }
    }
}
