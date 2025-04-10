<?php

namespace App\Providers;

use App\Models\Merchant;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Market;
use App\Models\Transaction;


class H2ServiceProvider extends ServiceProvider{
    public function boot(){
        User::createTable();
        Merchant::createTable();
        Transaction::createTable();
    }
}