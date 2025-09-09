from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List
import numpy as np
from ml_model import SimplePredictor

app = FastAPI(title="Service IA Python")

# TODO: Initialiser le modèle ML
# predictor = SimplePredictor()

class PredictionRequest(BaseModel):
    features: List[float]

@app.get("/")
async def root():
    return {"message": "Service Python IA actif"}

@app.get("/health")
async def health():
    return {"status": "OK"}

# TODO: Compléter l'endpoint de prédiction
@app.post("/predict")
async def predict(request: PredictionRequest):
    """
    Objectif : 
    1. Récupérer les features de la requête
    2. Utiliser le modèle pour faire une prédiction
    3. Retourner le résultat en JSON
    """
    try:
        # Utiliser predictor.predict(request.features)
        # Retourner {"prediction": result, "confidence": score}
        pass
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))