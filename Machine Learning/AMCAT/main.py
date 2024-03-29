# -*- coding: utf-8 -*-
"""Career_Final_AMCAT.ipynb

Automatically generated by Colaboratory.

Original file is located at
    https://colab.research.google.com/drive/1o9tRByVoL9HoTLsF2lp6_I6DzFzQb9PW

# Enhanced-Analytic-System-for-Smart-University-Assistance
Name - Rahul Bordoloi                                         
Roll No - 1729048                                           
Project Name - Be-Friend      
Github Repo -  [Link](https://github.com/rahulbordoloi/Enhanced-Analytic-System-for-Smart-University-Assistance/)                  
Email - rahulbordoloi24@gmail.com, 1729048@kiit.ac.in                          
Language - Python                      
Project is Done on Google Colab.

*   Libraries Pre-requisites -  [requirements.txt](https://drive.google.com/file/d/1RmyCxSOJBOnDc-I3Xn8a_laz58f1pi4b/view?usp=sharing)        

*   Download Pre-loaded Model -  [Pickle Link](https://drive.google.com/file/d/1jRVVnEVPGb2_6UXqfTjOg-MpzqolknZz/view?usp=sharing)


To install , download the file and run -
```
!pip install -r requirements.txt
```
*   RAM of 8GB is preferred if run on Local.

# 1. Import Dataset and Libraries
"""

from google.colab import drive
drive.mount('/content/drive')

import warnings
warnings.filterwarnings("ignore")

import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns

train = pd.read_csv('/content/drive/My Drive/Minor Final/train.csv', error_bad_lines=False, header=0, skiprows=[0], encoding='ISO-8859-1')

test = pd.read_csv('/content/drive/My Drive/Minor Final/test.csv', error_bad_lines=False, header=0, skiprows=[0], encoding='ISO-8859-1')

train.head(2)

print(train.shape,test.shape)

"""# 2. Working on Train [Feature Engg and Selection]

Visualising and Dropping off the Completely Null Columns
"""

#how many values are missing in each column.
train.isnull().sum()

"""Result : There's not even a single null value in the whole dataset. <br>
Therefore we can except a plain heatmap.
"""

#visualizing and observing the null elements in the dataset
plt.figure(figsize=(10,10))
sns.heatmap(train.isnull(), cbar = False, cmap = 'YlGnBu')   #ploting missing data #cbar, cmap = colour bar, colour map

train

"""To check for duplicate columns"""

x = set()                                                    # set as to store only the unique values
for i in range(train.shape[1]):
        c1 = train.iloc[:, i]
        for j in range(i + 1, train.shape[1]):
            c2 = train.iloc[:, j]
            if c1.equals(c2):
                x.add(train.columns.values[j])
for col in x:
        print(col)

"""Result : All the columns are unique in nature"""

#gives out no of unqiue elements per column
train.nunique()

train.info()

train.describe()

train.columns

train.drop(['Candidate ID','Name','Number of characters in Original Name','Month of Birth','Year of Birth'],      # dropping unnecessary columns
           inplace = True, axis = 1)

train.drop(['State (Location)'], inplace = True, axis = 1)            # because it isn't necessary and cause more ambiguity in our data.

train.head(5)

train[train['Degree of study'] == 'X'].shape[0]

"""Therefore, Degree of Study is a Quasi-Constant Column"""

number_of_occ_per = 653/train.shape[0] * 100
print(str(number_of_occ_per) + '%')

#encoding categorical data Gender
from sklearn.preprocessing import LabelEncoder
l = LabelEncoder()
x=pd.DataFrame()
x.loc[:,'Degree'] = l.fit_transform(train.loc[:,'Degree of study'])

x

from sklearn.feature_selection import VarianceThreshold
qconstant_filter = VarianceThreshold(threshold=0.01)
qconstant_filter.fit(x)

len(x.columns[qconstant_filter.get_support()])

# len(train.columns[constant_filter.get_support()])

"""Therefore, Degree of study must be dropped."""

train.drop(['Degree of study'], inplace = True, axis = 1)

train.shape

