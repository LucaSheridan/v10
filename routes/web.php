<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComponentController;
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

// Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('create-artifact')

Route::get('/', function () {
    return redirect(route('login'));
});// Home - Artifacts

Route::get('/artifacts/create/{section?}/{assignment?}/{komponent?}', [ArtifactController::class, 'create']);
// Route::get('/artifacts/create', [ArtifactController::class, 'create'])->name('create-artifact');
Route::get('/artifacts', [ArtifactController::class, 'index'])->name('artifacts');
Route::get('/artifacts/{artifact}', [ArtifactController::class, 'show'])->name('show-artifact');
Route::get('/artifacts/{artifact}/edit', [ArtifactController::class, 'edit'])->name('edit-artifact');
Route::patch('/artifacts/{artifact}', [ArtifactController::class, 'update'])->name('update-artifact');
Route::post('/artifacts/create', [ArtifactController::class, 'store'])->name('save-artifact');
Route::post('/artifacts/createFromURL', [ArtifactController::class, 'storeFromURL'])->name('save-artifact-from-url');
Route::get('/artifacts/{artifact}/rotate/{degrees}', [ArtifactController::class, 'rotate'])->name('rotate-artifact');
//Route::get('/artifact/{artifact}/delete', 'ArtifactController@delete');
Route::delete('/artifact/{artifact}', [ArtifactController::class, 'destroy'])->name('destroy-artifact');



// Artifact-to-Collection
Route::get('/artifacts/{artifact}/selectCollection', [ArtifactController::class, 'selectCollection'])->name('select-collection');
Route::get('/artifact/{artifact}/removeFromCollection', [ArtifactController::class, 'removeFromCollection'])->name('remove-from-collection');

// Comments

// Route::get('/artifact/{artifact}/comment', 'CommentController@create');
Route::post('/artifact/{artifact}/comment', [CommentController::class, 'store'])->name('save-comment');

// Route::get('/artifact/{artifact}/comment/{comment}/edit', 'CommentController@edit');
// Route::post('/artifact/{artifact}/comment/{comment}/edit', 'CommentController@update');
// Route::delete('/artifact/{artifact}/comment/{comment}', 'CommentController@destroy');

// Collections

Route::get('/collections/user/{user?}', [CollectionController::class, 'index'])->name('collections');
Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('show-collection');

Route::get('/collection/create/{artifact?}', [CollectionController::class, 'create'])->name('create-collection');
Route::post('/collections', [CollectionController::class, 'store'])->name('save-collection');

Route::get('/collections/{collection}/edit', [CollectionController::class, 'edit'])->name('edit-collection');
Route::patch('/collections/{collection}/update', [CollectionController::class, 'update'])->name('update-collection');
Route::delete('/collections/{collection}/delete', [CollectionController::class, 'destroy'])->name('delete-collection');
Route::post('/collections/addArtifact/{artifact}', [CollectionController::class, 'addArtifact'])->name('add-artifact');

Route::get('/collections/{collection}/artifact/{artifact}/removeArtifactFromCollection', [CollectionController::class, 'removeArtifactFromCollection'])->name('remove-artifact-from-collection');



// Sections

	// Route::middleware(['auth:sanctum', 'verified'])->get('/sections', function () {
 //    	return route('section-index');
	// 	})->name('sections-index');

Route::get('/sections', [SectionController::class, 'index'])->name('sections');
Route::get('/sections/create', [SectionController::class, 'create'])->name('create-section');
Route::post('/sections',  [SectionController::class, 'store'])->name('save-section');

Route::get('/sections/{section}', [SectionController::class, 'show'])->name('show-section');
Route::get('/sections/{section}/edit', [SectionController::class, 'edit'])->name('edit-section');
Route::patch('/sections/{section}/update', [SectionController::class, 'update'])->name('update-section');
Route::delete('/sections/{section}/delete', [SectionController::class, 'destroy'])->name('destroy-section');

// Assignment

// Assignments

		Route::get('/sections/{section}/assignments/{assignment}', [AssignmentController::class, 'show'])->name('show-assignment');


		// Route::get('/teacher/section/{section}/assignment/create', 'AssignmentController@create');
		// Route::post('/teacher/section/{section}/assignment', 'AssignmentController@store');
		// //Route::get('/teacher/section/{section}/assignment/{assignment}', 'AssignmentController@show');
		// Route::get('/teacher/section/{section}/assignment/{assignment}/edit', 'AssignmentController@edit');
		// Route::patch('/teacher/section/{section}/assignment/{assignment}/update', 'AssignmentController@update');
		// Route::get('/teacher/section/{section}/assignment/{assignment}/delete', 'AssignmentController@delete');
		// Route::delete('/teacher/section/{section}/assignment/{assignment}', 'AssignmentController@destroy');
		// Route::get('/teacher/section/{section}/assignment/{assignment}/gallery', 'AssignmentController@gallery');

// Components

		Route::get('/section/{section}/assignment/{assignment}/component/create', [ComponentController::class, 'create'])->name('create-component');

