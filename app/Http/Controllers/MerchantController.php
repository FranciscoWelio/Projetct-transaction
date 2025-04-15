<?php
 
namespace App\Http\Controllers;

use App\Models\Merchant;
use Request;
/**
 * @OA\Tag(
 *     name="Users",
 *     description="API user"
 * )
 */

 class MerchantController extends Controller{
    /**
     * @OA\Get(
     *      path="/web/merchants",
     *      tags={"Merchant"},
     *      summary="Lista Mercados",
     *      @OA\Response(
     *          response=200,
     *          description="Listar Mercados"
     *      )
     * )
     */
    public function index(){
        return Merchant::all();
    }

    /**
     * @OA\Post(
     *     path="/web/merchants",
     *      tags={"Merchant"},
     *      summary="Criar Mercados",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","mcc","localizaction"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="mcc", type="string"),
     *             @OA\Property(property="localizaction", type="string"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mercado Criado Com sucesso"
     *     )
     * )
     */


    public function store(Request $request){
        $validado = $request->validada([
            'name' => 'required|string',
            'mcc' => 'required|string',
            'localizaction'=> 'required|string',
        ]);
    }

    /**
     * @OA\Get(
     *      path="/web/merchants/{id}",
     *      tags={"Merchant"},
     *      summary="Lista mercados pelo ID",
     *      @OA\Parameter(
     *         name="id",
     *          description="ID do mercados",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Listar mercados"
     *      )
     * )
     */
    public function show(Merchant $merchant){
        return Merchant::find($merchant->id);
    }
}