train['10th Completion Year'].unique(), train['Year of Completion of college'].unique(), train['Quantitative Ability 1'].unique(), train['Domain Skills 1'].unique(), train['Analytical Skills 1'].unique()

train.replace(to_replace='MD', value = float(0.0), inplace = True)

train['Quantitative Ability 1'] = pd.to_numeric(train['Quantitative Ability 1'])
train['Domain Skills 1'] = pd.to_numeric(train['Domain Skills 1'])
train['Analytical Skills 1'] = pd.to_numeric(train['Analytical Skills 1'])

train['Performance'].unique(), train['Quantitative Ability 1'].unique()

train['Performance'].replace(to_replace=0.0, value = 'MD', inplace = True)

train['Performance'].unique()

train.info()

"""Checking and learning about the train set's skewness."""

#checking the skewness of the train set
train.skew(axis = 0, skipna = True)

"""Inference : some columns seems to be a lightly left-skewed. <br>
They are : 10th percentage, English 4, Quantitative Ability 2, Quantitative Ability 3, Domain Skills 2, Domain Test 4, Analytical Skills 1, Analytical Skills 2 <br>
These columns need to be later transformed.

Checking for Correlation
"""

# gives out the columns which are highly correlated amongst each other

def correlation(train, threshold = 0.90):
    corr_col = set() # Set of all the names of deleted columns
    corr_m = train.corr()
    for i in range(len(corr_m.columns)):
        for j in range(i):
            if (corr_m.iloc[i, j] >= threshold) and (corr_m.columns[j] not in corr_col):
                col = corr_m.columns[i] # getting the name of column
                corr_col.add(col)
    return corr_col

print(correlation(train,0.9))

"""Inference : There is no correlated columns"""

train.columns

"""# 3. Visualizations"""

#plotting pairwise relationships in train
sns.pairplot(train)

# Distribution Plot and ‘Boxplot of payment_amount’ to learn about its distribution and also, to know about outliers if present.
plt.figure(figsize=(8,6))

plt.subplot(1,2,1)
plt.title('English Marks Distribution Plot')
sns.distplot(train['English 1'])

plt.subplot(1,2,2)
plt.title('English Marks Spread')
sns.boxplot(y=train['English 1'])

plt.show()
plt.tight_layout()

plt.figure(figsize=(8,6))

plt.subplot(1,2,1)
plt.title('Quantitative Ability Distribution Plot')
sns.distplot(train['Quantitative Ability 1'])

plt.subplot(1,2,2)
plt.title('Quantitative Ability Spread')
sns.boxplot(y=train['Quantitative Ability 1'])

plt.show()
plt.tight_layout()

plt.figure(figsize=(8,6))

plt.subplot(1,2,1)
plt.title('Domain Skills Distribution Plot')
sns.distplot(train['Domain Skills 1'])

plt.subplot(1,2,2)
plt.title('Domain Skills Spread')
sns.boxplot(y=train['Domain Skills 1'])

plt.show()
plt.tight_layout()

plt.figure(figsize=(8,6))

plt.subplot(1,2,1)
plt.title('Analytical Skills Distribution Plot')
sns.distplot(train['Analytical Skills 1'])

plt.subplot(1,2,2)
plt.title('Analytical Skills Spread')
sns.boxplot(y=train['Analytical Skills 1'])

plt.show()
plt.tight_layout()

# Checking out the distribution of variables across different variables in train set.
plt.figure(figsize=(25, 6))

df = pd.DataFrame(train.groupby(['Performance'])['English 1'].mean().sort_values(ascending = False))
df.plot.bar()
plt.title('Performance vs English')
plt.show()

df = pd.DataFrame(train.groupby(['Performance'])['Quantitative Ability 1'].mean().sort_values(ascending = False))
df.plot.bar()
plt.title('Performance vs Quantitative Ability')
plt.show()

df = pd.DataFrame(train.groupby(['Performance'])['Domain Skills 1'].mean().sort_values(ascending = False))
df.plot.bar()
plt.title('Performance vs Domain Skills')
plt.show() 

