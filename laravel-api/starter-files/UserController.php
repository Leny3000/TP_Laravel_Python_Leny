<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * TODO: Récupérer la liste des utilisateurs
     */
    public function index()
    {
        // Retourne une liste d'utilisateurs factices
        $users = [
            ['id' => 1, 'name' => 'Alice', 'email' => 'alice@example.com'],
            ['id' => 2, 'name' => 'Bob', 'email' => 'bob@example.com'],
            ['id' => 3, 'name' => 'Charlie', 'email' => 'charlie@example.com'],
        ];
        return response()->json(['users' => $users]);
    }

    /**
     * TODO: Faire une prédiction via le service Python
     */
    public function predict(Request $request)
    {
        try {
            $response = Http::post('http://python-ai:8001/predict', $request->all());
            return response()->json($response->json(), $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Service indisponible'
            ], 503);
        }
    }
}