<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $fillable = ['perguruan_tinggi_id', 'nama', 'kode', 'jenjang', 'kaprodi', 'status_akreditasi', 'tanggal_akreditasi', 'jumlah_mahasiswa'];
    
    protected $casts = [
        'tanggal_akreditasi' => 'date'
    ];
    
    public function perguruanTinggi()
    {
        return $this->belongsTo(PerguruanTinggi::class);
    }
    
    public function targetKinerja()
    {
        return $this->hasMany(TargetKinerja::class);
    }
    
    public function temuanAudit()
    {
        return $this->hasMany(TemuanAudit::class);
    }
    
    public function monitoringKinerja()
    {
        return $this->hasMany(MonitoringKinerja::class);
    }
}
