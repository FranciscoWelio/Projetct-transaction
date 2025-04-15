<?php
 
namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Merchant;
use Request;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="API user"
 * )
 */

class TransactionController extends Controller{
    /**
     * @OA\Get(
     *      path="/web/transactions",
     *      tags={"Transaction"},
     *      summary="Lista Transações",
     *      @OA\Response(
     *          response=200,
     *          description="Listar Transações"
     *      )
     * )
     */
    public function index(){
        return User::all();
    }

    
    /**
     * @OA\Post(
     *     path="/web/transactions",
     *      tags={"Transaction"},
     *     summary="Criando Transações",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id","merchant_id","amount","mcc","status"},
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="merchant_id", type="integer", format="email"),
     *             @OA\Property(property="amount", type="number", minimum="0.01"),
     *             @OA\Property(property="mcc", type="status"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transações Criada Com sucesso"
     *     )
     * )
     */


    public function store(Request $request){
        $validado = $request->validada([
            'user_id' => 'required|exists:users,id',
            'merchant_id' => 'required|exists:merchant,id',
            'amount' => 'required|numeric|min:0.01',
            'status' => 'required|string',
        ]);
        $user_id = User::find($validado['user_id']);
        $merchant_id = Merchant::find($validado['merchant_id']);

        if($user_id->carteira < $validado['amount']){
            return response()->json(['message' => 'Saldo insuficiente'].  400);
        }

        $transaction = Transaction::create([
            'user_id'=> $user_id->id,
            'merchatn_id'=> $merchant_id->id,
            'amount'=> $validado['amount'],
            'status'=> 'Pendente',
        ]);
        try{
            $user_id->carteira -= $validado['amount'];
            
            $user_id->save();

            $transaction->status = 'Concluído';
            $transaction->save();
            return response()->json($transaction,200);
        }catch(\Exception $e){
            $transaction ->status = 'Falho';
            $transaction->save();
            return response()->json(['message' =>  'Fallha na Transação'],500);
        }


    }

    /**
     * @OA\Get(
     *      path="/web/transactions/{id}",
     *      tags={"Transaction"},
     *      summary="Lista Transações pelo ID",
     *      @OA\Parameter(
     *         name="id",
     *          description="ID do Transações",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Listar Transações"
     *      )
     * )
     */
    public function show(Transaction $transaction){
        return Transaction::find($transaction->id);
    }
}