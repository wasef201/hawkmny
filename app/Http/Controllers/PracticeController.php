<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use App\Models\Standard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    /**
     * @param Standard $standard
     * @return View
     */
    final public function index(Standard $standard): View
    {
        $practices = $standard->practices()
            ->withCount('questions')
            ->with('field')
            ->get();
        return view('pages.practice.index', compact('standard','practices'));
    }

    /**
     * @param Standard $standard
     * @return View
     */
    final public function create(Standard $standard): View
    {
        return view('pages.practice.create', compact('standard'));
    }

    /**
     * @param Standard $standard
     * @param Request $request
     * @return RedirectResponse
     */
    final public function store(Standard $standard, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'field_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'degree' => 'numeric',
            'is_active' => 'nullable'
        ]);
        $standard->practices()->create(array_merge($data, [
            'is_active' => (bool)data_get($data, 'is_active')
        ]));
        return back();
    }

    /**
     * @param Practice $practice
     * @return View
     */
    final public function edit(Practice $practice): View
    {
        $practice->load('standard.fields');
        return view('pages.practice.edit', [
            'practice' => $practice
        ]);
    }

    /**
     * @param Practice $practice
     * @param Request $request
     * @return RedirectResponse
     */
    final public function update(Practice $practice, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'degree' => 'required|numeric',
            'is_active' => 'nullable'
        ]);
        $practice->update(array_merge($data, [
            'is_active' => (bool)data_get($data, 'is_active')
        ]));
        return back();
    }

    final public function destroy(int $id): int
    {
        return Practice::destroy($id);
    }


}
