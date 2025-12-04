import React from 'react';
import '../styles/components/SocialLinks.css';

const SocialLinks = ({ links }) => {
  const handleLinkClick = (url) => {
    window.open(url, '_blank', 'noopener noreferrer');
  };

  // Function to get the appropriate FontAwesome icon for each platform
  const getPlatformIcon = (platform) => {
    switch (platform.toLowerCase()) {
      case 'instagram':
        return 'fab fa-instagram';
      case 'tiktok':
        return 'fab fa-tiktok';
      case 'facebook':
        return 'fab fa-facebook-f';
      case 'twitter':
        return 'fab fa-twitter';
      case 'youtube':
        return 'fab fa-youtube';
      case 'spotify':
        return 'fab fa-spotify';
      case 'pinterest':
        return 'fab fa-pinterest';
      case 'vsco':
        return 'fas fa-camera';
      case 'bereal':
        return 'fas fa-camera-retro';
      case 'tennis league':
        return 'fas fa-trophy';
      case 'training blog':
        return 'fas fa-blog';
      default:
        return 'fas fa-link';
    }
  };

  return (
    <section className="links-section">
      <div className="container">
        <div className="links-grid">
          {links.map(link => (
            <button
              key={link.id}
              className="link-card"
              onClick={() => handleLinkClick(link.url)}
              style={{ '--accent-color': link.color }}
            >
              <span className="link-icon">
                <i className={getPlatformIcon(link.platform)}></i>
              </span>
              <div className="link-content">
                <h3 className="link-platform">{link.platform}</h3>
                <p className="link-username">{link.username}</p>
              </div>
              <span className="link-arrow">→</span>
            </button>
          ))}
        </div>
      </div>
    </section>
  );
};

export default SocialLinks;