df = pd.DataFrame(train.groupby(['Performance'])['Analytical Skills 1'].mean().sort_values(ascending = False))
df.plot.bar()
plt.title('Performance vs Analytical Skills')
plt.show()

train.columns

"""# 4.  Mapping Test and Train"""

#copying the columns from train
cols  = train.columns.to_list()
cols

print(test.shape , train.shape)

#mapping the features
test = test.reindex(columns=cols)
test.shape

"""# 5. Data Preprocessing"""

train.columns

"""Encoding categorical variables"""

!pip install --upgrade category_encoders

#encoding categorical data Gender
from sklearn.preprocessing import LabelEncoder
l = LabelEncoder()
train.loc[:,'Gender'] = l.fit_transform(train.loc[:,'Gender'])
# train.loc[:, '12th Completion year'] = l.fit_transform(train.loc[:, '12th Completion year'])
# train.loc[:, '10th Completion Year'] = l.fit_transform(train.loc[:, '10th Completion Year'])

train.loc[:,'Performance']=l.fit_transform(train.loc[:,'Performance'])

from category_encoders import TargetEncoder
encoder = TargetEncoder()
train['Specialization in study'] = encoder.fit_transform(train['Specialization in study'], train['Performance'])
# train['10Y'] = encoder.fit_transform(train['10th Completion Year'], train['Performance'])
# train['12Y'] = encoder.fit_transform(train['12th Completion year'], train['Performance'])

encoder = TargetEncoder()
train['Year of Completion of college'] = encoder.fit_transform(train['Year of Completion of college'], train['Performance'])

encoder = TargetEncoder()
train['12th Completion year'] = encoder.fit_transform(train['12th Completion year'], train['Performance'])

encoder = TargetEncoder()
train['10th Completion Year'] = encoder.fit_transform(train['10th Completion Year'], train['Performance'])

train.head(5)

train.describe()

#Correlation using heatmap
plt.figure(figsize = (10, 10))
hm = train.corr().where(np.tril(np.ones(train.corr().shape)).astype(np.bool))
sns.heatmap(hm, annot = True, cmap="YlGnBu")
plt.show()

train.columns

"""Splitting train set into x and y i.e independent variable vector and dependent variable vector."""

x = train.drop(['Performance'], axis = 1)
y = train.loc[:,'Performance']

print(x.shape,y.shape)

y = y.values.reshape(-1,1)

#plotting distribution plot of newly encoded variables
plt.figure(figsize=(8,6))

plt.subplot(1,2,1)
sns.distplot(x['Year of Completion of college'])

plt.subplot(1,2,2)
sns.distplot(x['10th Completion Year'])

plt.figure(figsize=(8,6))

plt.subplot(1,2,1)
sns.distplot(x['12th Completion year'])

plt.subplot(1,2,2)
sns.distplot(x['Specialization in study'])

"""Inference : It is highly skewed."""

#checking the skewness of the train set
x.skew(axis = 0, skipna = True)

"""Reducing skewness of the features according to their skewness amount."""

#trying square-root and log transformations
crim = np.log(x['Year of Completion of college'])
crim_s = np.sqrt(x['Year of Completion of college'])
print(crim.skew(),crim_s.skew())

#Observing the distribution plot of ‘Year of Completion of college’ after boxcox transformation.
from scipy import stats
crim_b = stats.boxcox(x['Year of Completion of college'])[0]
pd.Series(crim_b).skew()
sns.distplot(crim_b);

"""Boxcox will be the best transformation for 'Year of Completion of college'"""

x.skew()

a = np.sqrt(x['12th Completion year'])                                          #square-root transformation 
b = np.log(x['12th Completion year'])                                           #logarithimic transformation
print(a.skew(),b.skew())

a = np.sqrt(x['10th Completion Year'])                                          #square-root transformation 
b = np.log(x['10th Completion Year'])                                           #logarithimic transformation
print(a.skew(),b.skew())

