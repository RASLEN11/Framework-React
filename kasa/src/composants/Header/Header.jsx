import React from 'react';
import './Header.css';
import logo from '../../images/logo.png';

const Header = () => {
  return (
    <header>
      <div className="logo-container">
        <img src={logo} alt="Logo" className="logo-image" />
        <span className="logo-text">T E S T</span>
      </div>
      <nav>
        <ul>
          <li><a href="#home">Click</a></li>
          <li><a href="#about">Checkbox</a></li>
          <li><a href="#contact">Select</a></li>
          <li><a href="#contact">Color</a></li>
          <li><a href="#contact">Ajouter</a></li>
          <li><a href="#contact">Commentaire</a></li>
        </ul>
      </nav>
    </header>
  );
};

export default Header;
