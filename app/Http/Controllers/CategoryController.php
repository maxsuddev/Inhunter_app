<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryInterface;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    protected CategoryInterface $categoryRepository;


    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        try {
            $categories = $this->categoryRepository->all();
            $is_active = $request->input('status', 'active');
            $filtrCategory = $categories->filter(function ($category) use ($is_active) {
                return $category->is_active === $is_active;
            });
            $errorMessage = null;
            if (is_string($categories)) {
                $errorMessage = $categories;
            }
            return view('category.index', compact('filtrCategory', 'errorMessage'));
        } catch (\Exception $e) {
            Log::error(message: 'Hech qanday category topilmadi:' . ' ' . $e->getMessage() . ' ' . 'Xato qatori' . ' ' . $e->getLine());
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
        } catch (\Exception $e) {
            Log::error('Hech qanday category qoshilmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No added data! Place try again.');
        }
    }


    public function show(Category $category)
    {
        $is_active = Category::is_active();

        return view('category.show', compact('category', 'is_active'));
    }


    public function edit(CategoryRequest $request, $category)
    {

        try {
            $this->categoryRepository->update($request->all(), $category);
            return redirect()->route('category.index')->with('success', 'Category update successfully!');
        } catch (\Exception $e) {
            Log::error('Hech qanday category yangilanmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No edit data! Place try again.');
        }
    }

    public function delete($id){
        try {
            $this->categoryRepository->delete($id);
            return redirect()->route('category.index')->with('success', 'Category delete successfully!');
        }catch (\Exception $e){
            Log::error('Hech qanday kategorya o\'chirilmadi: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No delete data! Place try again.');
        }
    }
}
