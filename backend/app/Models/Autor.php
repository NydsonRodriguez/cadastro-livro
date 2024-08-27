<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Autor';
    protected $primaryKey = 'CodAu';
    protected $fillable = [
        'Nome'
    ];

    public function livro()
    {
        return $this->belongsToMany(Livro::class);
    }
}
