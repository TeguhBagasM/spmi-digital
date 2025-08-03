<?php

namespace App\Http\Controllers;

use App\Models\PerguruanTinggi;
use App\Models\ProgramStudi;
use App\Models\RencanaAudit;
use Illuminate\Http\Request;

class RencanaAuditController extends Controller
{
    public function index()
    {
        $rencanaAudit = RencanaAudit::with('perguruanTinggi')
            ->latest('tanggal_mulai')
            ->paginate(15);
            
        return view('audit.rencana.index', compact('rencanaAudit'));
    }
    
    public function create()
    {
        $perguruanTinggi = PerguruanTinggi::all();
        $programStudi = ProgramStudi::all();
        return view('audit.rencana.create', compact('perguruanTinggi', 'programStudi'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'perguruan_tinggi_id' => 'required|exists:perguruan_tinggi,id',
            'nama_rencana' => 'required|string|max:255',
            'tahun_akademik' => 'required|integer|min:2020|max:2030',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'jenis_audit' => 'required|in:internal,eksternal,surveillance',
            'ruang_lingkup' => 'required|array',
            'tujuan_audit' => 'required|string'
        ]);
        
        RencanaAudit::create($validated);
        
        return redirect()->route('rencana-audit.index')
            ->with('sukses', 'Rencana audit berhasil dibuat');
    }
}
