<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguruanTinggi extends Model
{
    protected $fillable = ['nama', 'kode', 'jenis', 'alamat', 'status_akreditasi', 'rektor', 'telepon', 'email'];
    
    public function programStudi()
    {
        return $this->hasMany(ProgramStudi::class);
    }
    
    public function standarMutu()
    {
        return $this->hasMany(StandarMutu::class);
    }
    
    public function rencanaAudit()
    {
        return $this->hasMany(RencanaAudit::class);
    }
}
