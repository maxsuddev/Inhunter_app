<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected CategoryInterface $categoryRepository;


    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        try {
            $categories = $this->categoryRepository->all();

            $errorMessage = null;
            if(is_string($categories)) {
                $errorMessage = $categories;
            }
            return view('category.index', compact('categories', 'errorMessage'));
        }catch (\Exception $e){
            Log::error(message: 'Hech qanday category topilmadi:' .' '. $e->getMessage() .' '. 'Xato qatori'.' ' . $e->getLine());
            return  redirect()->route('candidate.index')->with('error', 'No found data!');
        }
    }


    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryRepository->create($request->all());
            return redirect()->route('category.index')->with('success', 'Category created successfully!');
        }catch (\Exception $e){
            Log::error('Hech qanday category qoshilmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No added data! Place try again.');
        }
    }
}
