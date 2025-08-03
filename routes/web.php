<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MonitoringKinerjaController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PerguruanTinggiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\RencanaAuditController;
use App\Http\Controllers\StandarMutuController;
use App\Http\Controllers\TargetKinerjaController;
use App\Http\Controllers\TemuanAuditController;
use App\Http\Controllers\TindakanPerbaikanController;
use App\Models\TindakanPerbaikan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Master Data
    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('perguruan-tinggi', PerguruanTinggiController::class);
        Route::resource('program-studi', ProgramStudiController::class);
        Route::resource('pengguna', PenggunaController::class);
        Route::resource('standar-mutu', StandarMutuController::class);
    });
    
    // Audit Management
    Route::prefix('audit')->name('audit.')->group(function () {
        Route::resource('rencana-audit', RencanaAuditController::class);
        Route::resource('temuan-audit', TemuanAuditController::class);
        Route::resource('tindakan-perbaikan', TindakanPerbaikanController::class);
        
        // Additional audit routes
        Route::get('rencana-audit/{rencanaAudit}/tim-auditor', [RencanaAuditController::class, 'timAuditor'])->name('rencana-audit.tim-auditor');
        Route::post('rencana-audit/{rencanaAudit}/assign-auditor', [RencanaAuditController::class, 'assignAuditor'])->name('rencana-audit.assign-auditor');
        Route::patch('temuan-audit/{temuanAudit}/status', [TemuanAuditController::class, 'updateStatus'])->name('temuan-audit.update-status');
    });
    
    // Quality Monitoring
    Route::prefix('monitoring')->name('monitoring.')->group(function () {
        Route::get('/', [MonitoringKinerjaController::class, 'index'])->name('kinerja.index');
        Route::get('/dashboard', [MonitoringKinerjaController::class, 'dashboard'])->name('kinerja.dashboard');
        Route::get('/input', [MonitoringKinerjaController::class, 'create'])->name('kinerja.input');
        Route::post('/store', [MonitoringKinerjaController::class, 'store'])->name('kinerja.store');
        Route::get('/target', [TargetKinerjaController::class, 'index'])->name('target.index');
        Route::resource('target-kinerja', TargetKinerjaController::class);
    });
    
    // Reports
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/generate', [LaporanController::class, 'generateForm'])->name('generate');
        Route::post('/create', [LaporanController::class, 'create'])->name('create');
        Route::get('/audit-summary', [LaporanController::class, 'auditSummary'])->name('audit-summary');
        Route::get('/performance-report', [LaporanController::class, 'performanceReport'])->name('performance-report');
        Route::get('/download/{laporan}', [LaporanController::class, 'download'])->name('download');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
