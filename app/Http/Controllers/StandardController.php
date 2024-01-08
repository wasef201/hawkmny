<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\FinancialAppraisalUser;
use App\Models\Review;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    /**
     * @return View
     */
    final public function index(): View
    {



        $review=Review::firstOrCreate(['user_id' => auth()->id()]);

        $standards = Standard::query()
            ->when(auth()->user()->type === User::ADMIN,
                fn($q) => $q->with(['fields' => fn($q) => $q->withCount('practices')])->withCount('fields', 'practices')
            )
            ->withCount(
                [
                    'questions' => fn($q) => $q->root()->choical(),
                ]
            )
            ->when(auth()->user()->type === User::ASSOCIATION,
                function ($q) {
                        $q->with('reviews', function ($q){
                           $q->where('user_id', auth()->id());
                        });
                })
            ->get();

        $standards->map(function (Standard $standard) {
            if (auth()->user()->type === User::ASSOCIATION) {

                $standard['total_standard_questions'] = $standard->questions()->root()->choical()->count();
            }
            return $standard;
        });


        $view = auth()->user()->type === 'admin' ? 'index' : 'list';
        $financialStandard = $standards->firstWhere('id', Standard::Financial_ID);
        $appraisal = FinancialAppraisalUser::firstWhere('user_id', auth()->id());
        $appraisal = $appraisal ? $appraisal : new FinancialAppraisalUser();
        return view('pages.standard.' . $view, compact('standards', 'financialStandard', 'appraisal'));
    }

    /**
     * @return View
     */
    final public function create(): View
    {
        return view('pages.standard.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'percentage' => 'numeric',
            'is_active' => 'nullable'
        ]);
        Standard::query()->create(array_merge($data, [
            'is_active' => (bool)data_get($data, 'is_active')
        ]));
        return back();
    }

    /**
     * @param Standard $standard
     * @return View
     */
    final public function edit(Standard $standard): View
    {
        return view('pages.standard.edit', [
            'standard' => $standard
        ]);
    }

    /**
     * @param Standard $standard
     * @param Request $request
     * @return RedirectResponse
     */
    final public function update(Standard $standard, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'percentage' => 'numeric',
            'is_active' => 'nullable'
        ]);
        $standard->update(array_merge($data, [
            'is_active' => (bool)data_get($data, 'is_active')
        ]));
        return back();
    }

    final public function destroy(int $id): int
    {
        return Standard::destroy($id);
    }

    /**
     * @param int $id
     * @return int
     */
    final public function report(int $id): int
    {
        return view('pages.standard.edit', [
            'standard' => $standard
        ]);

    }


}
