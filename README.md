# Heart Disease Prediction

A web application that estimates heart disease risk from patient clinical details. Users fill a form in the browser; PHP forwards the data to a Flask API, which runs a trained machine learning model and returns a risk score.

**This project is for learning and demonstration only. It is not a medical diagnosis tool and must not be used for clinical decisions.**

---

## Features

- Simple web form for patient details (age, blood pressure, cholesterol, and other clinical fields)
- PHP backend that sends JSON to a local Flask prediction API
- Logistic Regression model trained on a heart disease dataset
- Optional multi-model API (Logistic Regression, Random Forest, SVM) in `python/predict_api.py`
- Bootstrap-based UI

---

## Tech Stack

| Layer | Technology |
| --- | --- |
| Frontend | HTML, CSS, Bootstrap, PHP |
| API | Python, Flask |
| Machine Learning | scikit-learn, pandas, NumPy, joblib |
| Local server | XAMPP (Apache + PHP) |

---

## Project Structure

```
machine-learning/
├── index.php                 # Prediction form
├── predict.php               # Sends form data to Flask and shows the result
├── python/
│   ├── predict_api.py        # Flask API with three models (LR, RF, SVM)
│   └── models/
│       ├── train_models.py   # Train and save Logistic Regression
│       ├── predict_api.py    # Flask API used by the PHP form (returns risk %)
│       └── heart_disease.csv # Training dataset
└── README.md
```

---

## Dataset

The CSV file `python/models/heart_disease.csv` contains these columns:

| Column | Description |
| --- | --- |
| `age` | Age in years |
| `gender` | `1` = Male, `0` = Female |
| `blood_pressure` | Resting blood pressure |
| `cholesterol` | Serum cholesterol |
| `blood_sugar` | Fasting blood sugar flag |
| `smoking` | `1` = Smoker, `0` = Non-smoker |
| `chest_pain` | Chest pain type (`1`–`4`) |
| `max_heart_rate` | Maximum heart rate achieved |
| `st_depression` | ST depression induced by exercise |
| `target` | `1` = heart disease present, `0` = not present |

---

## Requirements

- [XAMPP](https://www.apachefriends.org/) (or another PHP + Apache setup)
- PHP with the **cURL** extension enabled
- Python 3.8 or later
- pip

Python packages:

```
flask
flask-cors
numpy
pandas
scikit-learn
joblib
```

Install them with:

```bash
pip install -r requirements.txt
```

---

## Setup and Run

### 1. Place the project

Copy this folder into your XAMPP web root, for example:

```
C:\xampp\htdocs\machine-learning
```

### 2. Train the model

From a terminal:

```bash
cd python/models
python train_models.py
```

This creates `python/models/models/LogisticRegression.pkl`.

If you want to use `python/predict_api.py` (three models), you also need `RandomForest.pkl` and `SVM.pkl` in the same `models` folder.

### 3. Start the Flask API

The PHP form (`predict.php`) calls `http://127.0.0.1:5000/predict` and expects a JSON field named `risk`. Use the API in `python/models/`:

```bash
cd python/models
python predict_api.py
```

Flask should start on `http://127.0.0.1:5000`.

Leave this terminal open while you use the website.

### 4. Start Apache

Open the XAMPP Control Panel and start **Apache**.

### 5. Open the app

In a browser:

```
http://localhost/machine-learning/index.php
```

Fill in the patient details and click **Predict Risk**. The result page shows estimated risk as a percentage.

---

## How It Works

1. The user submits clinical values on `index.php`.
2. `predict.php` builds a JSON payload and POSTs it to the Flask `/predict` endpoint.
3. Flask loads the saved scikit-learn model, runs `predict_proba`, and returns a risk percentage.
4. PHP displays the result or an error if the API is not running.

---

## API Example

**Endpoint:** `POST http://127.0.0.1:5000/predict`

**Request body:**

```json
{
  "age": 63,
  "gender": "Male",
  "blood_pressure": 145,
  "cholesterol": 233,
  "blood_sugar": 1,
  "smoking": "Yes",
  "chest_pain": 3,
  "max_heart_rate": 150,
  "st_depression": 2.3
}
```

**Success response:**

```json
{
  "risk": "72.45%"
}
```

---

## Troubleshooting

| Problem | What to check |
| --- | --- |
| Error connecting to Flask API | Flask must be running on port 5000 before you submit the form |
| Missing `.pkl` file | Run `train_models.py` first |
| PHP cURL error | Enable `extension=curl` in `php.ini` and restart Apache |
| Page not found | Confirm the folder name under `htdocs` matches the URL |

---

## Author

**Usman Younis**  
Email: [usmanyounis7475@gmail.com](mailto:usmanyounis7475@gmail.com)

---

## License

This project is provided for educational use. You may use and modify it freely for learning purposes.
