<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DjangoController extends Controller
{


    public function guardar_receta(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token miclave123',
        ])->post(config('services.django.url') . '/api/productos/', [
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion
            
        ]);
        return [
            'status' => $response->status(),
            'data' => $response->json(),
        ];

        
    }
    
}