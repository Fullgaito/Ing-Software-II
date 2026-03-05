<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlaskController extends Controller
{
    public function usuarios_Flask(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token miclave123',
        ])->post(env('FLASK_SERVICE_URL') . '/api/usuarios_flask', [
            'name' => $request->name,
            'email' => $request->email
        ]);
        return [
            'status' => $response->status(),
            'data' => $response->json(),
        ];
    }

    public function post_Flask(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token miclave123',
        ])->post(env('FLASK_SERVICE_URL') . '/api/posts', [
            'title' => $request->title,
            'content' => $request->content,
            'published' => $request->published,
            'user_id' => $request->user_id
        ]);
        return [
            'status' => $response->status(),
            'data' => $response->json(),
        ];
    }

}
