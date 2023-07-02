import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from tensorflow import keras
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense, Dropout
from sklearn.metrics import accuracy_score
import numpy as np

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

# Build the neural network model
model = Sequential()
model.add(Dense(128, activation='relu', input_shape=(X_train_scaled.shape[1],)))
model.add(Dense(64, activation='relu'))
model.add(Dropout(0.5))
model.add(Dense(32, activation='relu'))
model.add(Dense(1, activation='sigmoid'))

# Compile the model
optimizer = keras.optimizers.Adam(learning_rate=0.0001)
model.compile(optimizer=optimizer, loss='binary_crossentropy', metrics=['accuracy'])

# Train the model
model.fit(X_train_scaled, y_train, epochs=200, batch_size=64, verbose=1)

# Make predictions on the test set
y_pred_prob = model.predict(X_test_scaled)
y_pred = np.where(y_pred_prob > 0.5, 1, 0)

# Calculate the testing accuracy
accuracy = accuracy_score(y_test, y_pred)
print("Testing Accuracy:", accuracy)
