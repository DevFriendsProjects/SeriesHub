<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'season_number',
        'series_id',
    ];

    /**
     * Relacionamento muitos-para-muitos com o modelo `User`.
     * Define que uma temporada pode ser assistida por vários usuários e o relacionamento é mantido na tabela `user_season`.
     * O método `withTimestamps` adiciona timestamps ao relacionamento.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_season')->withTimestamps();
    }

    /**
     * Relacionamento muitos-para-um com o modelo `Series`.
     * Uma temporada pertence a uma única série.
     */
    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    /**
     * Método `booted` que é chamado automaticamente quando o modelo é inicializado.
     * Aqui, estamos adicionando um listener para o evento `deleting`, que é acionado quando uma temporada está sendo excluída.
     * Este código garante que, ao excluir uma temporada, todas as relações com usuários na tabela pivot `user_season` sejam removidas.
     */
    protected static function booted()
    {
        static::deleting(function ($season) {
            // Remove todas as relações com usuários na tabela `user_season`
            $season->users()->detach();
        });
    }
}