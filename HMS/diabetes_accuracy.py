import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import GridSearchCV

# Load the diabetes dataset
df = pd.read_csv("C:/xampp/htdocs/HMS/diabetes.csv")

# Data Preprocessing
y = df["Outcome"]
X = df.drop(columns="Outcome")

# Feature Scaling
sc = StandardScaler()
X_scaled = sc.fit_transform(X)

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X_scaled, y, test_size=0.2, random_state=87)

# Define the parameter grid for hyperparameter tuning
param_grid = {
    'max_depth': [3, 5, 10, 20],
    'min_samples_split': [2, 5, 10, 20],
    'n_estimators': [50, 100, 200, 300]
}

# Create the RandomForestClassifier model
clf = RandomForestClassifier(random_state=100)

# Perform Grid Search to find the best hyperparameters
grid_search = GridSearchCV(clf, param_grid, cv=5)
grid_search.fit(X_train, y_train)

# Get the best hyperparameters and testing accuracy
best_params = grid_search.best_params_
testing_accuracy = grid_search.best_score_

# Print the best hyperparameters and testing accuracy
print("Best Hyperparameters:", best_params)
print("Testing Accuracy:", testing_accuracy)
