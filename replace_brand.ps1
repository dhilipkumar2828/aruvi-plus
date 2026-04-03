$oldPhrases = @(
    "Bogar Siddha Peedam - Bogar Alchemist LLP",
    "Bogar Siddha Peedam",
    "Bogar Alchemist LLP",
    "Siddhar Bogar",
    "Siddha Bogar",
    "Bogar Siddha",
    "Bogar",
    "Siddha",
    "Peedam"
)

$targetRoot = "c:\xampp\htdocs\aruvi-new-website"
$targetDirs = @("app", "resources", "routes", "database", "config", "public")
$includeExtensions = @("*.php", "*.blade.php", "*.css", "*.js", "*.html", "*.txt")

foreach ($dir in $targetDirs) {
    $fullDir = Join-Path $targetRoot $dir
    if (-not (Test-Path $fullDir)) { continue }
    
    foreach ($ext in $includeExtensions) {
        $files = Get-ChildItem -Path $fullDir -Filter $ext -Recurse -File
        foreach ($file in $files) {
            # Skip large compiled files in public
            if ($file.FullName -like "*\public\*.min.js" -or $file.FullName -like "*\public\*.min.css") { continue }
            
            $content = Get-Content -Path $file.FullName -Raw
            if ($null -eq $content -or $content -eq "") { continue }
            
            $originalContent = $content
            
            foreach ($old in $oldPhrases) {
                # Case insensitive replace but use "Auvri Plus"
                $content = $content -ireplace [regex]::Escape($old), "Auvri Plus"
            }
            
            if ($content -ne $originalContent) {
                Set-Content -Path $file.FullName -Value $content -NoNewline
                Write-Host "Updated $($file.FullName)"
            }
        }
    }
}
