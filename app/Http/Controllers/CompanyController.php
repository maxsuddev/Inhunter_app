<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Interfaces\CompanyInterface;
use App\Models\Company;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    protected CompanyInterface $companyRepository;


    public function __construct(CompanyInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    public function index()
    {
        try {
            $companies = $this->companyRepository->all();

            $errorMessage = null;
            if(is_string($companies)) {
                $errorMessage = $companies;
            }
            return view('company.index', compact('companies', 'errorMessage'));
        }catch (\Exception $e){
            Log::error(message: 'Hech qanday kanpanya topilmadi:' .' '. $e->getMessage() .' '. 'Xato qatori'.' ' . $e->getLine());
            return  redirect()->route('candidate.index')->with('error', 'No found data!');
        }
    }

    public function show(Company $company)
    {
        return view('company.show', compact('company'));

    }


    public function update(CompanyRequest $request, $company){
        try {
            $this->companyRepository->update($request->all(), $company);
            return redirect()->route('company.index')->with('success', 'Company update successfully!');
        }catch (\Exception $e){
            Log::error('Hech qanday kanpanya yangilanmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No edit data! Place try again.');
        }
    }

    public function create()
    {
        return view('company.create');
    }

    public function store(CompanyRequest $request)
    {
        try {
            $this->companyRepository->create($request->all());
            return redirect()->route('company.index')->with('success', 'Company created successfully!');
        }catch (\Exception $e){
            Log::error('Hech qanday kanpanya qoshilmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No added data! Place try again.');
        }
    }

    public function delete($id)
    {
        try {
            $this->companyRepository->delete($id);
            return redirect()->route('company.index')->with('success', 'Company delete successfully!');
        }catch (\Exception $e){
            Log::error('Hech qanday kanpanya o\'chirilmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No delete data! Place try again.');
        }
    }



}
