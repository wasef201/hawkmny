<?php

namespace App\Http\Livewire\Questions;

use App\Http\Livewire\BaseComponent;
use Livewire\Component;
use App\Models\QuestionVerificationFile;
use Livewire\WithFileUploads;
use Auth;
use Storage;

class QuestionVerfication extends BaseComponent
{
    use WithFileUploads;

    public $question;
    public $verification_files;
    public $verification_id;
    public $review;
    protected $listeners = ['DeleteVerificationFile', 'fileDeleted' => '$refresh', 'questionChanged' => '$refresh', 'verificationFileUploaded' => '$refresh'];


    public function uploadFiles()
    {
        $this->validate([
            'verification_files.*' => 'required|mimes:xlxs,xlx,doc,docx,pdf,jpg,jpeg,png',
            'verification_files' => 'required',
            'verification_id' => 'required',
        ]);


        foreach ($this->verification_files as $verification_file) {
            QuestionVerificationFile::create([
                'file' => basename($verification_file->store('verification_files')),
                'question_verification_id' => $this->verification_id,
                'file_name' => $verification_file->getClientOriginalName(),
                'review_id' => $this->review->id,
                'user_id' => Auth::id(),
            ]);
        }
        $this->emit('verificationFileUploaded');
    }

    public function mount($question, $review)
    {
        $this->question = $question;
        $this->review = $review;
    }

    public function render()
    {
        return view('livewire.questions.question-verfication');
    }


    public function DownloadFile($id)
    {
        $file = QuestionVerificationFile::find($id);
        return response()->download(storage_path('app/public/verification_files/' . $file->file), $file->file_name);
    }

    public function DeleteVerificationFile($file_id)
    {
        $file = QuestionVerificationFile::find($file_id);
        // dd($file);
        if ($file) {
            $file->delete();
            $this->emit('fileDeleted');
        }

    }
}
