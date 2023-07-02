import argparse
import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.decomposition import PCA
from xgboost import XGBClassifier

df = pd.read_csv("C:/xampp/htdocs/HMS/diabetes.csv")

y = df["Outcome"]
X = df.drop(columns="Outcome")

feature_names = X.columns

sc = StandardScaler()
X_scaled = sc.fit_transform(X)

pca = PCA(n_components=0.95)
X_scaled_pca = pca.fit_transform(X_scaled)

best_params = {
    'n_estimators': 145,
    'max_depth': 10,
    'learning_rate': 0.03115524837673781,
    'subsample': 0.8068203515465858,
    'colsample_bytree': 0.8848799231417741
}

xgb = XGBClassifier(random_state=100, **best_params)
xgb.fit(X_scaled_pca, y)

parser = argparse.ArgumentParser()
parser.add_argument('--pregnancies', type=float, help='Number of Pregnancies')
parser.add_argument('--glucose', type=float, help='Glucose level')
parser.add_argument('--blood_pressure', type=float, help='Blood Pressure')
parser.add_argument('--skin_thickness', type=float, help='Skin Thickness')
parser.add_argument('--insulin', type=float, help='Insulin level')
parser.add_argument('--bmi', type=float, help='BMI')
parser.add_argument('--diabetes_pedigree', type=float, help='Diabetes Pedigree Function')
parser.add_argument('--age', type=float, help='Age')
args = parser.parse_args()

new_data = [[args.pregnancies, args.glucose, args.blood_pressure, args.skin_thickness, args.insulin,
             args.bmi, args.diabetes_pedigree, args.age]]

new_data_df = pd.DataFrame(new_data, columns=feature_names)

new_data_scaled = sc.transform(new_data_df)
new_data_scaled_pca = pca.transform(new_data_scaled)

prediction = xgb.predict(new_data_scaled_pca)

print(prediction[0])
