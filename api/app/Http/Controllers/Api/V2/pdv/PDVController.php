<?php

namespace App\Http\Controllers\Api\V2\Pdv;

use LaravelJsonApi\Core\Document\Error;
//use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\ItemVendaNfce;
use App\Models\VendaNfce;
use App\Models\Clientes;
use App\Models\Estoque;
use App\Models\Caixa;

class PDVController extends Controller  
{
    public function busca(Request $request) {
        $produtos = Estoque::paginate(20);
        return response()->json($produtos);

    }
    

    public function finalizar(Request $request) 
    {
        $teste = '200 OK';
        return response()->json([
            'message' => "Api bonbando",
            'teste' => $teste 

        ]); 
        
    }

}