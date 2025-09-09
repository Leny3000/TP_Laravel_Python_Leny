import numpy as np
from sklearn.ensemble import RandomForestClassifier
from sklearn.preprocessing import StandardScaler

class SimplePredictor:
    """
    Modèle ML simple pour la démonstration
    TODO: Compléter cette classe
    """
    
    def __init__(self):
        # Initialiser le modèle et le scaler
        self.model = RandomForestClassifier()
        self.scaler = StandardScaler()
        self.is_trained = False
        self.train_demo_model()
    
    def train_demo_model(self):
        """
        Créer et entraîner un modèle de démonstration simple
        """
        # Génère 100 échantillons, 4 features, 2 classes
        X = np.random.randn(100, 4)
        y = np.random.randint(0, 2, 100)
        self.scaler.fit(X)
        X_scaled = self.scaler.transform(X)
        self.model.fit(X_scaled, y)
        self.is_trained = True
    
    def predict(self, features):
        """
        Faire une prédiction avec le modèle entraîné
        """
        if not self.is_trained:
            self.train_demo_model()
        features_array = np.array(features).reshape(1, -1)
        features_scaled = self.scaler.transform(features_array)
        prediction = self.model.predict(features_scaled)[0]
        confidence = max(self.model.predict_proba(features_scaled)[0])
        return {"prediction": int(prediction), "confidence": float(confidence)}