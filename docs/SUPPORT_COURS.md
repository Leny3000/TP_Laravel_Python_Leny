# Support de cours technique : Microservices Laravel & Python IA

---

## 📋 Objectifs de la formation (20 min)
- **Architectures modernes** : Comprendre les microservices vs monolithe
- **Stack technique** : Laravel (API) + Python (IA) + Docker
- **Communication inter-services** : HTTP/REST, JSON, gestion d'erreurs
- **DevOps** : Containerisation, orchestration, tests automatisés

---

## 1. 🏗️ Architecture Microservices vs Monolithe

### Monolithe traditionnel
```
┌─────────────────────────────────┐
│          APPLICATION            │
│  ┌─────┐ ┌─────┐ ┌─────┐       │
│  │ Web │ │ API │ │ DB  │       │
│  └─────┘ └─────┘ └─────┘       │
│            TOUT EN UN           │
└─────────────────────────────────┘
```

### Microservices (notre TP)
```
┌─────────────────┐    HTTP    ┌─────────────────┐
│  Laravel API    │<─────────>│   Python IA     │
│                 │            │                 │
│ ┌─────────────┐ │            │ ┌─────────────┐ │
│ │ Controllers │ │            │ │   FastAPI   │ │
│ │   Routes    │ │            │ │ scikit-learn│ │
│ │   Models    │ │            │ │   Pandas    │ │
│ └─────────────┘ │            │ └─────────────┘ │
│   Port 8000     │            │   Port 8001     │
└─────────────────┘            └─────────────────┘
         │                              │
         └──────────── Docker ──────────┘
```

**Avantages :**
- 🔧 **Scalabilité** indépendante
- 🛠️ **Technologies** différentes par service
- 🚀 **Déploiement** séparé
- 👥 **Équipes** autonomes

---

## 2. 🐳 Docker : Containerisation des services

### Qu'est-ce qu'un conteneur ?
```
┌─────────────────────────────────────────┐
│              HOST SYSTEM                │
├─────────────────────────────────────────┤
│           DOCKER ENGINE                 │
├─────────────┬─────────────┬─────────────┤
│ Container 1 │ Container 2 │ Container 3 │
│             │             │             │
│  Laravel    │  Python IA  │   MySQL     │
│  PHP 8.2    │  Python 3.11│  MySQL 8.0  │
│  Composer   │  FastAPI    │             │
│             │  sklearn    │             │
└─────────────┴─────────────┴─────────────┘
```

### Docker Compose : Orchestration
```yaml
# docker-compose.yml
services:
  laravel:     # Service 1
    build: ./laravel-api
    ports: ["8000:8000"]
    
  python-ai:   # Service 2  
    build: ./python-ai
    ports: ["8001:8001"]
    
  mysql:       # Service 3
    image: mysql:8.0
```

---

## 3. 🔧 Service Laravel : API Backend

### Structure Laravel pour microservice
```
laravel-api/
├── Dockerfile              # Image PHP + Composer
├── routes/
│   └── api.php             # Routes REST (/api/*)
├── app/Http/Controllers/
│   └── UserController.php  # Logique métier
└── app/Models/
    └── User.php            # Modèles de données
```

### Exemple concret : Route API
```php
// routes/api.php
Route::get('/users', function () {
    return response()->json([
        'users' => [
            ['id' => 1, 'name' => 'Alice', 'email' => 'alice@test.com'],
            ['id' => 2, 'name' => 'Bob', 'email' => 'bob@test.com']
        ]
    ]);
});
```

### Communication avec le service Python
```php
// Appel HTTP vers le service Python
Route::post('/predict', function (Request $request) {
    try {
        $response = Http::post('http://python-ai:8001/predict', [
            'features' => $request->input('features')
        ]);
        
        return response()->json([
            'success' => true,
            'prediction' => $response->json()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Service IA indisponible'
        ], 503);
    }
});
```

**Points techniques :**
- 🔗 **URL interne** : `http://python-ai:8001` (nom du service Docker)
- ⚡ **HTTP Client** : Laravel Http facade
- 🛡️ **Gestion d'erreurs** : try/catch avec codes HTTP

---

## 4. 🐍 Service Python : Intelligence Artificielle

### Structure Python pour microservice
```
python-ai/
├── Dockerfile              # Image Python + pip
├── requirements.txt        # Dépendances (FastAPI, sklearn)
├── main.py                # API FastAPI
└── ml_model.py            # Modèle Machine Learning
```

