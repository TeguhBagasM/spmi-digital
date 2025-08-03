<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\RencanaAudit;
use App\Models\TemuanAudit;
use Illuminate\Http\Request;

class TemuanAuditController extends Controller
{
    public function index()
    {
        $temuan = TemuanAudit::with(['rencanaAudit', 'programStudi', 'auditor'])
            ->latest('tanggal_audit')
            ->paginate(15);
            
        return view('audit.temuan.index', compact('temuan'));
    }
    
    public function create()
    {
        $rencanaAudit = RencanaAudit::where('status', 'berlangsung')->get();
        $programStudi = ProgramStudi::all();
        return view('audit.temuan.create', compact('rencanaAudit', 'programStudi'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rencana_audit_id' => 'required|exists:rencana_audit,id',
            'program_studi_id' => 'nullable|exists:program_studi,id',
            'deskripsi_temuan' => 'required|string',
            'kategori' => 'required|in:mayor,minor,observasi,kekuatan',
            'bukti_audit' => 'required|string',
            'rekomendasi' => 'required|string',
            'target_penyelesaian' => 'required|date|after:today'
        ]);
        
        // Generate kode temuan otomatis
        $kodeTemuan = 'TMN-' . date('Y') . '-' . str_pad(TemuanAudit::count() + 1, 4, '0', STR_PAD_LEFT);
        
        $validated['kode_temuan'] = $kodeTemuan;
        $validated['auditor_id'] = auth()->id;
        $validated['tanggal_audit'] = now();
        $validated['status'] = 'terbuka';
        
        TemuanAudit::create($validated);
        
        return redirect()->route('temuan-audit.index')
            ->with('sukses', 'Temuan audit berhasil dicatat');
    }
}
