<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prato extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'imagem',
        'user_id',
    ];

    /**
     * Define o relacionamento que um Prato pertence a um Usuário.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}