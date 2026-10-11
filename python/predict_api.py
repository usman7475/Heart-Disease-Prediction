from flask import Flask, jsonify, request
from flask_cors import CORS
import joblib
import numpy as np

app = Flask(__name__)
CORS(app)

# Load the trained models
logistic_model = joblib.load('models/LogisticRegression.pkl')
rf_model = joblib.load('models/RandomForest.pkl')
svm_model = joblib.load('models/SVM.pkl')

# Route for the root URL
@app.route('/')
def home():
    return "Flask server is running. Use the /predict endpoint for predictions."

# Prediction route
@app.route('/predict', methods=['POST'])
def predict():
    try:
        # Get input data from the request (assuming JSON format)
        data = request.get_json()

        # Extract data points from the input JSON
        age = data['age']
        gender = data['gender']
        blood_pressure = data['blood_pressure']
        cholesterol = data['cholesterol']
        blood_sugar = data['blood_sugar']
        smoking = data['smoking']
        chest_pain = data['chest_pain']
        max_heart_rate = data['max_heart_rate']
        st_depression = data['st_depression']

        # Preprocessing data (e.g., convert categorical data to numerical form)
        # You can add more preprocessing steps if needed

        # Create a feature array
        features = np.array([[age, gender, blood_pressure, cholesterol, blood_sugar,
                             smoking, chest_pain, max_heart_rate, st_depression]])

        # Make predictions using the loaded models
        logistic_pred = logistic_model.predict(features)
        rf_pred = rf_model.predict(features)
        svm_pred = svm_model.predict(features)

        # Calculate probabilities (if model supports it, else use the raw prediction)
        logistic_prob = logistic_model.predict_proba(features)[0][1] * 100  # Assuming binary classification
        rf_prob = rf_model.predict_proba(features)[0][1] * 100
        svm_prob = svm_model.predict_proba(features)[0][1] * 100

        # Send the response with predictions and probabilities
        return jsonify({
            'logistic_regression': {
                'prediction': logistic_pred[0],
                'probability': logistic_prob
            },
            'random_forest': {
                'prediction': rf_pred[0],
                'probability': rf_prob
            },
            'svm': {
                'prediction': svm_pred[0],
                'probability': svm_prob
            }
        })

    except Exception as e:
        # If any error occurs (e.g., invalid input format), return an error message
        return jsonify({'error': str(e)})

if __name__ == '__main__':
    app.run(debug=True)
