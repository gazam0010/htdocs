import pandas as pd
from sklearn.metrics import f1_score

# Load the test dataset
test_data = pd.read_csv("C:/xampp/htdocs/HMS/Diabetes2.csv")

# Separate the features and true labels
X_test = test_data.drop(columns=["CLASS"])
y_true = test_data["CLASS"]

# Make predictions on the test set using your trained model
# Replace `model` with your trained model
y_pred = model.predict(X_test)

# Calculate the F1-score
f1 = f1_score(y_true, y_pred)

print("F1-score:", f1)
