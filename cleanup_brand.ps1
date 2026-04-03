$targetRoot = "c:\xampp\htdocs\aruvi-new-website"
$targetDirs = @("app", "resources", "routes", "database", "config", "public")
$includeExtensions = @("*.php", "*.blade.php", "*.css", "*.js", "*.html", "*.txt")

foreach ($dir in $targetDirs) {
    $fullDir = Join-Path $targetRoot $dir
    if (-not (Test-Path $fullDir)) { continue }
    
    foreach ($ext in $includeExtensions) {
        $files = Get-ChildItem -Path $fullDir -Filter $ext -Recurse -File
        foreach ($file in $files) {
            $content = Get-Content -Path $file.FullName -Raw
            if ($null -eq $content -or $content -eq "") { continue }
            
            $originalContent = $content
            
            # Reduce multiple "Auvri Plus" to single one
            $content = $content -replace "(?i)(Auvri Plus(\s*Auvri Plus)+)", "Auvri Plus"
            
            if ($content -ne $originalContent) {
                Set-Content -Path $file.FullName -Value $content -NoNewline
                Write-Host "Cleaned up $($file.FullName)"
            }
        }
    }
}
