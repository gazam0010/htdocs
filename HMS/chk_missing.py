import pandas as pd

# Read the CSV file into a DataFrame
data = pd.read_csv('C:/xampp/htdocs/HMS/Diabetes2.csv')

# Check for missing values in the DataFrame
missing_values = data.isnull().sum()

# Display the count of missing values for each column
print(missing_values)
