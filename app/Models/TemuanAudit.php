<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuanAudit extends Model
{
    protected $fillable = ['rencana_audit_id', 'program_studi_id', 'auditor_id', 'kode_temuan', 'deskripsi_temuan', 'kategori', 'bukti_audit', 'rekomendasi', 'status', 'target_penyelesaian', 'tanggal_audit'];
    
    protected $casts = [
        'target_penyelesaian' => 'date',
        'tanggal_audit' => 'date'
    ];
    
    public function rencanaAudit()
    {
        return $this->belongsTo(RencanaAudit::class);
    }
    
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class);
    }
    
    public function auditor()
    {
        return $this->belongsTo(Pengguna::class, 'auditor_id');
    }
    
    public function tindakanPerbaikan()
    {
        return $this->hasMany(TindakanPerbaikan::class);
    }
}
