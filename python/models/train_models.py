import os
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
import joblib

# Ensure 'models' folder exists
os.makedirs('models', exist_ok=True)

# Load dataset
data = pd.read_csv('heart_disease.csv')

# Preprocess data
X = data.drop(columns=['target'])
y = data['target']

X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train Logistic Regression
model = LogisticRegression(max_iter=1000)
model.fit(X_train, y_train)

# Save model
joblib.dump(model, 'models/LogisticRegression.pkl')
print("Model trained and saved!")
