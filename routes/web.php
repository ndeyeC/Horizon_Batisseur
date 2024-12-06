<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImmobilierController;
use App\Http\Controllers\CommentaireController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Auth;






Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('immobiliers.create');
    }
    return view('welcome');
})->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/immobiliers', [ImmobilierController::class, 'index'])->name('immobiliers.index');
    Route::get('/immobiliers/{immobilier}', [ImmobilierController::class, 'show'])->name('immobiliers.show');
    Route::post('/immobiliers/{immobilier}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
});


Route::middleware(['auth',AdminMiddleware::class])->group(function () {
    Route::get('/', [ImmobilierController::class, 'create'])->name('immobiliers.create');
    Route::post('/immobiliers', [ImmobilierController::class, 'store'])->name('immobiliers.store');
    Route::get('/immobiliers/{immobilier}/edit', [ImmobilierController::class, 'edit'])->name('immobiliers.edit');
    Route::put('/immobiliers/{immobilier}', [ImmobilierController::class, 'update'])->name('immobiliers.update');
    Route::delete('/immobiliers/{immobilier}', [ImmobilierController::class, 'destroy'])->name('immobiliers.destroy');
    Route::delete('/commentaires/{commentaire}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');
});

// Dashboard
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__.'/auth.php';
?>