### FastAPI : API moderne en Python
```python
# main.py
from fastapi import FastAPI
from pydantic import BaseModel
from typing import List

app = FastAPI(title="Service IA")

class PredictionRequest(BaseModel):
    features: List[float]  # Validation automatique

@app.post("/predict")
async def predict(request: PredictionRequest):
    # Traitement ML
    result = predictor.predict(request.features)
    return {"prediction": result["class"], "confidence": result["proba"]}
```

### Modèle Machine Learning intégré
```python
# ml_model.py
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import StandardScaler
import numpy as np

class SimplePredictor:
    def __init__(self):
        self.model = RandomForestClassifier(n_estimators=100)
        self.scaler = StandardScaler()
        self.is_trained = False
    
    def train_demo_model(self):
        # Données synthétiques pour la démo
        X = np.random.randn(1000, 4)  # 4 features
        y = (X[:, 0] + X[:, 1] > 0).astype(int)  # Target binaire
        
        # Preprocessing + Training
        X_scaled = self.scaler.fit_transform(X)
        self.model.fit(X_scaled, y)
        self.is_trained = True
    
    def predict(self, features):
        if not self.is_trained:
            self.train_demo_model()
            
        # Prédiction
        features_scaled = self.scaler.transform([features])
        prediction = self.model.predict(features_scaled)[0]
        confidence = max(self.model.predict_proba(features_scaled)[0])
        
        return {"class": int(prediction), "proba": float(confidence)}
```

**Points techniques :**
- ⚡ **FastAPI** : Performance + documentation automatique
- 🔍 **Pydantic** : Validation de données automatique
- 🧠 **scikit-learn** : ML classique, facile d'usage
- 📊 **Preprocessing** : StandardScaler pour normaliser

---

## 5. 🌐 Communication Inter-Services

### Flow de données complet
```
┌─────────┐    HTTP POST     ┌─────────┐    Method Call   ┌─────────┐
│ Client  │ ──────────────> │Laravel  │ ──────────────> │ Python  │
│         │  /api/predict   │ API     │  /predict       │ IA      │
└─────────┘                 └─────────┘                 └─────────┘
     │                           │                           │
     │                           │                           ▼
     │                           │                    ┌─────────────┐
     │                           │                    │   sklearn   │
     │                           │                    │   Model     │
     │                           │                    └─────────────┘
     │                           │                           │
     ▼                           ▼                           ▼
┌─────────────────────────────────────────────────────────────────┐
│  JSON Response: {"prediction": 1, "confidence": 0.87}          │
└─────────────────────────────────────────────────────────────────┘
```

### Exemple de requête complète
```bash
# 1. Client vers Laravel
curl -X POST http://localhost:8000/api/predict \
  -H "Content-Type: application/json" \
  -d '{"features": [1.2, -0.5, 2.1, 0.8]}'

# 2. Laravel vers Python (automatique)
# HTTP POST http://python-ai:8001/predict
# {"features": [1.2, -0.5, 2.1, 0.8]}

# 3. Réponse finale
{
  "success": true,
  "prediction": {
    "class": 1,
    "proba": 0.87
  },
  "service": "python-ai"
}
```

---

## 6. 🔧 Développement et Debug

### Commandes Docker essentielles
```bash
# Démarrer l'environnement
docker-compose up --build

# Voir les logs en temps réel
docker-compose logs -f laravel
docker-compose logs -f python-ai

# Accéder aux conteneurs
docker exec -it tp_laravel_1 bash
docker exec -it tp_python_1 bash

# Redémarrer un service
docker-compose restart laravel
```

### Tests des endpoints
```bash
# Test Laravel
curl http://localhost:8000/api/test
curl http://localhost:8000/api/users

# Test Python direct
curl http://localhost:8001/health
curl -X POST http://localhost:8001/predict \
  -H "Content-Type: application/json" \
  -d '{"features": [1,2,3,4]}'

# Test communication complète
curl -X POST http://localhost:8000/api/predict \
  -H "Content-Type: application/json" \
  -d '{"features": [1,2,3,4]}'
```

### Debug des erreurs courantes
```bash
# Port occupé
lsof -i :8000
docker-compose down

# Problème de permissions
sudo chown -R $USER:$USER .

# Rebuild complet
docker-compose down --volumes
docker-compose up --build
```

---

## 7. 📊 Monitoring et Performance

