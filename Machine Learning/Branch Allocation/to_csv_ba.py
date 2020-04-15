import numpy as np
import pandas as pd
dataset=pd.read_csv('MyDataset.csv',encoding='utf-8',error_bad_lines=False)
x=dataset.iloc[:,:6]
dataset.columns


def change(row):
    if row['Admission'] == 1:
        if row['Rank'] <= 3500:
            val = '[CS,Civil,Mech,Electronics,Electrical]'
        elif row['Rank'] > 3500 and row['Rank'] <= 8000:
            val = '[Civil,Mech,Electronics,Electrical]'
        elif row['Rank'] > 8000 and row['Rank'] <= 10000:
            val = '[Civil,Mech,Electrical]'
        elif row['Rank'] > 10000 and row['Rank'] <= 12000:
            val = '[Civil,Electrical]'
        elif row['Rank'] > 12000 and row['Rank'] <= 15000:
            val = '[Civil]'
    else:
        val = '[Not Eligible]'
    return val
x['Department']=x.apply(change,axis=1)

x.to_csv('branch_allocation.csv',index=False)
        