<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Standard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    /**
     * @return View
     */
    final public function index(): View
    {
        $fields = Field::query()
            ->withCount('fields', 'practices', 'questions')
            ->with(['fields' => fn($q) => $q->withCount('practices')])
            ->get();
        return view('pages.field.index', compact('fields'));
    }

    /**
     * @param Standard $standard
     * @return View
     */
    final public function create(Standard $standard): View
    {
        return view('pages.field.create', compact('standard'));
    }

    /**
     * @param Standard $standard
     * @param Request $request
     * @return RedirectResponse
     */
    final public function store(Standard $standard, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'degree' => 'numeric',
            'is_active' => 'nullable'
        ]);
        $standard->fields()->create(array_merge($data, [
            'is_active' => (bool)data_get($data, 'is_active')
        ]));
        return back();
    }

    /**
     * @param Field $field
     * @return View
     */
    final public function edit(Field $field): View
    {
        $field->load('standard');
        return view('pages.field.edit', [
            'field' => $field
        ]);
    }

    /**
     * @param Field $field
     * @param Request $request
     * @return RedirectResponse
     */
    final public function update(Field $field, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'degree' => 'required|numeric',
            'is_active' => 'nullable'
        ]);
        $field->update(array_merge($data, [
            'is_active' => (bool)data_get($data, 'is_active')
        ]));
        return back();
    }

    final public function destroy(int $id): int
    {
        return Field::destroy($id);
    }


}
