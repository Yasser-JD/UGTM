import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path)
    
    # Get header (columns)
    headers = df.columns.tolist()
    
    # Get a sample row (e.g., index 19 which corresponds to row 21 in Excel usually)
    # We use iloc[19] because we want a row with data, and we saw row 19 had data before
    sample_row = df.iloc[19].tolist()
    
    print(f"{'Index':<5} | {'Header':<30} | {'Sample Data':<30}")
    print("-" * 70)
    for i, (h, d) in enumerate(zip(headers, sample_row)):
        print(f"{i:<5} | {str(h):<30} | {str(d):<30}")
        
except Exception as e:
    print(f"Error reading file: {e}")
