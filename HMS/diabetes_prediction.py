import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.decomposition import PCA
from xgboost import XGBClassifier

# Load the diabetes dataset
df = pd.read_csv("C:/xampp/htdocs/HMS/diabetes.csv")

# Data Preprocessing
y = df["Outcome"]
X = df.drop(columns="Outcome")

# Get the feature names
feature_names = X.columns

# Feature Scaling
sc = StandardScaler()
X_scaled = sc.fit_transform(X)

# Apply PCA for dimensionality reduction
pca = PCA(n_components=0.95)
X_scaled_pca = pca.fit_transform(X_scaled)

# Model Training with Best Hyperparameters
best_params = {
    'n_estimators': 145,
    'max_depth': 10,
    'learning_rate': 0.03115524837673781,
    'subsample': 0.8068203515465858,
    'colsample_bytree': 0.8848799231417741
}

xgb = XGBClassifier(random_state=100, **best_params)
xgb.fit(X_scaled_pca, y)

# Prompt user for parameter values
pregnancies = float(input("Enter the number of Pregnancies: "))
glucose = float(input("Enter Glucose level: "))
blood_pressure = float(input("Enter Blood Pressure: "))
skin_thickness = float(input("Enter Skin Thickness: "))
insulin = float(input("Enter Insulin level: "))
bmi = float(input("Enter BMI: "))
diabetes_pedigree = float(input("Enter Diabetes Pedigree Function: "))
age = float(input("Enter Age: "))

# Create a new data point using user-entered parameters
new_data = [[pregnancies, glucose, blood_pressure, skin_thickness, insulin, bmi, diabetes_pedigree, age]]

# Create a DataFrame with the user-entered data and feature names
new_data_df = pd.DataFrame(new_data, columns=feature_names)

# Preprocess the new data point
new_data_scaled = sc.transform(new_data_df)
new_data_scaled_pca = pca.transform(new_data_scaled)

# Make a prediction on the new data point
prediction = xgb.predict(new_data_scaled_pca)

# Print the prediction
if prediction[0] == 1:
    print("The person is predicted to have diabetes.")
else:
    print("The person is predicted to be diabetes-free.")
