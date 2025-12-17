import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path)
    
    # Assuming columns by index 4 and 5
    workplaces = df.iloc[:, 4].unique()
    communes = df.iloc[:, 5].unique()
    
    print("Unique Workplaces (First 10):")
    for w in workplaces[:10]:
        print(f"- {w}")
        
    print("\nUnique Communes (First 10):")
    for c in communes[:10]:
        print(f"- {c}")
        
except Exception as e:
    print(f"Error reading file: {e}")
