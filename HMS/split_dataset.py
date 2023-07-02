import pandas as pd
from sklearn.model_selection import train_test_split

# Load the main dataset
df = pd.read_csv("C:/xampp/htdocs/HMS/Diabetes2.csv")

# Split the dataset into features (X) and labels (y)
X = df.drop(columns="CLASS")
y = df["CLASS"]

# Split the dataset into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=87)

# Create training and testing DataFrames
train_df = pd.concat([X_train, y_train], axis=1)
test_df = pd.concat([X_test, y_test], axis=1)

# Save the training and testing DataFrames to separate CSV files
train_df.to_csv("C:/xampp/htdocs/HMS/train_data.csv", index=False)
test_df.to_csv("C:/xampp/htdocs/HMS/test_data.csv", index=False)
