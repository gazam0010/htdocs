import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from xgboost import XGBClassifier
from sklearn.metrics import accuracy_score

# Load the diabetes dataset
df = pd.read_csv("C:/xampp/htdocs/HMS/diabetes_preprocessed78.csv")

# Data Preprocessing
y = df["Outcome"]
X = df.drop(columns="Outcome")

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=87)

# Feature Scaling
sc = StandardScaler()
X_train_scaled = sc.fit_transform(X_train)
X_test_scaled = sc.transform(X_test)

# Define the best hyperparameters
best_params = {
    'max_depth': 10,
    'learning_rate': 0.03115524837673781,
    'n_estimators': 145,
    'subsample': 0.8068203515465858,
    'colsample_bytree': 0.8848799231417741
}

# Create the XGBoost classifier with the best hyperparameters
clf = XGBClassifier(random_state=100, **best_params)

# Train the model
clf.fit(X_train_scaled, y_train)

# Make predictions on the test set
y_pred = clf.predict(X_test_scaled)

# Calculate the testing accuracy
accuracy = accuracy_score(y_test, y_pred)
print("Testing Accuracy:", accuracy)
