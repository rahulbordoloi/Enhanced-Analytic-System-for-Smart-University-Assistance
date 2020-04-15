#importing libraries
import numpy as np
import pandas as pd

df = pd.read_csv('Branch_Allocation_Final.csv',error_bad_lines=False)
x=df.iloc[:,:5]
y=df.iloc[:,-1]

"""# Data Preprocessing"""

#encoding categorical data
from sklearn.preprocessing import LabelEncoder
l = LabelEncoder()
x.iloc[:,-1]=l.fit_transform(x.iloc[:,-1])           #gender
y.iloc[:] = l.fit_transform(y.iloc[:])             #department    
x.iloc[:,1] = l.fit_transform(x.iloc[:,1])         #nationality
def change(row):
    if row['12th'] >= 65:
      return 1
    else:
      return 0
#adding admission column
x['Adm']=x.apply(change,axis=1)
from sklearn.preprocessing import StandardScaler
sc= StandardScaler()
x = sc.fit_transform(x)
#splitting the dataset into training set and test set
from sklearn.model_selection import train_test_split
x_train, x_test, y_train, y_test = train_test_split(x, y ,test_size = 0.25, random_state = 0,shuffle=True)

# Model Training

#fitting decision tree classifier to the training set
from sklearn.tree import DecisionTreeClassifier as dtc
classifier = dtc(criterion='entropy' ,random_state=0, splitter='best', max_depth=4)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)
"""# End"""

#saving the model
import pickle
filename = 'branch_allocation.sav'
pickle.dump(classifier, open(filename, 'wb'))