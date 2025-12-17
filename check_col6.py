import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path)
    
    # Check Column 6 (Index 6)
    col6_values = df.iloc[:, 6].unique()
    
    print("Unique Values in Column 6 (First 20):")
    for v in col6_values[:20]:
        print(f"- {v}")
        
except Exception as e:
    print(f"Error reading file: {e}")
