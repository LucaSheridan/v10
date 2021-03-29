<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SectionController;


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


Route::get('/welcome', function () {
    return view ('welcome');
});

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/anchor-modal', function () {
    return view('anchorModal');
});

// Artifacts

	Route::get('/artifacts/create/{section?}/{assignment?}/{komponent?}', [ArtifactController::class, 'create'])->middleware('auth');
	// Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('create-artifact');
	Route::get('/artifacts', [ArtifactController::class, 'index'])->name('artifacts')->middleware('auth');
	Route::get('/artifacts/{artifact}', [ArtifactController::class, 'show'])->name('show-artifact')->middleware('auth');
	Route::get('/artifacts/{artifact}/zoom', [ArtifactController::class, 'zoom'])->name('zoom-artifact')->middleware('auth');

	Route::get('/artifacts/{artifact}/edit', [ArtifactController::class, 'edit'])->name('edit-artifact')->middleware('auth');
	Route::patch('/artifacts/{artifact}', [ArtifactController::class, 'update'])->name('update-artifact')->middleware('auth');
	Route::post('/artifacts/create', [ArtifactController::class, 'store'])->name('save-artifact')->middleware('auth');
	Route::post('/artifacts/createFromURL', [ArtifactController::class, 'storeFromURL'])->middleware('auth')->name('save-artifact-from-url');
	Route::get('/artifacts/{artifact}/rotate/{degrees}', [ArtifactController::class, 'rotate'])->middleware('auth')->name('rotate-artifact');
	//Route::get('/artifact/{artifact}/delete', 'ArtifactController@delete');
	Route::delete('/artifact/{artifact}', [ArtifactController::class, 'destroy'])->middleware('auth')->name('destroy-artifact');
	Route::get('/artifacts/{artifact}/collection/select', [ArtifactController::class, 'selectCollection'])->middleware('auth')->name('select-collection');
	
	Route::get('/artifact/{artifact}/collection/{collection}/remove', [ArtifactController::class, 'removeFromCollection'])->middleware('auth')->name('remove-from-collection');
	Route::get('/artifact/{artifact}/unsumbit', [ArtifactController::class, 'unsubmit'])->middleware('auth')->name('unsubmit-artifact');


// Comment Routes

	Route::post('/artifact/{artifact}/comment', [CommentController::class, 'store'])->middleware('auth')->name('save-comment');
	// Unnecessary due to form being added to show-artifact
	// Route::get('/artifact/{artifact}/comment', 'CommentController@create');
	// Route::get('/artifact/{artifact}/comment/{comment}/edit', 'CommentController@edit');
	// Route::post('/artifact/{artifact}/comment/{comment}/edit', 'CommentController@update');
	// Route::delete('/artifact/{artifact}/comment/{comment}', 'CommentController@destroy');

// Collection Routes

	Route::get('/collections/user/{user?}', [CollectionController::class, 'index'])->middleware('auth')->name('collections');
	Route::get('/collections/{collection}', [CollectionController::class, 'show'])->middleware('auth')->name('show-collection');
	Route::get('/collections/{collection}/public', [CollectionController::class, 'showPublic'])->name('show-public-collection');

	Route::get('/collection/create/{artifact?}', [CollectionController::class, 'create'])->middleware('auth')->name('create-collection');
	Route::post('/collections', [CollectionController::class, 'store'])->middleware('auth')->name('save-collection');
	Route::get('/collections/{collection}/edit', [CollectionController::class, 'edit'])->middleware('auth')->name('edit-collection');
	Route::patch('/collections/{collection}/update', [CollectionController::class, 'update'])->middleware('auth')->name('update-collection');
	Route::delete('/collections/{collection}/delete', [CollectionController::class, 'destroy'])->middleware('auth')->name('delete-collection');
	
	Route::post('/collections/addArtifact/{artifact}', [CollectionController::class, 'addArtifact'])->middleware('auth')->name('add-artifact');
	Route::get('/collections/{collection}/artifact/{artifact}/removeArtifactFromCollection', [CollectionController::class, 'removeArtifactFromCollection'])->middleware('auth')->name('remove-artifact-from-collection');
	Route::get('/collections/{collection}/artifact/{artifact}/editLabel', [CollectionController::class, 'editLabel'])->middleware('auth')->name('edit-label');
	Route::patch('/collections/{collection}/artifact/{artifact}/updateLabel', [CollectionController::class, 'updateLabel'])->middleware('auth')->name('update-label');

	Route::get('/collections/{collection}/addCurator', [CollectionController::class, 'addCurator'])->middleware('auth')->name('add-curator');
	Route::post('/collections/{collection}/addCurator', [CollectionController::class, 'saveCurator'])->middleware('auth')->name('attach-curator');

