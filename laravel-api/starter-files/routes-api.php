<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes - À COMPLÉTER
|--------------------------------------------------------------------------
| 
| Objectifs :
| 1. Route GET /api/users -> retourner liste d'utilisateurs
| 2. Route POST /api/predict -> appeler service Python
|
*/


// Route GET /api/users : retourne une liste d'utilisateurs exemple
Route::get('/users', function () {
    return response()->json([
        'users' => [
            ['id' => 1, 'name' => 'Alice', 'email' => 'alice@example.com'],
            ['id' => 2, 'name' => 'Bob', 'email' => 'bob@example.com'],
            ['id' => 3, 'name' => 'Charlie', 'email' => 'charlie@example.com'],
        ]
    ]);
});


// Route POST /api/predict : appelle le service Python
Route::post('/predict', function (Request $request) {
    try {
        $response = Http::post('http://python-ai:8001/predict', $request->all());
        return response()->json($response->json(), $response->status());
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Service indisponible'
        ], 503);
    }
});

// Route de test (déjà fonctionnelle)
Route::get('/test', function () {
    return response()->json([
        'message' => 'Laravel API fonctionne !',
        'timestamp' => now()
    ]);
});