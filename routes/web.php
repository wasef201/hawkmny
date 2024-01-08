<?php

use App\Http\Controllers\AssociationController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\FinancialInputController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StandardController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\AssociationReviewController;
use App\Http\Controllers\AssociationReviewAnswerController;
use App\Http\Controllers\AssociationReviewAnswerCommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/open' , function(){

    return view('open');
});

App::setLocale('ar');

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

Route::get('/email/verify/{id}/{hash}', static function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth' , 'verified', 'approved' ])->group(function (){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings/store', [SettingsController::class, 'store'])->name('settings.store');
    Route::resource('association', AssociationController::class);
    Route::get('association/{association}/approve' ,  [AssociationController::class , 'approve' ] )->name('association.approve');
    Route::resource('supervisor', SupervisorController::class);
    Route::get('/association/{association}/reviews'  , [AssociationController::class , 'reviews'] )->name('association.reviews');
    Route::put('association/{association}/change-password', [AssociationController::class,'changePassword'])
        ->name('association.change-password');
    Route::put('supervisor/{supervisor}/change-password', [SupervisorController::class,'changePassword'])
        ->name('supervisor.change-password');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::resource('standard', StandardController::class);
    Route::resource('standard.fields', FieldController::class)->shallow();
    Route::resource('standard.practice', PracticeController::class)->shallow();
    Route::resource('question', QuestionController::class);
    Route::get('user-financial-inputs/edit', [FinancialInputController::class, 'edit'])->name('financial.edit');
    Route::put('user-financial-inputs', [FinancialInputController::class, 'update'])->name('user.financial.inputs.update');
    Route::resource('standard.review', ReviewController::class)->shallow();
    Route::get('reviews/{review}/standard/{standard}' , [ReviewController::class , 'show'] )
        ->name('standard.review.show');

    Route::get('reviews/{review}/report/{standard}' , [ReviewController::class , 'report'] )
        ->name('standard.review.report');
        Route::get('reviews/{review}/report/{standard}/pdf' , [ReviewController::class , 'report_pdf'] )
        ->name('standard.review.report.pdf');

    Route::get('final-report-pdf', [ReviewController::class, 'final_report_pdf'])
        ->name('final_report_pdf');
    Route::get('total-report/{id}', [ReviewController::class, 'totalFinancialReport'])->name('total-report');
    Route::get('/reviews/{review}', [AssociationReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/excel', [AssociationReviewController::class, 'generateExcelSheet'])->name('reviews.excel');
    Route::get('/reviews/answers/{answer}', [AssociationReviewAnswerController::class, 'show'])->name('reviews.answer.show');
    Route::post('/reviews/answers/{answer}/comments', [AssociationReviewAnswerCommentController::class, 'store'])->name('reviews.answer.comments.store');
    Route::post('/reviews/answers/{answer}', [AssociationReviewAnswerController::class, 'update'])->name('answers.update');
    Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], static function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::view('main-slider', 'admin.site_settings.main-slider')->name('main-slider');
    Route::view('partners', 'admin.site_settings.partners')->name('partners');
    Route::view('hokmny-advantages', 'admin.site_settings.haokmny-advantaes')->name('haokmny-advantages');

});


Route::group(['as'=>'front.'], function (){
    Route::get('', FrontHomeController::class)->name('home');
});
