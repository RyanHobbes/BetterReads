import pandas as pd

inputCSV1 = r"\books_data.csv"  #replace with file path to csvs
inputCSV2 = r"\Books_rating.csv"

outputCSV1 = r"C:\Users\YOURUSERNAMEHERE\Documents\GitHub\BetterReads\first_1000_data.csv"  #if using default path, repalce "YOURUSERNAMEHERE" with username to put in git repo
outputCSV2 = r"C:\Users\YOURUSERNAMEHERE\Documents\GitHub\BetterReads\first_1000_rating.csv"

df = pd.read_csv(inputCSV1)

first1000 = df.head(1000)

first1000.to_csv(outputCSV1, index=False)

print(f"Saved first {len(first1000)} rows to '{outputCSV1}'")

df = pd.read_csv(inputCSV2)

first1000 = df.head(1000)

first1000.to_csv(outputCSV2, index=False)

print(f"Saved first {len(first1000)} rows to '{outputCSV2}'")
