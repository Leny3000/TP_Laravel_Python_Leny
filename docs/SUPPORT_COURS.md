# Support de cours : Introduction aux microservices Laravel & Python IA

---

## Objectifs de la présentation (15 min)
- Comprendre l’architecture microservices
- Découvrir l’intégration Laravel (API) & Python (IA)
- Prendre en main l’environnement Docker
- Savoir tester et déboguer les services

---

## 1. Qu’est-ce qu’un microservice ?
- Service indépendant, dédié à une tâche
- Communique via HTTP (API REST)
- Permet la scalabilité et la maintenance

### Exemple :
- Un service Laravel gère les utilisateurs
- Un service Python réalise des prédictions IA

---

## 2. Architecture du TP

```
+-------------------+         +-------------------+
|   Laravel API     | <-----> |   Python IA       |
| (port 8000)       |         | (port 8001)       |
+-------------------+         +-------------------+
```

- Communication via requêtes HTTP
- Docker orchestre les deux services

---

## 3. Prise en main Docker & Docker Compose
- Isolation des environnements
- Commandes principales :
  - `docker-compose up --build`
  - `docker-compose logs`
  - `docker exec -it <container> bash`

---

## 4. Développement des services
### Laravel
- Compléter les routes dans `routes/api.php`
- Tester avec `curl` ou Postman

### Python
- Compléter `main.py` et `ml_model.py`
- Tester l’API `/predict`

---

## 5. Communication inter-services
- Laravel appelle l’API Python pour obtenir des prédictions
- Utilisation de la librairie HTTP côté Laravel

---

## 6. Tests & Débogage
- Utiliser `curl` pour tester les endpoints
- Vérifier les logs Docker
- Redémarrer les services si besoin

---

## 7. Problèmes fréquents
- Ports déjà utilisés
- Erreurs de permissions
- Problèmes de dépendances Python

---

## 8. Ressources utiles
- [Laravel Docs](https://laravel.com/docs)
- [FastAPI Docs](https://fastapi.tiangolo.com/)
- [Docker Docs](https://docs.docker.com/)
- [scikit-learn](https://scikit-learn.org/)

---

## 9. Questions / Réponses

---

**Bon TP à tous !** 🚀