#Updating the required pandas series.
a = pd.Series(stats.boxcox(x['10th Completion Year'])[0]) 
b = pd.Series(stats.boxcox(x['12th Completion year'])[0])
c = pd.Series(stats.boxcox(x['Specialization in study'])[0])  
d = pd.Series(stats.boxcox(x['Year of Completion of college'])[0])
print(a.skew(), b.skew(), c.skew(), d.skew())

x['10th Completion Year'] = a
x['12th Completion year'] = b
x['Specialization in study'] = c
x['Year of Completion of college'] = d

x.skew()

x.head(1)

x.shape

x['12th Completion year'].describe()

"""Standard Scaling all the features to come under a common range."""

from sklearn.preprocessing import StandardScaler
sc= StandardScaler()
x = sc.fit_transform(x)

x

y

"""# 6. Splitting Train into x_train/y_train"""

y.shape

from sklearn.model_selection import train_test_split
x_train, x_test, y_train, y_test = train_test_split(x, y, test_size = 0.25)

print(x_train.shape,y_train.shape)

print(x_test.shape,y_test.shape)

"""#7. Now, Model Testing!

**1. Logistic Regression**
"""

# fitting simple linear regression to the training set
from sklearn.linear_model import LogisticRegression
classifier = LogisticRegression(random_state=0)
classifier.fit(x_train, y_train)

# predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**2. Random Forest**"""

#fitting random forest classifier to the training set
from sklearn.ensemble import RandomForestClassifier as rfc
classifier = rfc(n_estimators=100,criterion='entropy',random_state=0)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

classifier.score(x_test, y_test)

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**3. Kernel - SVM**"""

#fitting kernel SVM to the training set
from sklearn.svm import SVC
classifier = SVC(kernel='rbf', random_state=0)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**4. Linear - SVM**"""

# fitting kernel SVM to the training set
from sklearn.svm import SVC
classifier = SVC(kernel='linear', random_state=0)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**5. K-NN**"""

#fitting knn to the training set
from sklearn.neighbors import KNeighborsClassifier as knc
classifier=knc(n_neighbors=10,metric='minkowski', p = 2)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**6. Decision Tree**"""

#fitting decision tree classifier to the training set
from sklearn.tree import DecisionTreeClassifier as dtc
classifier = dtc(criterion='entropy' , random_state=0)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**7. Naive Bayes**"""

#fitting naive bayes to the training set
from sklearn.naive_bayes import GaussianNB
classifier = GaussianNB()
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**8. XGBoost Classifier**"""

