# Conseils pour réussir le TP

## Étapes recommandées

### 1. Vérifier l'environnement
```bash
docker --version
docker-compose --version


markdown# Conseils pour réussir le TP

## Étapes recommandées

### 1. Vérifier l'environnement
```bash
docker --version
docker-compose --version
2. Démarrage
bashgit clone [votre-repo]
cd tp-microservices-simple
docker-compose up --build
3. Développement Laravel

Compléter routes/api.php
Tester avec curl http://localhost:8000/api/users

4. Développement Python

Compléter main.py et ml_model.py
Tester avec curl http://localhost:8001/predict

5. Communication

Laravel appelle Python
Tester le workflow complet

Commandes utiles
bash# Voir les logs
docker-compose logs laravel
docker-compose logs python-ai

# Redémarrer un service
docker-compose restart laravel

# Accéder au conteneur
docker exec -it tp-microservices-simple_laravel_1 bash
Problèmes fréquents
Port déjà utilisé :
bashdocker-compose down
lsof -i :8000
Erreur de permissions :
bashsudo chown -R $USER:$USER .

### 📄 docs/RESSOURCES.md

```markdown
# Ressources utiles

## Documentation officielle
- [Laravel](https://laravel.com/docs)
- [FastAPI](https://fastapi.tiangolo.com/)
- [scikit-learn](https://scikit-learn.org/)
- [Docker](https://docs.docker.com/)

## Exemples de code

### Route Laravel simple
```php
Route::get('/example', function () {
    return response()->json(['data' => 'value']);
});
Endpoint FastAPI simple
python@app.get("/example")
async def example():
    return {"data": "value"}
Appel HTTP depuis Laravel
php$response = Http::post('http://python-ai:8001/predict', [
    'features' => [1, 2, 3, 4]
]);
return $response->json();
Outils de test

curl : Tests en ligne de commande
Postman : Interface graphique
jq : Formatage JSON (curl ... | jq .)


## 🎯 Résumé des fichiers

**Total : 16 fichiers** organisés simplement :

- **Base** : 3 fichiers (README, docker-compose, gitignore)
- **Laravel** : 3 fichiers (Dockerfile + 2 starters)
- **Python** : 4 fichiers (Dockerfile, requirements + 2 starters) 
- **Examples** : 2 scripts de test
- **Docs** : 4 fichiers de documentation

**Parfait pour un TP d'amorce !** Les étudiants ont tout ce qu'il faut sans être submergés. 🚀