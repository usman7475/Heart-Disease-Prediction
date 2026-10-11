from flask import Flask, request, jsonify
import joblib
import numpy as np

# Initialize Flask app
app = Flask(__name__)

# Load the trained model
model = joblib.load('models/LogisticRegression.pkl')

@app.route('/predict', methods=['POST'])
def predict():
    try:
        # Parse JSON data from the request
        data = request.get_json()

        # Required fields for prediction
        required_fields = ['age', 'gender', 'blood_pressure', 'cholesterol', 'blood_sugar', 
                           'smoking', 'chest_pain', 'max_heart_rate', 'st_depression']

        # Check for missing fields
        for field in required_fields:
            if field not in data:
                raise ValueError(f"Missing field: {field}")

        # Extract and preprocess input data
        age = data['age']
        gender = 1 if data['gender'] == 'Male' else 0  # Convert gender to binary
        blood_pressure = data['blood_pressure']
        cholesterol = data['cholesterol']
        blood_sugar = data['blood_sugar']
        smoking = 1 if data['smoking'] == 'Yes' else 0  # Convert smoking to binary
        chest_pain = int(data['chest_pain'])
        max_heart_rate = data['max_heart_rate']
        st_depression = data['st_depression']

        # Create input array for the model
        input_data = np.array([[age, gender, blood_pressure, cholesterol, blood_sugar, 
                                smoking, chest_pain, max_heart_rate, st_depression]])

        # Make a prediction using the loaded model
        prediction = model.predict_proba(input_data)[0][1]  # Probability of having heart disease

        # Format response
        response = {
            "risk": f"{prediction * 100:.2f}%"
        }

        return jsonify(response)

    except Exception as e:
        # Handle errors and send response
        return jsonify({"error": str(e)}), 400

# Run the Flask app
if __name__ == '__main__':
    app.run(debug=True)
