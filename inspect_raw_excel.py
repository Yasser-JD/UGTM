import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path, header=None) # Read without header to see everything
    print("First 20 rows raw data:")
    for i, row in df.head(20).iterrows():
        print(f"Row {i}: {row.tolist()}")
except Exception as e:
    print(f"Error reading file: {e}")
