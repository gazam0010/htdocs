import pandas as pd
from sklearn.model_selection import train_test_split, GridSearchCV
from sklearn.preprocessing import StandardScaler
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import accuracy_score
import multiprocessing

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

# Define the parameter grid for hyperparameter tuning
param_grid = {
   'max_depth': [3, 5, 10, 20],
    'min_samples_split': [2, 5, 10, 20],
    'n_estimators': [50, 100, 200, 300]
}

# Create the random forest classifier
clf = RandomForestClassifier(random_state=100)

# Get the number of available CPUs
num_cpus = multiprocessing.cpu_count()
print("Available CPUs:", num_cpus)

# Ask the user for the number of CPUs to use
num_cpus_to_use = int(input("Enter the number of CPUs to use (1 to {}): ".format(num_cpus)))

# Validate the user input
if num_cpus_to_use < 1 or num_cpus_to_use > num_cpus:
    print("Invalid number of CPUs. Using all available CPUs.")
    num_cpus_to_use = num_cpus


print("Starting Process...")

# Perform grid search cross-validation with parallel processing
grid_search = GridSearchCV(clf, param_grid, cv=5, n_jobs=num_cpus_to_use)
grid_search.fit(X_train_scaled, y_train)

# Print the best hyperparameters
print("Best Hyperparameters:", grid_search.best_params_)

# Get the best model
best_model = grid_search.best_estimator_

# Make predictions on the test set
y_pred = best_model.predict(X_test_scaled)

# Calculate the testing accuracy
accuracy = accuracy_score(y_test, y_pred)
print("Testing Accuracy:", accuracy)
