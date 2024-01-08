<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\AnswerComment;
use App\Models\Choice;
use Auth;
class AssociationReviewAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        return view('pages.association.reviews.questions.show' , compact('answer') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Answer $answer)
    {
        $new_choice = Choice::find($request->choice_id)->first();

        // dd($new_choice);
        $answer->choice_id = $request->choice_id;
        // $answer->degree = 
        $answer->save();

        $comment = new AnswerComment;
        $comment->answer_id = $answer->id;
        $comment->comment = 'قام المشرف بتغير اجابه السؤال " '.$answer->question?->name .' " من : '.$answer->choice?->name.' الى : '.$new_choice->name ;
        $comment->user_id = Auth::id();
        $comment->save();
        return back()->with(['flash' => 'تم بتغير الاجابه بنجاح']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
