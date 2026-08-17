<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LibrarianController;
use App\Http\Controllers\Admin\BorrowController;
use App\Http\Controllers\Admin\ReturnController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\FineController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\JournalController;
use App\Http\Controllers\Admin\ThesisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DeletionRequestController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Member\BorrowController as MemberBorrowController;
use App\Http\Controllers\Member\ReservationController as MemberReservationController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/e-periodical-index', [SearchController::class, 'ePeriodicalIndex'])->name('e-periodical.index');

    Route::post('/member/borrow', [MemberBorrowController::class, 'store'])->name('member.borrow.store');
    Route::get('/member/borrow', [MemberBorrowController::class, 'index'])->name('member.borrow.index');
    Route::post('/member/reserve', [MemberReservationController::class, 'store'])->name('member.reservation.store');
    Route::get('/member/reserve', [MemberReservationController::class, 'index'])->name('member.reservation.index');

    Route::middleware('role:Admin,Librarian,Working-Student')->group(function () {
        Route::resource('books', BookController::class);
        Route::resource('journals', JournalController::class);
        Route::resource('theses', ThesisController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('publishers', PublisherController::class);
        Route::resource('members', MemberController::class);
        Route::resource('return', ReturnController::class);
        Route::resource('fines', FineController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
        Route::get('/logs/data', [LogController::class, 'data'])->name('logs.data');
        Route::post('/notifications/send', [DashboardController::class, 'sendNotification'])->name('notifications.send');
        Route::middleware('role:Librarian')->group(function () {
            Route::get('/deletion-requests', [DeletionRequestController::class, 'index'])->name('deletion-requests.index');
            Route::post('/deletion-requests/{deletionRequest}/approve', [DeletionRequestController::class, 'approve'])->name('deletion-requests.approve');
            Route::post('/deletion-requests/{deletionRequest}/reject', [DeletionRequestController::class, 'reject'])->name('deletion-requests.reject');
        });

        Route::middleware('role:Working-Student')->group(function () {
            Route::get('/my-deletion-requests', [DeletionRequestController::class, 'myRequests'])->name('deletion-requests.my-requests');
        });
    });

    Route::middleware('role:Admin,Librarian,Working-Student')->group(function () {
        Route::resource('borrow', BorrowController::class);
        Route::post('borrow/{borrow}/approve', [BorrowController::class, 'approve'])->name('borrow.approve');
        Route::post('borrow/{borrow}/reject', [BorrowController::class, 'reject'])->name('borrow.reject');
        Route::resource('reservations', ReservationController::class);
        Route::post('reservations/{reservation}/approve', [ReservationController::class, 'approve'])->name('reservations.approve');
        Route::post('reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
    });

    Route::get('/books/{book}', [BookController::class, 'show'])->name('member.books.show');
    Route::get('/journals/{journal}', [JournalController::class, 'show'])->name('member.journals.show');
    Route::get('/theses/{thesis}', [ThesisController::class, 'show'])->name('member.theses.show');

    Route::middleware('role:Admin,Librarian,Working-Student')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware('role:Admin')->group(function () {
        Route::resource('librarians', LibrarianController::class);
    });
});
