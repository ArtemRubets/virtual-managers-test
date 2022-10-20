<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ){}

    /**
     * Display a listing of the resource.
     * @var Paginator $categories
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAllWithPaginate();

        if (empty($categories->items()) && $categories->hasPages()) return redirect()->to($categories->previousPageUrl());

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategoriesList();

        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $newCategory = Category::create($validated);
            $status = true;

            DB::commit();

        }catch (\Exception $e){
            Log::error($e->getMessage());

            $status = false;

            DB::rollBack();
        }

        $response = [
            'status' => $status,
            'message' => $status ? 'Category was successfully created' : 'Something went wrong...Try again'
        ];

        return redirect()->route('categories.edit', $newCategory)->with('response', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $category->update($validated);
            $status = true;

            DB::commit();

        }catch (\Exception $e){
            Log::error($e->getMessage());

            $status = false;

            DB::rollBack();
        }

        $response = [
            'status' => $status,
            'message' => $status ? 'Category was successfully updated' : 'Something went wrong...Try again'
        ];

        return redirect()->route('categories.edit', $category->slug)->with('response', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back();
    }
}
