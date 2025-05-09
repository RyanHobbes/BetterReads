import pandas as pd
import re

# File paths
inputCSV1 = r"C:\Users\amesr\Desktop\sqlite-dll-win-x86-3490100\books_data.csv"
inputCSV2 = r"C:\Users\amesr\Desktop\sqlite-dll-win-x86-3490100\Books_rating.csv"

outputCSV1 = r"C:\Users\amesr\Documents\GitHub\BetterReads\first_10000_data.csv"
outputCSV2 = r"C:\Users\amesr\Documents\GitHub\BetterReads\first_10000_rating.csv"

# Default values
DEFAULT_LINK = "https://media.istockphoto.com/id/1408742178/vector/red-no-sign-circle-frame-on-checkered-background.jpg?s=612x612&w=0&k=20&c=TtIPCqGuuCMH6DpeCHCFb4bx4KNW6KRCZ7tPi4rFCo0="
DEFAULT_DESCRIPTION = "Description not available"
DEFAULT_DATE = "2050"
DEFAULT_RATING = 0

def clean_books_data(df):
    if 'description' in df.columns:
        df['description'] = df['description'].fillna('').apply(
            lambda x: DEFAULT_DESCRIPTION if str(x).strip() == '' else x
        )

    for col in ['image', 'previewLink', 'infoLink']:
        if col in df.columns:
            df[col] = df[col].fillna('').apply(
                lambda x: DEFAULT_LINK if str(x).strip() == '' else x
            )

    if 'publishedDate' in df.columns:
        def fix_date(val):
            if pd.isna(val) or str(val).strip() == '':
                return DEFAULT_DATE
            match = re.match(r'(\d{1,2})/(\d{1,2})/(\d{4})', str(val).strip())
            return match.group(3) if match else val
        df['publishedDate'] = df['publishedDate'].apply(fix_date)

    if 'ratingsCount' in df.columns:
        df['ratingsCount'] = df['ratingsCount'].fillna(DEFAULT_RATING)

    return df

def sample_every_3(filepath, output_path, drop_price=False, clean=False):
    df = pd.read_csv(filepath)
    
    if drop_price and 'Price' in df.columns:
        df = df.drop(columns=['Price'])
    
    if clean:
        df = clean_books_data(df)

    sampled = df.iloc[::3].head(10000)
    sampled.to_csv(output_path, index=False)
    print(f"Saved {len(sampled)} sampled rows to '{output_path}'")

# Apply transformations
sample_every_3(inputCSV1, outputCSV1, clean=True)
sample_every_3(inputCSV2, outputCSV2, drop_price=True)
