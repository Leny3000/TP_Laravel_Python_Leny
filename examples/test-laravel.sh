#!/bin/bash

echo "=== Test du service Laravel ==="

echo "1. Test de base..."
curl -s http://localhost:8000/api/test | jq .

echo -e "\n2. Test des utilisateurs..."
curl -s http://localhost:8000/api/users | jq .

echo -e "\n3. Test de prédiction..."
curl -s -X POST http://localhost:8000/api/predict \
  -H "Content-Type: application/json" \
  -d '{"features": [1.2, 3.4, -0.5, 2.1]}' | jq .

echo -e "\nTests Laravel terminés !"