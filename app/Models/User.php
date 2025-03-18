<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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

    //avatar con la inicial
    public function adminlte_image()
    {
        $inicial = strtoupper(substr($this->name, 0, 1)); //obtener la primera letra
        $svg = '<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                    <rect width="100%" height="100%" fill="#007bff"/>
                    <text x="50%" y="50%" font-size="50" fill="white" text-anchor="middle" alignment-baseline="middle">
                        ' . $inicial . '
                    </text>
                </svg>';
        
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
