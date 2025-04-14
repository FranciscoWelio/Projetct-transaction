<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'conta',
        'carteira',
        'food',
        'meal',
    ];

    public function sentTransaction(){
        return $this->hasMany(Transaction::class,'user_id');
    }


    public static function creatTable(){
        $sql = "CREATE TABLE IF NOT EXISTS users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            conta VARCHAR(255) NOT NULL UNIQUE,
            carteira DECIMAL(10,2) DEFAULT 0.00,
            food DECIMAL(10,2) DEFAULT 0.00,
            meal DECIMAL(10,2) DEFAULT 0.00,
            created_at TIMESTAMP,
            updated_at TIMESTAMP
        )" ;
        app('db')->connection()->statement($sql);
    }
}
