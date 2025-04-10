<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Merchant extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    protected $table = 'merchant';

    protected $fillable = [
        'name',
        'mcc',
        'localizaction',
    ];

    public function sentTransaction(){
        return $this->hasMany(Transaction::class,merchant_id);
    }


    public static function creatTable(){
        $sql = "CREATE TABLE IF NOT EXISTS merchant(
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            mcc VARCHAR(255) NOT NULL,
            localizaction VARCHAR(255) NOT NULL,
            created_at TIMESTAMP,
            updated_at TIMESTAMP
        )" ;
        app('db')->connection()->statement($sql);
    }
}
