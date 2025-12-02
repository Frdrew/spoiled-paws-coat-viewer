# Build ZIP for WordPress Plugin
$PluginName = "spoiled-paws-coat-viewer"
$Output = "$PluginName.zip"

if (Test-Path $Output) {
    Remove-Item $Output
}

Compress-Archive -Path * -DestinationPath $Output -Force

Write-Host "Plugin packaged: $Output"
