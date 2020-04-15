#importing libraries
import numpy as np
import pandas as pd
import seaborn as sns
import matplotlib.pyplot as plt

x1 = pd.read_csv('AMML.csv',error_bad_lines=False,header=0,skiprows=[0]) #,header=None)

x=x1.iloc[:,13:-1]
y=x1.iloc[:,-1]
#encoding categorical data
from sklearn.preprocessing import LabelEncoder
labelencoder_y = LabelEncoder()
y=labelencoder_y.fit_transform(y)
labelencoder_x = LabelEncoder()
x.iloc[:,1] = labelencoder_x.fit_transform(x.iloc[:,1])
x.replace(to_replace='MD',value=0,inplace=True)
from sklearn.preprocessing import StandardScaler
sc_x= StandardScaler()
x = sc_x.fit_transform(x)
#splitting the dataset into training set and test set
from sklearn.model_selection import train_test_split
x_train, x_test, y_train, y_test = train_test_split(x, y ,test_size = 0.25, random_state = 0)

y=y.reshape(-1, 1)

"""Random Forest"""

#fitting random forest classifier to the training set
from sklearn.ensemble import RandomForestClassifier as rfc
classifier = rfc(n_estimators=10000,criterion='entropy',verbose=0,random_state=0)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)


import pickle
filename = 'amcat.sav'
pickle.dump(classifier, open(filename, 'wb'))

"""loaded_model=pickle.load(open(filename,'rb'))
result=loaded_model.score(x_test, y_test)
print(result)"""