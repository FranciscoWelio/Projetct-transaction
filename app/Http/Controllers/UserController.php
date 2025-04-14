<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Request;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="API user"
 * )
 */

class UserController extends Controller{
    /**
     * @OA\Get(
     *      path="/web/users,
     *      tags={"Users},
     *      summary="Lista usuários",
     *      @Oa\Response(
     *          response=200,
     *          description="Listar usuários"
     *      )
     * )
     */
    public function index(){
        return User::all();
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Criando Usuário",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","conta","carteira","food","meal"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="conta", type="string"),
     *             @OA\Property(property="carteira", type="decimal"),
     *             @OA\Property(property="food", type="decimal"),
     *             @OA\Property(property="meal", type="decimal")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuários Criado Com sucesso"
     *     )
     * )
     */


    public function store(Request $request){
        $validado = $request->validada([
            'name' => 'required|string',
            'email' => 'required|string',
            'conta' => 'required|string',
            'carteira' => 'required|numeric',
            'food' => 'required|numeric',
            'meal' => 'required|numeric',
        ]);
    }

    /**
     * @OA\Get(
     *      path="/web/users,
     *      tags={"Users},
     *      summary="Lista usuários pelo ID",
     *      @OA\Parameter(
     *         name="id",
     *          description="ID do Usuário",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @Oa\Response(
     *          response=200,
     *          description="Listar usuários"
     *      )
     * )
     */
    public function show(User $user){
        return User::find($user->id);
    }
}