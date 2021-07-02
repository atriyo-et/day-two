<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MCQ;
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

Route::get('/', [MCQ::class, 'index'])->name('index');

Route::get('list', [MCQ::class, 'list'])->name('list');

Route::any('add', [MCQ::class, 'add'])->name('add');

Route::any('edit/{id?}', [MCQ::class, 'edit'])->name('edit');

Route::any('addoptions/{id?}', [MCQ::class, 'addoptions'])->name('addoptions');

Route::get('delete/{id}', [MCQ::class, 'delete'])->name('delete');

Route::post('quiz', [MCQ::class, 'quiz'])->name('quiz');

/* API Requests */
Route::get('api-all', [MCQ::class, 'api_get_all'])->name('api-all'); //Get All Available Questions with their Answers

Route::get('api-question-options/{id}', [MCQ::class, 'api_get_options_by_question_id'])->name('api-question-options'); //Get the options of a question by question id

Route::get('api-correct-option/{id}', [MCQ::class, 'api_get_correct_option_by_question_id'])->name('api-correct-option'); //Get the correct option of a question by question id

Route::get('api-check-correct-option/question/{question}/option/{option}', [MCQ::class, 'api_check_correct_option_for_question'])->name('api-check-correct-option'); //Check if the option of a question is correct by question id & answer id

Route::get('api-add-question/question/{question}/point/{point?}', [MCQ::class, 'api_add_new_question'])->name('api-add-question'); //Add a new question and its point

Route::get('api-add-option/question/{question}/option/{option}/correct/{correct}', [MCQ::class, 'api_add_options_to_question'])->name('api-add-option'); //Add a option to existing question
