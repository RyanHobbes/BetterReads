import pandas as pd

inputCSV1 = r"C:\Users\amesr\Desktop\sqlite-dll-win-x86-3490100\books_data.csv"  #replace with file path to csvs
inputCSV2 = r"C:\Users\amesr\Desktop\sqlite-dll-win-x86-3490100\Books_rating.csv"

outputCSV1 = r"C:\Users\amesr\Documents\GitHub\BetterReads\first_10000_data.csv"  #if using default path, repalce "YOURUSERNAMEHERE" with username to put in git repo
outputCSV2 = r"C:\Users\amesr\Documents\GitHub\BetterReads\first_10000_rating.csv"


# Function to sample every 50th row up to 10,000 entries
def sample_every_3(filepath, output_path):
    df = pd.read_csv(filepath)
    sampled = df.iloc[::3].head(10000)
    sampled.to_csv(output_path, index=False)
    print(f"Saved {len(sampled)} sampled rows to '{output_path}'")

# Sample both files
sample_every_3(inputCSV1, outputCSV1)
sample_every_3(inputCSV2, outputCSV2)