<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Models\Question;
use App\Models\Standard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    final public function index()
    {
        return view('pages.question.index');
    }

    final public function create(): View
    {
        $standards = Standard::all();
        return view('pages.question.create', compact('standards'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'standard_id' => 'required|int',
            'field_id' => 'required|int',
            'practice_id' => 'required|int',
            'name' => 'required',
            'description' => 'nullable',
            'degree' => 'required|numeric',
            'is_active' => 'nullable'
        ]);
        Question::query()->create(array_merge($data,[
            'is_active' => (bool) data_get($data, 'is_active')
        ]));
        return redirect()->route('question.index',[
            'standard' => $request->get('standard_id'),
            'field_id' => $request->get('field_id'),
        ])->with('flash', 'تم اضافة السؤال بنجاح');
    }

    /**
     * @param Question $question
     * @return View
     */
    final public function edit(Question $question): View
    {
        $question->load('choices');
        $standards = Standard::all();
        return view('pages.question.edit', compact('standards', 'question'));
    }

    /**
     * @param Question $question
     * @param Request $request
     * @return RedirectResponse
     */
    final public function update(Question $question, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'standard_id' => 'required|int',
            'field_id' => 'required|int',
            'practice_id' => 'required|int',
            'name' => 'required',
            'description' => 'nullable',
            'degree' => 'required|numeric',
            'is_active' => 'nullable'
        ]);
        $question->update(array_merge($data,[
            'is_active' => (bool) data_get($data, 'is_active')
        ]));
        return back()->with('flash', 'تم تعديل السؤال بنجاح');
    }

    /**
     * @param int $id
     * @return int
     */
    final public function destroy(int $id): int
    {
        return Question::destroy($id);
    }
}
