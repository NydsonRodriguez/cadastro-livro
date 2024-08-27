<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Livro';
    protected $primaryKey = 'Codl';
    protected $fillable = [
        'Titulo', 'Editora', 'Edicao', 'AnoPublicacao'
    ];

    public function autor()
    {
        return $this->belongsToMany(Autor::class, 'Livro_Autor');
    }

    public function assunto()
    {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto');
    }
}
