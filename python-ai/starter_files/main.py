from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List
import numpy as np
from starter_files.ml_model import SimplePredictor

app = FastAPI(title="Service IA Python")

predictor = SimplePredictor()

class PredictionRequest(BaseModel):
    features: List[float]

@app.get("/")
async def root():
    return {"message": "Service Python IA actif"}

@app.get("/health")
async def health():
    return {"status": "OK"}

@app.post("/predict")
async def predict(request: PredictionRequest):
    """
    Objectif : 
    1. Récupérer les features de la requête
    2. Utiliser le modèle pour faire une prédiction
    3. Retourner le résultat en JSON
    """
    try:
        result = predictor.predict(request.features)
        return result
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))