import pandas as pd

file_path = 'تقييم المكتسبات - العرائش -08-10-2025.xlsx'
try:
    df = pd.read_excel(file_path)
    
    # Filter out rows where School Name (Index 5) is NaN
    df = df.dropna(subset=[df.columns[5]])
    
    with open('database/seeders/SchoolImportSeeder.php', 'w', encoding='utf-8') as f:
        f.write("<?php\n")
        f.write("namespace Database\Seeders;\n")
        f.write("use Illuminate\Database\Seeder;\n")
        f.write("use App\Models\School;\n")
        f.write("use Illuminate\Support\Facades\DB;\n")
        f.write("class SchoolImportSeeder extends Seeder\n")
        f.write("{\n")
        f.write("    public function run(): void\n")
        f.write("    {\n")
        f.write("        DB::disableQueryLog();\n")
        f.write("        $schools = [\n")
        
        unique_schools = set()
        
        for i, row in df.iterrows():
            # Index 3: Commune
            # Index 4: Code
            # Index 5: Name
            commune = str(row.iloc[3]).strip()
            code = str(row.iloc[4]).strip()
            name = str(row.iloc[5]).strip()
            
            # Skip header rows or invalid data
            if name == 'nan' or name == 'المؤسسة' or commune == 'nan':
                continue
                
            # Create a unique key to avoid duplicates
            key = (name, commune)
            if key in unique_schools:
                continue
            unique_schools.add(key)
            
            # Escape single quotes
            name = name.replace("'", "\\'")
            commune = commune.replace("'", "\\'")
            code = code.replace("'", "\\'") if code != 'nan' else ''
            
            f.write(f"            ['name' => '{name}', 'code' => '{code}', 'commune' => '{commune}', 'province' => 'العرائش'],\n")
            
        f.write("        ];\n")
        f.write("        foreach (array_chunk($schools, 1000) as $chunk) {\n")
        f.write("            School::insert($chunk);\n")
        f.write("        }\n")
        f.write("    }\n")
        f.write("}\n")
    
    print("Seeder generated successfully.")
    
except Exception as e:
    print(f"Error: {e}")
