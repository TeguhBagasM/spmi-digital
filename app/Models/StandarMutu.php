<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StandarMutu extends Model
{
    protected $fillable = ['perguruan_tinggi_id', 'kode_standar', 'nama_standar', 'deskripsi', 'kategori', 'indikator_kinerja', 'status', 'tanggal_berlaku'];
    
    protected $casts = [
        'indikator_kinerja' => 'array',
        'tanggal_berlaku' => 'date'
    ];
    
    public function perguruanTinggi()
    {
        return $this->belongsTo(PerguruanTinggi::class);
    }
    
    public function targetKinerja()
    {
        return $this->hasMany(TargetKinerja::class);
    }
}
