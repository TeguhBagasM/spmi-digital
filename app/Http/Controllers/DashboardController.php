<?php

namespace App\Http\Controllers;

use App\Models\MonitoringKinerja;
use App\Models\ProgramStudi;
use App\Models\RencanaAudit;
use App\Models\TemuanAudit;
use App\Models\TindakanPerbaikan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $statistik = [
            'total_program_studi' => ProgramStudi::count(),
            'audit_aktif' => RencanaAudit::where('status', 'berlangsung')->count(),
            'temuan_terbuka' => TemuanAudit::where('status', 'terbuka')->count(),
            'tindakan_selesai' => TindakanPerbaikan::where('status', 'selesai')->count(),
        ];
        
        $temuanTerbaru = TemuanAudit::with(['rencanaAudit', 'programStudi'])
            ->where('status', 'terbuka')
            ->latest('tanggal_audit')
            ->take(5)
            ->get();
            
        $trenKinerja = MonitoringKinerja::selectRaw('tahun_akademik, AVG(nilai_aktual) as rata_kinerja')
            ->groupBy('tahun_akademik')
            ->orderBy('tahun_akademik')
            ->get();
        
        return view('dashboard', compact('statistik', 'temuanTerbaru', 'trenKinerja'));
    }
}
