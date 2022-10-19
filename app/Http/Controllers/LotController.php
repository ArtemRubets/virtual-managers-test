<?php

namespace App\Http\Controllers;

use App\Http\Filters\LotFilter;
use App\Http\Requests\LotFilterRequest;
use App\Http\Requests\LotRequest;
use App\Models\Lot;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\LotRepositoryInterface;
use Illuminate\Pagination\Paginator;

class LotController extends Controller
{
    public function __construct(
        private LotRepositoryInterface $lotRepository,
        private CategoryRepositoryInterface $categoryRepository
    ){}

    /**
     * Display a listing of the resource.
     * @var Paginator $lots
     * @param LotFilterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(LotFilterRequest $request)
    {
        $categories = $this->categoryRepository->getCategoriesList();
        $validated = $request->validated();

        $selected = $validated['categories'] ?? [];

        $filter = app()->make(LotFilter::class, ['queryParams' => array_filter($validated)]);

        $lots = $this->lotRepository->getAllWithFilterablePaginate($filter);

        if (empty($lots->items()) && empty($filter->queryParams)){
            return redirect()->to($lots->withQueryString()->previousPageUrl());
        }

        return view('lots.index', compact('lots', 'categories', 'selected'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategoriesList();

        return view('lots.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LotRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(LotRequest $request)
    {
        $categoriesInput = $request->get('lot_categories', []);
        $lotInput = $request->safe()->only(['name', 'description']);

        $newLot = Lot::create($lotInput);

        if ($newLot){
            $newLot->categories()->attach($categoriesInput);
        }

        $response = [
            'status' => (bool) $newLot,
            'message' => (bool) $newLot ? 'Lot was successfully created' : 'Something went wrong...Try again'
        ];

        return redirect()->route('lots.edit', $newLot)->with('response', $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  Lot  $lot
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Lot $lot)
    {
        $lot->load('categories');

        return view('lots.show', compact('lot'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Lot  $lot
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Lot $lot)
    {
        $lot->load('categories');
        $categories = $this->categoryRepository->getCategoriesList();

        return view('lots.edit', compact('lot', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LotRequest  $request
     * @param  Lot  $lot
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(LotRequest $request, Lot $lot)
    {
        $categoriesInput = $request->get('lot_categories', []);
        $lotInput = $request->safe()->only(['name', 'description']);

        $status = $lot->update($lotInput);

        if ($status){
            $lot->categories()->sync($categoriesInput);
        }

        $response = [
            'status' => $status,
            'message' => $status ? 'Lot was successfully updated' : 'Something went wrong...Try again'
        ];

        return redirect()->back()->with('response', $response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Lot  $lot
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Lot $lot)
    {
        $lot->delete();

        return redirect()->back();
    }
}
