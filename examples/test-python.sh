#!/bin/bash

echo "=== Test du service Python IA ==="

echo "1. Test de santé..."
curl -s http://localhost:8001/health | jq .

echo -e "\n2. Test de prédiction directe..."
curl -s -X POST http://localhost:8001/predict \
  -H "Content-Type: application/json" \
  -d '{"features": [1.2, 3.4, -0.5, 2.1]}' | jq .

echo -e "\nTests Python terminés !"