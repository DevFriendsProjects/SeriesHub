<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relacionamento um-para-muitos com o modelo `Season`.
     * Uma série pode ter muitas temporadas associadas.
     */
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    /**
     * Método `booted` que é chamado automaticamente quando o modelo é inicializado.
     * Aqui, estamos adicionando um listener para o evento `deleting`, que é acionado quando uma série está sendo excluída.
     * Este código garante que, ao excluir uma série, todas as suas temporadas relacionadas também sejam excluídas.
     */
    protected static function booted()
    {
        static::deleting(function ($series) {
            // Remove todas as temporadas relacionadas a série antes de excluí-la
            $series->seasons->each->delete();
        });
    }
}