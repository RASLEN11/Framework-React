import React from 'react';
import '../styles/components/Footer.css';

const Footer = () => {
  const handleRaslenClick = () => {
    window.open('https://www.instagram.com/raslen.11/', '_blank', 'noopener noreferrer');
  };

  return (
    <footer className="footer">
      <div className="container">
        <p className="footer-text">
          Made with 💚 by{' '}
          <strong 
            onClick={handleRaslenClick}
            style={{
              cursor: 'pointer',
              textDecoration: 'underline',
              transition: 'color 0.3s ease'
            }}
            onMouseEnter={(e) => e.target.style.color = '#4ECDC4'}
            onMouseLeave={(e) => e.target.style.color = 'inherit'}
          >
            RASLEN11
          </strong>{' '}
          • © 2024 Salma Bargawi
        </p>
      </div>
    </footer>
  );
};

export default Footer;