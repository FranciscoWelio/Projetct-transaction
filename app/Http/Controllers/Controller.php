<?php

namespace App\Http\Controllers;

use Request;

abstract class Controller
{
    public function card(Request $request){
        $validado = $request->validada([
            'user_id' => 'required|numeric',
            'merchant_id' => 'required|numeric',
            'amount' => 'required|numeric|min:0.01',
            'mcc' => 'required|string',
        ]);
        $h2 = app('db')->connection('h2');
        try{
            $h2->beginTransaction();

            $user_id = $h2->selectOne("SELECT * FROM users WHERE id = ? FOR UPDATE", [$validado['user_id']]);
            if (!$user_id || $user_id->carteira < $validado['amount']) {
                throw new \Exception("Saldo insuficiente ou Usuário não existente");
            }
            $h2->statement("UPDATE users SET carteira = carteira - ? WHERE id = ?", [$validado['amount'], $validado['user_id']]);
        
            $transactionId = $h2->table('transaction')->insertGetId([
                'user_id' => $validado['user_id'],
                'merchant_id' => $validado['merchant_id'],
                'amount' => $validado['amount'],
                'status' => 'confimado',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $h2->commit();
            return response()->json([
                'id'=> $transactionId, 
                'status'=> 'comfirmado',
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'mesage' => ' Transaction failed: ' . $e->getMessage()
            ], 400);
        }
    }
}