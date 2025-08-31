# Music Suno - GitHub Setup Script (PowerShell)
Write-Host "Music Suno - GitHub Setup Script" -ForegroundColor Green
Write-Host "==================================" -ForegroundColor Green
Write-Host ""

# Check if Git is installed
try {
    $gitVersion = git --version
    Write-Host "Git is installed: $gitVersion" -ForegroundColor Green
    Write-Host ""
    
    # Initialize repository
    Write-Host "Initializing Git repository..." -ForegroundColor Yellow
    git init
    
    # Add all files
    Write-Host "Adding all files..." -ForegroundColor Yellow
    git add .
    
    # Create initial commit
    Write-Host "Creating initial commit..." -ForegroundColor Yellow
    git commit -m "Initial commit - Music Suno web application"
    
    # Add remote origin
    Write-Host "Adding remote origin..." -ForegroundColor Yellow
    git remote add origin https://github.com/b240997-beep/Music-Suno.git
    
    # Set main branch and push
    Write-Host "Setting main branch and pushing..." -ForegroundColor Yellow
    git branch -M main
    git push -u origin main
    
    Write-Host ""
    Write-Host "Successfully pushed to GitHub!" -ForegroundColor Green
    Write-Host "Repository: https://github.com/b240997-beep/Music-Suno" -ForegroundColor Cyan
    
} catch {
    Write-Host "Git is not installed or not in PATH." -ForegroundColor Red
    Write-Host "Please install Git from: https://git-scm.com/download/win" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "After installing Git, run this script again or execute these commands manually:" -ForegroundColor Yellow
    Write-Host "1. git init" -ForegroundColor Cyan
    Write-Host "2. git add ." -ForegroundColor Cyan
    Write-Host "3. git commit -m `"Initial commit - Music Suno web application`"" -ForegroundColor Cyan
    Write-Host "4. git remote add origin https://github.com/b240997-beep/Music-Suno.git" -ForegroundColor Cyan
    Write-Host "5. git branch -M main" -ForegroundColor Cyan
    Write-Host "6. git push -u origin main" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "Next steps for Vercel deployment:" -ForegroundColor Magenta
Write-Host "1. Go to https://vercel.com/" -ForegroundColor White
Write-Host "2. Sign in with GitHub" -ForegroundColor White
Write-Host "3. Import your Music-Suno repository" -ForegroundColor White
Write-Host "4. Set up environment variables (DB_HOST, DB_USER, DB_PASS, DB_NAME)" -ForegroundColor White
Write-Host "5. Deploy!" -ForegroundColor White

Read-Host "Press Enter to exit"
