import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.ensemble import RandomForestClassifier

# Load the diabetes dataset
df = pd.read_csv("C:/xampp/htdocs/HMS/diabetes.csv")

# Data Preprocessing
y = df["Outcome"]
X = df.drop(columns="Outcome")

# Feature Scaling
sc = StandardScaler()
X = sc.fit_transform(X)

# Model Training
clf = RandomForestClassifier(n_estimators=100, random_state=100)
clf.fit(X, y)

# Prompt user for parameter values
glucose = float(input("Enter Glucose: "))
bmi = float(input("Enter BMI: "))
age = float(input("Enter Age: "))
blood_pressure = float(input("Enter Blood Pressure: "))
genetic_history = input("Enter Genetic History (Yes/No): ")

# Create a new data point using user-entered parameters
new_data = [[glucose, bmi, age, blood_pressure, genetic_history]]

# Preprocess the new data point
new_data_scaled = sc.transform(new_data)

# Make a prediction on the new data point
prediction = clf.predict(new_data_scaled)

# Print the prediction
if prediction[0] == 1:
    print("The person is predicted to have diabetes.")
else:
    print("The person is predicted to be diabetes-free.")
