import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path)
    row = df.iloc[19].tolist()
    
    print("Row 19 Values:")
    for i, val in enumerate(row):
        print(f"Index {i}: {val}")
        if i > 15: break
        
except Exception as e:
    print(f"Error reading file: {e}")
