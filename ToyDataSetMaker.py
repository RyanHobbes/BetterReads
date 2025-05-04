import pandas as pd

inputCSV1 = r"C:\Users\amesr\Desktop\sqlite-dll-win-x86-3490100\books_data.csv"
inputCSV2 = r"C:\Users\amesr\Desktop\sqlite-dll-win-x86-3490100\Books_rating.csv"

outputCSV1 = r"C:\Users\amesr\Documents\GitHub\BetterReads\first_1000_data.csv"
outputCSV2 = r"C:\Users\amesr\Documents\GitHub\BetterReads\first_1000_rating.csv"

df = pd.read_csv(inputCSV1)

first1000 = df.head(1000)

first1000.to_csv(outputCSV1, index=False)

print(f"Saved first {len(first1000)} rows to '{outputCSV1}'")

df = pd.read_csv(inputCSV2)

first1000 = df.head(1000)

first1000.to_csv(outputCSV2, index=False)

print(f"Saved first {len(first1000)} rows to '{outputCSV2}'")
