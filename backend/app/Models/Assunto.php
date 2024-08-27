<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Assunto';
    protected $primaryKey = 'CodAs';
    protected $fillable = [
        'Descricao'
    ];

    public function livro()
    {
        return $this->belongsToMany(Livro::class);
    }
}
