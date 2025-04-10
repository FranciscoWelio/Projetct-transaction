<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    protected $table = 'transaction';

    protected $fillable = [
        'user_id',
        'merchant_id',
        'amount',
        'mcc',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function merchant(){
        return $this->belongsTo(Merchant::class, 'merchant_id');
    }

    public static function creatTable(){
        $sql = "CREATE TABLE IF NOT EXISTS transaction(
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            merchant_id INT NOT NULL,
            amount DECIMAL(10,2) DEFAULT 0.00,
            mcc VARCHAR(255) NOT NULL,
            status VARCHAR(255) NOT NULL,
            created_at TIMESTAMP,
            updated_at TIMESTAMP
        )" ;
        app('db')->connection()->statement($sql);
    }
}
