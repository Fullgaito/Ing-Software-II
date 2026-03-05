<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExpressController extends Controller
{
    public function usuarios_firebase(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token miclave123',
        ])->post(config('services.express.url') . '/usuarios', [
            'name' => $request->name,
            'email' => $request->email
        ]);
        return [
            'status' => $response->status(),
            'data' => $response->json(),
        ];
    }
}