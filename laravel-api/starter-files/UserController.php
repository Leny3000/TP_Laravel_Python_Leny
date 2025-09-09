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
        // Retourner une liste d'utilisateurs factices
        // Format JSON avec id, nom, email
    }

    /**
     * TODO: Faire une prédiction via le service Python
     */
    public function predict(Request $request)
    {
        // 1. Récupérer les données de la requête
        // 2. Appeler le service Python (http://python-ai:8001/predict)
        // 3. Retourner le résultat
    }
}