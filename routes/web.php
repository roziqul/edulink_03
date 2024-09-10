<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CatalogController as AdminCatalogController;
use App\Http\Controllers\Admin\SerialController as AdminSerialController;

use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\Admin\LoanController as AdminLoanController;
use App\Http\Controllers\Admin\ReturnController as AdminReturnController;

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\UtilityController as AdminUtilityController;

use App\Http\Controllers\Student\catalogController as StudentCatalogController;
use App\Http\Controllers\Student\categoryController as StudentCategoryController;
use App\Http\Controllers\Student\dashboardController as StudentDashboardController;
use App\Http\Controllers\Student\missingController as StudentMissingController;
use App\Http\Controllers\Student\profileController as StudentProfileController;
use App\Http\Controllers\Student\reservationController as StudentReservationController;
use App\Http\Controllers\Student\sectionController as StudentSectionController;

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'session.expired'])->group(function () {
    
    Route::get('/admin-assets/{path}', function ($path) {
        return response()->file(base_path('../node_modules/' . $path));
    });

    Route::get('', function () {
        return redirect()->route('login');
    });

    Route::group(['prefix' => 'student'], function(){
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');

        Route::get('catalog/filter', [StudentCatalogController::class, 'filter'])->name('student.catalog.filter');
        Route::get('catalog', [StudentCatalogController::class, 'index'])->name('student.catalog.index');
        Route::get('catalog/{id}', [StudentCatalogController::class, 'show'])->name('student.catalog.show');

        Route::resource('category', StudentCategoryController::class)->only(['index', 'show']);
        Route::resource('section', StudentSectionController::class)->only(['index', 'show']);
        Route::group(['prefix' => 'reservation'], function(){
            Route::get('', [StudentReservationController::class, 'index'])->name('student.reservation.index');
            Route::post('', [StudentReservationController::class, 'store'])->name('student.reservation.store');
        });
        Route::group(['prefix' => 'missing'], function(){
            Route::get('', [StudentMissingController::class, 'create'])->name('student.missing.create');
            Route::post('', [StudentMissingController::class, 'store'])->name('student.missing.store');
        });
        Route::group(['prefix' => 'profile'], function(){
            Route::get('', [StudentProfileController::class, 'show'])->name('student.profile.show');
            Route::post('', [StudentProfileController::class, 'update'])->name('student.profile.update');
        });
    });

    Route::group(['prefix' => 'administrator'], function(){

        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('category', [AdminCategoryController::class, 'index'])->name('admin.category.index');
        Route::get('category/{id}', [AdminCategoryController::class, 'show'])->name('admin.category.show');
        Route::post('category/update', [AdminCategoryController::class, 'update'])->name('admin.category.update');
        Route::post('category/store', [AdminCategoryController::class, 'store'])->name('admin.category.store');
        Route::post('search', [AdminCatalogController::class, 'filter'])->name('admin.catalog.filter');

            Route::get('/catalog/create', [AdminCatalogController::class, 'create'])->name('admin.catalog.create');
            Route::post('/catalog/store', [AdminCatalogController::class, 'store'])->name('admin.catalog.store');
            Route::get('/catalog/{id}', [AdminCatalogController::class, 'show'])->name('admin.catalog.show');
            Route::get('/catalog/edit', [AdminCatalogController::class, 'edit'])->name('admin.catalog.edit');
            Route::post('/catalog/update', [AdminCatalogController::class, 'update'])->name('admin.catalog.update');
            Route::get('/serial/{id}', [AdminCatalogController::class, 'showSerial'])->name('admin.catalog.show.serial');

        Route::get('reservation', [AdminReservationController::class, 'index'])->name('admin.reservation.index');
        Route::get('reservation/{student_id}', [AdminReservationController::class, 'show'])->name('admin.reservation.show');
        Route::get('reservation-show/detail', [AdminReservationController::class, 'detailReservation'])->name('admin.reservation.detail');
        Route::post('reservation', [AdminReservationController::class, 'submit'])->name('admin.reservation.submit');

        Route::get('serial', [AdminSerialController::class, 'show'])->name('serial.show');

        Route::group(['prefix' => 'loan'], function(){
            Route::get('search-student', [AdminLoanController::class, 'getStudentSearch'])->name('admin.loan.search-student');
            Route::post('result-student', [AdminLoanController::class, 'postStudentSearch'])->name('admin.loan.result-student');
            Route::get('search-catalog', [AdminLoanController::class, 'getCatalogSearch'])->name('admin.loan.search-catalog');
            Route::post('result-catalog', [AdminLoanController::class, 'postCatalogSearch'])->name('admin.loan.result-catalog');
            Route::post('loan-submit', [AdminLoanController::class, 'submit'])->name('admin.loan.submit');
            Route::post('loan-cancel', [AdminLoanController::class, 'cancel'])->name('admin.loan.cancel');
        });

        Route::group(['prefix' => 'return'], function(){
            Route::get('search-serial', [AdminReturnController::class, 'getSerialSearch'])->name('admin.return.search-serial');
            Route::post('result-serial', [AdminReturnController::class, 'postSerialSearch'])->name('admin.return.result-serial');
            Route::post('submit', [AdminReturnController::class, 'submit'])->name('admin.return.submit');
        });

        Route::resource('admin-data', AdminUserController::class);
        Route::resource('student-data', AdminStudentController::class);

        Route::post('student-activation', [AdminUtilityController::class, 'studentActivation'])->name('user.student.activation');
        Route::post('user-activation', [AdminUtilityController::class, 'userActivation'])->name('user.account.activation');

        Route::get('single-barcode', [AdminUtilityController::class, 'printSingleBookBarcode'])->name('print.single.barcode');
        Route::get('multiple-barcode', [AdminUtilityController::class, 'printMultipleBookBarcode'])->name('print.multiple.barcode');

        Route::get('generate-serial-number', [AdminUtilityController::class, 'generateBookSerial'])->name('generate.serial.number');
        Route::get('back', [AdminUtilityController::class, 'back'])->name('back');
    });
});



