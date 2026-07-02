<?php

use App\Models\TransactionType;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/about', 'pages.about')->name('about');
Route::view('/issuances', 'pages.issuances')->name('issuances');
Route::view('/bac-matters', 'pages.bac-matters')->name('bac-matters');
Route::view('/organizational-chart', 'pages.organizational-chart')->name('organizational-chart');
Route::view('/transparency-seal', 'pages.transparency-seal')->name('transparency-seal');
Route::view('/citizens-charter', 'pages.citizens-charter')->name('citizens-charter');
Route::view('/contact', 'pages.contact')->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/print/transaction-types/{transactionType}/checklist', function (TransactionType $transactionType) {
        $transactionType->load('attachments');
        return view('print.transaction-type-checklist', compact('transactionType'));
    })->name('print.transaction-type.checklist');
});
