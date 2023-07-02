import argparse
import pandas as pd
from sklearn.preprocessing import StandardScaler
from sklearn.decomposition import PCA
from sklearn.ensemble import RandomForestClassifier

df = pd.read_csv("C:/xampp/htdocs/HMS/Diabetes2.csv")

y = df["CLASS"]
X = df.drop(columns="CLASS")

feature_names = X.columns

sc = StandardScaler()
X_scaled = sc.fit_transform(X)

pca = PCA(n_components=0.95)
X_scaled_pca = pca.fit_transform(X_scaled)

best_params = {
    'max_depth': 10,
    'min_samples_split': 2,
    'n_estimators': 100
}

rf = RandomForestClassifier(random_state=100, **best_params)
rf.fit(X_scaled_pca, y)

parser = argparse.ArgumentParser()
parser.add_argument('--gender', type=float, help='Gender')
parser.add_argument('--age', type=float, help='Age')
parser.add_argument('--urea', type=float, help='Urea')
parser.add_argument('--cr', type=float, help='Cr')
parser.add_argument('--hba1c', type=float, help='HbA1c')
parser.add_argument('--chol', type=float, help='Chol')
parser.add_argument('--tg', type=float, help='TG')
parser.add_argument('--hdl', type=float, help='HDL')
parser.add_argument('--ldl', type=float, help='LDL')
parser.add_argument('--vldl', type=float, help='VLDL')
parser.add_argument('--bmi', type=float, help='BMI')
args = parser.parse_args()

new_data = [[args.gender, args.age, args.urea, args.cr, args.hba1c, args.chol, args.tg, args.hdl, args.ldl, args.vldl, args.bmi]]

new_data_df = pd.DataFrame(new_data, columns=feature_names)

new_data_scaled = sc.transform(new_data_df)
new_data_scaled_pca = pca.transform(new_data_scaled)

prediction = rf.predict(new_data_scaled_pca)

print(prediction[0])
