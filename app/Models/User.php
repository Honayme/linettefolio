<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function canAccessPanel(Panel $panel): bool
    {
        // Ici, vous définissez la logique d'autorisation.
        // Exemple 1 : Autoriser tous les utilisateurs (pour un test rapide, non recommandé en production)
//        return true;

        // Exemple 2 : Autoriser uniquement les utilisateurs avec une adresse e-mail spécifique
         return $this->email === 'lina-marie.michel@hotmail.fr';

        // Exemple 3 : Autoriser les utilisateurs dont l'e-mail se termine par un domaine spécifique
        // et qui ont vérifié leur e-mail. [16]
        // return str_ends_with($this->email, '@votredomaine.com') && $this->hasVerifiedEmail();

        // Exemple 4 : Vérifier une colonne 'is_admin' dans votre table 'users'
        // return $this->is_admin;
    }
}
