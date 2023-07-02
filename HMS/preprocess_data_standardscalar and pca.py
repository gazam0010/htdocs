import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.decomposition import PCA
from sklearn.model_selection import train_test_split

# Load the data from the CSV file
data_path = "C:/xampp/htdocs/HMS/Diabetes2.csv"
df = pd.read_csv(data_path)

# Specify the target column name
target_column = "CLASS"  # Replace with the actual target column name

# Check if the target column exists in the dataframe
if target_column not in df.columns:
    raise ValueError(f"Target column '{target_column}' not found in the dataset.")

# Separate the features and target variable
X = df.drop(target_column, axis=1)
y = df[target_column]

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Feature Scaling
scaler = StandardScaler()
X_train_scaled = scaler.fit_transform(X_train)
X_test_scaled = scaler.transform(X_test)

# Dimensionality Reduction using PCA
pca = PCA(n_components=0.95)  # Retain 95% of the variance
X_train_pca = pca.fit_transform(X_train_scaled)
X_test_pca = pca.transform(X_test_scaled)

# Output the preprocessed data to a new CSV file
preprocessed_data = pd.DataFrame(X_train_pca, columns=[f'PC{i}' for i in range(1, X_train_pca.shape[1]+1)])
preprocessed_data[target_column] = y_train.reset_index(drop=True)
preprocessed_data.to_csv('/xampp/htdocs/HMS/diabetes_preprocessed2.csv', index=False)
