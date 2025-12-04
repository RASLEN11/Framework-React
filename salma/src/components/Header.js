import React from 'react';
import '../styles/components/Header.css';

const Header = () => {
  return (
    <header className="header">
      <div className="container">
        <h1 className="logo">Salma's Court</h1>
        <p className="tagline">Tennis • Porsche 911 • Cats</p>
      </div>
    </header>
  );
};

export default Header;