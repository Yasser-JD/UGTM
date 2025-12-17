import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path)
    print(df[['مقر العمل', 'الجماعة']].head(20).to_string())
except Exception as e:
    print(f"Error reading file: {e}")
