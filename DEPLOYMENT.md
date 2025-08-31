# Deployment Guide for Music Suno

## Prerequisites

Before deploying, ensure you have:
- A GitHub account
- A Vercel account
- A cloud database (PlanetScale, Railway, or similar)

## Step-by-Step Deployment Process

### 1. Prepare Your Database

#### Option A: PlanetScale (Recommended)
1. Go to [PlanetScale](https://planetscale.com/) and create an account
2. Create a new database
3. Use the schema from `database/schema.sql` to set up your tables
4. Get your connection credentials

#### Option B: Railway
1. Go to [Railway](https://railway.app/) and create an account
2. Create a MySQL database
3. Import the schema from `database/schema.sql`
4. Get your connection credentials

### 2. Set Up GitHub Repository

1. **Initialize Git** (if not already done):
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   ```

2. **Add remote origin**:
   ```bash
   git remote add origin https://github.com/b240997-beep/Music-Suno.git
   git branch -M main
   git push -u origin main
   ```

### 3. Deploy to Vercel

1. **Connect to Vercel**:
   - Go to [Vercel](https://vercel.com/)
   - Sign up/in with your GitHub account
   - Click "New Project"
   - Import your GitHub repository

2. **Configure Environment Variables**:
   In your Vercel project settings, add these environment variables:
   - `DB_HOST`: Your database host
   - `DB_USER`: Your database username
   - `DB_PASS`: Your database password
   - `DB_NAME`: Your database name

3. **Deploy**:
   - Click "Deploy"
   - Wait for the build to complete
   - Your app will be live at `https://your-project-name.vercel.app`

### 4. Post-Deployment Setup

1. **Test the application**:
   - Visit your deployed URL
   - Test user registration/login
   - Test file uploads (may need additional configuration)

2. **Configure file uploads for production**:
   - For production, consider using cloud storage (AWS S3, Cloudinary)
   - Update file upload paths in your PHP code accordingly

### 5. Custom Domain (Optional)

1. In Vercel dashboard, go to your project settings
2. Navigate to "Domains"
3. Add your custom domain
4. Update your DNS settings as instructed

## Environment Variables Reference

| Variable | Description | Example |
|----------|-------------|---------|
| `DB_HOST` | Database hostname | `aws.connect.psdb.cloud` |
| `DB_USER` | Database username | `your_username` |
| `DB_PASS` | Database password | `your_password` |
| `DB_NAME` | Database name | `music` |

## Troubleshooting

### Common Issues:

1. **Database Connection Failed**:
   - Check environment variables are set correctly
   - Verify database credentials
   - Ensure database is accessible from Vercel

2. **File Upload Issues**:
   - Check file permissions
   - Consider implementing cloud storage for production

3. **CSS/JS Not Loading**:
   - Verify file paths are correct
   - Check Vercel routing configuration

### Getting Help:
- Check Vercel deployment logs
- Review PHP error logs
- Open an issue on GitHub if you encounter problems

## Security Checklist

- [ ] Environment variables are properly set
- [ ] Database credentials are not hardcoded
- [ ] File upload validation is in place
- [ ] SQL injection protection is implemented
- [ ] HTTPS is enabled (automatic with Vercel)

## Performance Optimization

- Enable Vercel's Edge Network
- Optimize images and audio files
- Implement caching where appropriate
- Consider using a CDN for media files
