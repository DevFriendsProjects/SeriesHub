<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atributos que podem ser atribuídos em massa.
     * Esses atributos podem ser preenchidos via métodos como `create()` e `fill()`.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atributos que devem ser ocultados durante a serialização.
     * Isso protege a senha e o token de "lembrar de mim" ao serializar o objeto (como ao retornar um JSON).
     * 
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Definição dos atributos que devem ser convertidos para tipos específicos.
     * O `email_verified_at` será convertido para o tipo `datetime`, e a `password` será automaticamente hashada.
     * 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Garante que a senha seja armazenada como um hash
        ];
    }

    /**
     * Relacionamento muitos-para-muitos com o modelo `Season`.
     * Este método cria uma relação onde o usuário pode estar associado a várias temporadas.
     */
    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }

    /**
     * Relacionamento muitos-para-muitos com o modelo `Season` através da tabela pivot `user_season`.
     * Também carrega o campo extra `series_id` da tabela pivot e inclui as colunas `created_at` e `updated_at` nos registros.
     */
    public function watchedSeasons()
    {
        return $this->belongsToMany(Season::class, 'user_season')
                    ->withPivot('series_id') // Inclui a coluna 'series_id' na tabela pivot
                    ->withTimestamps(); // Inclui 'created_at' e 'updated_at'
    }
}