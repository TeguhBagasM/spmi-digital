<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaAudit extends Model
{
    protected $fillable = ['perguruan_tinggi_id', 'nama_rencana', 'tahun_akademik', 'tanggal_mulai', 'tanggal_selesai', 'jenis_audit', 'ruang_lingkup', 'tujuan_audit', 'status'];
    
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'ruang_lingkup' => 'array'
    ];
    
    public function perguruanTinggi()
    {
        return $this->belongsTo(PerguruanTinggi::class);
    }
    
    public function timAuditor()
    {
        return $this->hasMany(TimAuditor::class);
    }
    
    public function temuanAudit()
    {
        return $this->hasMany(TemuanAudit::class);
    }
}