#fitting XGBoost to the Training Set
from xgboost import XGBClassifier
classifier=XGBClassifier()
classifier.fit(x_train,y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**9. GradientBoosting Classifier**"""

#fitting XGBoost to the Training Set
from sklearn.ensemble import GradientBoostingClassifier
classifier = GradientBoostingClassifier(n_estimators=100, learning_rate=1.0, max_depth=1)
classifier.fit(x_train, y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**10. AdaBoost Classifier**"""

#fitting XGBoost to the Training Set
from sklearn.ensemble import AdaBoostClassifier
dt = dtc()
classifier = AdaBoostClassifier(n_estimators = 100, base_estimator = dt, learning_rate = 1)
classifier.fit(x_train,y_train)

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**11. CatBoost Classifier**"""

!pip install catboost

#fitting CatBoost to the Training Set
from catboost import CatBoostClassifier
classifier = CatBoostClassifier(iterations=100, learning_rate=0.01)
classifier.fit(x_train,y_train, eval_set = (x_test, y_test))

#predicting the test set results
y_pred=classifier.predict(x_test)

"""Checking Accuracies"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(classification_report(y_test, y_pred))

#applying k-fold cross validation
from sklearn.model_selection import cross_val_score as cvs
accuracies = cvs(estimator=classifier,X=x_train,y=y_train,cv=10)
print(accuracies.mean())
print(accuracies.std())

"""**12. Light GBM**"""

!pip install lightgbm

import lightgbm as lgbm
# from sklearn import preprocessing

# kfold = KFold(n_splits=5, random_state = 0, shuffle = True)

model_lgb = lgbm.LGBMClassifier(n_iterations =50, silent = False)
model_lgb.fit(x_train, y_train)
model_lgb.score(x_test, y_test)

"""Therefore, the accuracies are - <br>
logistic regression 0.67 <br>
random forest 0.68 <br>
kernel svm 0.69 <br>
linear svm 0.71 <br>
knn 0.67 <br>
decision tree 0.50 <br>
naive bayes 0.43 <br>
xgboost 0.66 <br>
gradient boosting 0.60 <br>
adaboost 0.50 <br>
lightgbm 0.65 <br>
catboost 0.65 <br>

# So, our Best Model Selected according to its performance is Linear-SVM !

# 8. Hyperparameter Tuning and Model Optimization

Using GridSearch for searching best hyperparameter.   
Model: Linear-SVM
"""

from sklearn.model_selection import GridSearchCV
from sklearn.model_selection import StratifiedKFold

print(SVC().get_params().keys())

#using grid search method to find out the best groups of hyperparameters
clas_cv = GridSearchCV(SVC(), {'C' : [1.0, 10, 100], "gamma" : ['scale'],
                              'kernel': ['linear'], 'kernel': ['linear'], 'random_state': [0], 
                               'cache_size' : [200], 'degree': [3], 'coef0' : [0.0],
                               'decision_function_shape' : ['ovr'], 'tol' : [0.001], 'gamma' : ['scale'], 
                               'max_iter' : [-1] }, scoring = 'accuracy', cv = 10, verbose=1)
clas_cv.fit(x_train,y_train)

best_parameters=clas_cv.best_params_

#dictionary of the best parameters
clas_cv.best_params_

"""Train data using Linear-SVM with best parameters"""

c_svm = SVC(**clas_cv.best_params_)
c_svm.fit(x_train,y_train)

"""Predicting the Results."""

y_pred = c_svm.predict(x_test)
y_pred

"""Evaluating its Score"""

from sklearn.metrics import confusion_matrix, classification_report

cm=confusion_matrix(y_test, y_pred)
plt.figure(figsize = (5,5))
sns.heatmap(cm, annot=True)
plt.xlabel('Predicted')
plt.ylabel('Truth')

print(confusion_matrix(y_test, y_pred)) ; print("\n\n")

print(classification_report(y_test, y_pred))

c_svm.score(x_test, y_test), c_svm.score(x_train, y_train)

"""# 9. Saving the Model"""

import pickle
filename = 'amcat.sav'
pickle.dump(c_svm, open(filename, 'wb'))

# to check the integrity
loaded_model = pickle.load(open(filename,'rb'))
result = loaded_model.score(x_test, y_test)
print(result)

"""# 10. Creating a ML Pipeline"""

from sklearn.pipeline import Pipeline

"""Pre-Processing"""

## ingore

from sklearn.compose import ColumnTransformer
from sklearn.preprocessing import FunctionTransformer

label_enc = ['Gender']
target_enc = ['Specialization in study', 'Year of Completion of college', '12th Completion year', '10th Completion Year']
boxcox_f = ['10th Completion Year', '12th Completion year', 'Specialization in study', 'Year of Completion of college']

preprocessor = ColumnTransformer(
    transformers=[
                  ('boxcox', FunctionTransformer(stats.boxcox, validate=False), boxcox_f),
                  ('label', FunctionTransformer(LabelEncoder, validate=False), label_enc),
                  ('target', FunctionTransformer(TargetEncoder, validate=False), target_enc),
                  ('scale', StandardScaler())], 
                  remainder = 'passthrough')

"""Modeling"""

## ingore

log_reg = Pipeline(steps=[('preprocess', preprocessor),
                          ('linear_svm', SVC())
                          ]).fit(x_train, y_train);

pipe = Pipeline([('standard', StandardScaler()),
                    #('boxcox'), stats.boxcox()),
                    ('l-svm', SVC())])

pipe.fit(x_train, y_train)

score = pipe.score(x_test, y_test)
print('Linear-SVM pipeline test accuracy: %.3f' % score)

"""# 11. Generating Requirements File"""

!pip freeze > requirements.txt

"""# End."""