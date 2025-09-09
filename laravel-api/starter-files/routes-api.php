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

// TODO: Créer route pour récupérer les utilisateurs
// Route::get('/users', function () {
//     return response()->json([
//         'users' => [
//             // Ajouter des utilisateurs exemple
//         ]
//     ]);
// });

// TODO: Créer route pour faire appel au service Python
// Route::post('/predict', function (Request $request) {
//     try {
//         // Appeler http://python-ai:8001/predict
//         // Retourner la réponse
//     } catch (\Exception $e) {
//         return response()->json([
//             'error' => 'Service indisponible'
//         ], 503);
//     }
// });

// Route de test (déjà fonctionnelle)
Route::get('/test', function () {
    return response()->json([
        'message' => 'Laravel API fonctionne !',
        'timestamp' => now()
    ]);
});