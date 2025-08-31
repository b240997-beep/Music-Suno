# Music Suno 🎵

A modern music streaming and playlist management web application built with PHP and MySQL.

## Features

- 🎵 Stream music online
- 📝 Create and manage playlists
- 👤 User authentication (login/register)
- 📱 Responsive design
- 🎨 Modern UI with FontAwesome icons
- 📤 Upload songs and cover images
- 🎯 Browse trending/recent songs

## Demo

Visit the live demo: [Music Suno](https://your-vercel-app.vercel.app)

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Icons**: FontAwesome
- **Deployment**: Vercel

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx) or XAMPP for local development

### Local Development Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/b240997-beep/Music-Suno.git
   cd Music-Suno
   ```

2. **Set up the database**
   - Create a MySQL database named `music`
   - Import the database schema (you'll need to create the SQL file)
   - Update database credentials in `config/config.php` if needed

3. **Configure file permissions**
   ```bash
   chmod 755 uploads/
   chmod 755 uploads/audio/
   chmod 755 uploads/images/
   ```

4. **Start your local server**
   - If using XAMPP: Place files in `htdocs/MusicSuno/`
   - If using PHP built-in server: `php -S localhost:8000`

5. **Access the application**
   - Open `http://localhost/MusicSuno/` or `http://localhost:8000`

### Database Schema

The application requires the following database tables:

- `users` - User authentication data
- `songs` - Song metadata and file paths
- `playlists` - User playlists
- `playlist_songs` - Many-to-many relationship between playlists and songs

## Deployment on Vercel

### Step 1: Prepare for Deployment

1. **Set up environment variables in Vercel:**
   - `DB_HOST` - Your database host
   - `DB_USER` - Database username
   - `DB_PASS` - Database password  
   - `DB_NAME` - Database name

### Step 2: Deploy

1. **Connect to Vercel:**
   - Fork this repository
   - Connect your GitHub account to Vercel
   - Import this project in Vercel dashboard

2. **Configure build settings:**
   - Framework Preset: Other
   - Root Directory: ./
   - Build Command: (leave empty)
   - Output Directory: (leave empty)

3. **Add environment variables:**
   - Go to your project settings in Vercel
   - Add the database environment variables

### Step 3: Database Setup for Production

For production deployment, you'll need a cloud database service:

- **PlanetScale** (MySQL-compatible)
- **Railway** (supports MySQL)
- **Amazon RDS**
- **DigitalOcean Managed Databases**

## Project Structure

```
Music-Suno/
├── config/
│   ├── config.php          # Database configuration
│   └── config.example.php  # Example configuration
├── css/                    # Stylesheets
├── include/
│   ├── header.php         # Common header
│   └── footer.php         # Common footer
├── php/                   # PHP processing scripts
├── uploads/
│   ├── audio/            # Uploaded audio files
│   └── images/           # Uploaded cover images
├── *.php                 # Main application pages
├── vercel.json           # Vercel configuration
└── README.md
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Security Considerations

- All user inputs are sanitized using `htmlspecialchars()`
- Database queries use proper escaping
- File uploads are restricted to specific types
- Session management is implemented for user authentication

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

If you encounter any issues or have questions, please open an issue on GitHub.

## Roadmap

- [ ] Add song search functionality
- [ ] Implement song favorites
- [ ] Add user profiles
- [ ] Mobile app development
- [ ] Social sharing features
- [ ] Advanced playlist management

---

Made with ❤️ by [b240997-beep](https://github.com/b240997-beep)