// Sections

	Route::get('/sections', [SectionController::class, 'index'])->middleware('auth')->name('sections');
	Route::get('/sections/create', [SectionController::class, 'create'])->middleware('auth')->name('create-section');
	Route::post('/sections',  [SectionController::class, 'store'])->middleware('auth')->name('save-section');
	Route::get('/sections/{section}', [SectionController::class, 'show'])->middleware('auth')->name('show-section');
	Route::get('/sections/all', [SectionController::class,' showAll'])->middleware('auth')->name('show-all-sections');
	Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->middleware('auth')->name('edit-section');
	Route::patch('/sections/{section}/update', [SectionController::class, 'update'])->middleware('auth')->name('update-section');
	Route::delete('/sections/{section}/delete', [SectionController::class, 'destroy'])->middleware('auth')->name('destroy-section');

	//Progress
	Route::get('/sections/{section}/student/{user}/progress', [SectionController::class, 'studentProgress'])->middleware('auth')->name('student-progress');

	
	// Enroll student in a new Section

	Route::get('/enroll', [EnrollmentController::class, 'select'])->middleware('auth')->name('select-class');
	Route::post('/enroll', [EnrollmentController::class, 'join'])->middleware('auth')->name('join-class');


// Assignment

	Route::get('/sections/{section}/assignment/create', [AssignmentController::class, 'create'])->middleware('auth')->name('create-assignment');
	Route::post('/sections/{section}/assignment/', [AssignmentController::class, 'store'])->middleware('auth')->name('save-assignment');
	Route::get('/sections/{section}/assignment/{assignment}', [AssignmentController::class, 'show'])->middleware('auth')->name('show-assignment');
	Route::get('/sections/{section}/assignment/{assignment}/edit', [AssignmentController::class, 'edit'])->middleware('auth')->name('edit-assignment');
	Route::patch('/sections/{section}/assignment/{assignment}/update',[AssignmentController::class, 'update'])->middleware('auth')->name('update-assignment');
	Route::delete('/sections/{section}/assignment/{assignment}/delete',[AssignmentController::class, 'destroy'])->middleware('auth')->name('destroy-assignment');
	
		// Route::post('/teacher/section/{section}/assignment', 'AssignmentController@store');
		// //Route::get('/teacher/section/{section}/assignment/{assignment}', 'AssignmentController@show');
		// Route::patch('/teacher/section/{section}/assignment/{assignment}/update', 'AssignmentController@update');
		// Route::get('/teacher/section/{section}/assignment/{assignment}/delete', 'AssignmentController@delete');
		// Route::delete('/teacher/section/{section}/assignment/{assignment}', 'AssignmentController@destroy');
		// Route::get('/teacher/section/{section}/assignment/{assignment}/gallery', 'AssignmentController@gallery');

// Comments

	Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->middleware('auth')->name('edit-comment');
	Route::patch('/comments/{comment}/update',[CommentController::class, 'update'])->middleware('auth')->name('update-comment');
	// Route::delete('/artifact/{artifact}/comment/{comment}', 'CommentController@destroy');

// Components

	Route::get('/sections/{section}/assignment/{assignment}/component/create', [ComponentController::class, 'create'])->middleware('auth')->name('create-component');
	Route::post('/sections/{section}/assignment/{assignment}/component/', [ComponentController::class, 'store'])->middleware('auth')->name('save-component');
	Route::get('/sections/{section}/assignment/{assignment}/component/{component}/gallery', [ComponentController::class, 'gallery'])->middleware('auth')->name('show-component-gallery');
	Route::get('/sections/{section}/assignment/{assignment}/component/{component}/edit', [ComponentController::class, 'edit'])->middleware('auth')->name('edit-component');
	Route::patch('/sections/{section}/assignment/{assignment}/component/{component}/update', [ComponentController::class, 'update'])->middleware('auth')->name('update-component');
	Route::delete('sections/{section}/assignment/{assignment}/component/{component}/delete',[ComponentController::class, 'destroy'])->middleware('auth')->name('destroy-component');



