import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path)
    print("Columns found:", df.columns.tolist())
    
    # Access by index to avoid name matching issues
    # Assuming 'مقر العمل' is index 4 and 'الجماعة' is index 5 based on previous output
    workplace_col = df.columns[4]
    commune_col = df.columns[5]
    
    print(f"Column 4 (Workplace): {workplace_col}")
    print(f"Column 5 (Commune): {commune_col}")
    
    print("\nFirst 20 rows:")
    print(df.iloc[:20, [4, 5]].to_string())
    
except Exception as e:
    print(f"Error reading file: {e}")
