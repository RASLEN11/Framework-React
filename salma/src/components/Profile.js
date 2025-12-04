import React from 'react';
import '../styles/components/Profile.css';

const Profile = ({ profile }) => {
  const socialIcons = [
    { platform: 'Instagram', icon: 'fab fa-instagram', color: '#E4405F', url: 'https://instagram.com/salma.bargawi' },
    { platform: 'TikTok', icon: 'fab fa-tiktok', color: '#000000', url: 'https://tiktok.com/@salma____bargawi' },
    { platform: 'Facebook', icon: 'fab fa-facebook-f', color: '#1877F2', url: 'https://facebook.com/salma.bargawi.2025' }
  ];

  const handleSocialClick = (url) => {
    window.open(url, '_blank', 'noopener noreferrer');
  };

  return (
    <section className="profile-section">
      <div className="container">
        <div className="profile-card">
          <div className="avatar-container">
            <img 
              src={profile.avatar} 
              alt={profile.name}
              className="profile-avatar"
            />
            <div className="tennis-racket"></div>
            <div className="cat-emoji">🐱</div>
          </div>
          <h1 className="profile-name">{profile.name}</h1>
          <p className="profile-username">{profile.username}</p>
          <p className="profile-bio">{profile.bio}</p>
          
          {/* Porsche 911 Section */}
          <div className="porsche-section">
            <div className="porsche-info">
              <i className="fas fa-car"></i>
              <div className="porsche-details">
                <span className="porsche-model">Porsche 911 Turbo</span>
                <span className="porsche-spec">Dream Car • 572 HP</span>
              </div>
            </div>
          </div>

          {/* Move music Section */}
          <div className="music-section">
            <div className="playlist-info">
              <div className="music-track">
                <span className="track-name">Move</span>
                <span className="track-artist">Adam Port, Stryv</span>
              </div>
            </div>
          </div>
          
          <div className="social-icons-container">
            <div className="social-icons-grid">
              {socialIcons.map((social, index) => (
                <button
                  key={index}
                  className="social-icon-circle"
                  onClick={() => handleSocialClick(social.url)}
                  style={{ '--social-color': social.color }}
                  aria-label={`Follow on ${social.platform}`}
                >
                  <i className={social.icon}></i>
                </button>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default Profile;