### Métriques importantes
```
┌─────────────────────────────────────────────┐
│              MONITORING                     │
├─────────────────┬───────────────────────────┤
│   Laravel API   │       Python IA           │
├─────────────────┼───────────────────────────┤
│ • Temps réponse │ • Temps prédiction        │
│ • Nb requêtes   │ • Précision modèle        │
│ • Erreurs HTTP  │ • Usage mémoire           │
│ • Usage CPU     │ • Cache modèle            │
└─────────────────┴───────────────────────────┘
```

### Logs structurés
```php
// Laravel - Log des appels inter-services
Log::info('Calling Python AI service', [
    'endpoint' => '/predict',
    'features_count' => count($features),
    'timestamp' => now()
]);
```

```python
# Python - Log des prédictions
import logging
logging.info(f"Prediction made: {prediction}, confidence: {confidence}")
```

---

## 8. 🚀 Bonnes Pratiques

### Sécurité
```php
// Validation des données d'entrée
$request->validate([
    'features' => 'required|array|size:4',
    'features.*' => 'numeric|between:-10,10'
]);
```

### Gestion d'erreurs robuste
```python
# Python - Gestion des exceptions ML
try:
    prediction = self.model.predict(features_scaled)
except ValueError as e:
    raise HTTPException(status_code=400, detail=f"Invalid features: {e}")
except Exception as e:
    raise HTTPException(status_code=500, detail="Model error")
```

### Configuration environnement
```bash
# .env
PYTHON_AI_URL=http://python-ai:8001
PYTHON_AI_TIMEOUT=30
ML_MODEL_VERSION=1.0
```

---

## 9. 🔍 Outils de développement

### Documentation automatique FastAPI
```
http://localhost:8001/docs    # Swagger UI
http://localhost:8001/redoc   # ReDoc
```

### Tests automatisés
```php
// Laravel - Test Feature
public function test_prediction_endpoint()
{
    $response = $this->postJson('/api/predict', [
        'features' => [1.0, 2.0, 3.0, 4.0]
    ]);
    
    $response->assertStatus(200)
             ->assertJsonStructure(['prediction', 'confidence']);
}
```

### Profiling et performance
```python
# Python - Mesure de performance
import time
start_time = time.time()
prediction = model.predict(features)
execution_time = time.time() - start_time
```

---

## 10. 💡 Extensions possibles

### Cache Redis
```php
// Laravel - Cache des prédictions
$cacheKey = 'prediction_' . md5(json_encode($features));
$result = Cache::remember($cacheKey, 3600, function() use ($features) {
    return Http::post('http://python-ai:8001/predict', compact('features'));
});
```

### Queue système
```php
// Laravel - Prédictions asynchrones
dispatch(new PredictionJob($features, $userId));
```

### Modèles plus avancés
```python
# TensorFlow/Keras
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense

# PyTorch
import torch
import torch.nn as nn
```

---

## 🎯 Récapitulatif technique

| Aspect | Laravel | Python |
|--------|---------|--------|
| **Rôle** | API Gateway | Service IA |
| **Port** | 8000 | 8001 |
| **Framework** | Laravel 10 | FastAPI |
| **Runtime** | PHP 8.2 | Python 3.11 |
| **Base de données** | Eloquent ORM | pandas/numpy |
| **Validation** | Form Requests | Pydantic |
| **Tests** | PHPUnit | pytest |
| **Documentation** | Laravel Docs | OpenAPI/Swagger |

---

## 🔧 Checklist de validation

- [ ] ✅ Conteneurs démarrent sans erreur
- [ ] ✅ Laravel répond sur `/api/test`
- [ ] ✅ Python répond sur `/health`
- [ ] ✅ Communication inter-services fonctionne
- [ ] ✅ Prédictions ML correctes
- [ ] ✅ Gestion d'erreurs implémentée
- [ ] ✅ Logs structurés
- [ ] ✅ Code versionné sur Git

---

## 📚 Ressources avancées

- **Architecture** : [Microservices Patterns](https://microservices.io/patterns/)
- **Laravel** : [API Resources](https://laravel.com/docs/10.x/eloquent-resources)
- **FastAPI** : [Advanced Features](https://fastapi.tiangolo.com/advanced/)
- **ML** : [scikit-learn User Guide](https://scikit-learn.org/stable/user_guide.html)
- **Docker** : [Best Practices](https://docs.docker.com/develop/best-practices/)

---

## ❓ Questions & Discussion

**Prêts pour le TP pratique ?** 🚀
