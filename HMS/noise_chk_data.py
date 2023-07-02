import pandas as pd

# Load the data from CSV
df = pd.read_csv("C:/xampp/htdocs/HMS/Diabetes2.csv")

# Visual inspection: Scatter plot
df.plot.scatter(x='AGE', y='Urea')

# Statistical analysis: Summary statistics
summary_stats = df.describe()
print(summary_stats)

# Data profiling: Check for missing values
missing_values = df.isnull().sum()
print(missing_values)

# Data visualization: Box plot
df.boxplot(column='HbA1c')

# Outlier detection: Z-score
from scipy import stats
z_scores = stats.zscore(df['Chol'])
outliers = (z_scores > 3) | (z_scores < -3)
print(outliers)

# Cross-validation: Split data into subsets and analyze model performance
from sklearn.model_selection import cross_val_score
from sklearn.ensemble import RandomForestClassifier

X = df[['AGE', 'Urea', 'Cr', 'HbA1c', 'Chol', 'TG', 'HDL', 'LDL', 'VLDL', 'BMI']]
y = df['CLASS']

model = RandomForestClassifier()
scores = cross_val_score(model, X, y, cv=5)
print(scores)
