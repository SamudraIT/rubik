<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $chart_options = [
        'chart_title' => 'Laporan Kasus DBD',
        'report_type' => 'group_by_date',
        'model' => 'App\Models\User',
        'group_by_field' => 'created_at',
        'group_by_period' => 'month',
        'chart_type' => 'bar',
    ];

    $chart1 = new LaravelChart($chart_options);

    return view('pages.home', compact('chart1'));
})->middleware('auth');

Route::get('/dashboard/reset-password', [AuthController::class, 'renderReset']);
Route::get('/dashboard/change-password', [AuthController::class, 'renderChange'])->name('change-password');
Route::post('change-password', [AuthController::class, 'changePassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);

