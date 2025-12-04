import React, { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import {
  faHome,
  faInfoCircle,
  faDonate,
  faEnvelope,
  faTachometerAlt,
  faUserPlus,
  faSignInAlt,
  faBars,
} from '@fortawesome/free-solid-svg-icons';
import logo from '../assets/logo.png';
import 'bootstrap/dist/css/bootstrap.min.css';

const Header = () => {
  const [isNavCollapsed, setIsNavCollapsed] = useState(true);
  const handleNavCollapse = () => setIsNavCollapsed(!isNavCollapsed);
  const location = useLocation();

  return (
    <header className="bg-dark text-white p-3">
      <div className="container">
        <div className="d-flex justify-content-between align-items-center">
          {/* Logo Section */}
          <Link to="/" className="text-decoration-none text-white">
            <div className="d-flex align-items-center">
              <img
                src={logo}
                alt="Food Donation Logo"
                className="logo-image"
                style={{ width: '65px', height: 'auto', marginRight: '20px' }}
              />
              <h1>Food Donation</h1>
            </div>
          </Link>

          {/* Hamburger Menu for Mobile */}
          <button
            className="navbar-toggler d-md-none"
            type="button"
            onClick={handleNavCollapse}
            aria-expanded={!isNavCollapsed}
            aria-label="Toggle navigation"
            style={{
              background: 'none',
              border: 'none',
              color: 'white',
              fontSize: '1.5rem',
            }}
          >
            <FontAwesomeIcon icon={faBars} />
          </button>

          {/* Navigation Links */}
          <nav className={`d-none d-md-block ${!isNavCollapsed ? 'mobile-nav' : ''}`}>
            <ul className="nav">
              {[
                { to: '/', icon: faHome, text: 'Home' },
                { to: '/about', icon: faInfoCircle, text: 'About Us' },
                { to: '/donate', icon: faDonate, text: 'Donate' },
                { to: '/contact', icon: faEnvelope, text: 'Contact' },
                { to: '/dashboard', icon: faTachometerAlt, text: 'Dashboard' },
              ].map(({ to, icon, text }) => (
                <li className="nav-item" key={to}>
                  <Link
                    to={to}
                    className={`nav-link text-white ${location.pathname === to ? 'active' : ''}`}
                    style={{
                      cursor: 'pointer',
                      transition: 'color 0.3s ease-in-out',
                    }}
                  >
                    <FontAwesomeIcon icon={icon} /> {text}
                  </Link>
                </li>
              ))}
            </ul>
          </nav>

          {/* Authentication Links */}
          <div className="auth-links d-none d-md-flex gap-2">
            <Link to="/register" className="btn btn-outline-light btn-hover-grow">
              <FontAwesomeIcon icon={faUserPlus} /> Register
            </Link>
            <Link to="/signin" className="btn btn-outline-light btn-hover-grow">
              <FontAwesomeIcon icon={faSignInAlt} /> Sign In
            </Link>
          </div>
        </div>

        {/* Collapsible Navigation for Mobile */}
        <div className={`d-md-none ${isNavCollapsed ? 'collapse' : ''}`}>
          <ul className="nav flex-column">
            {[
              { to: '/', icon: faHome, text: 'Home' },
              { to: '/about', icon: faInfoCircle, text: 'About Us' },
              { to: '/donate', icon: faDonate, text: 'Donate' },
              { to: '/contact', icon: faEnvelope, text: 'Contact' },
              { to: '/dashboard', icon: faTachometerAlt, text: 'Dashboard' },
              { to: '/register', icon: faUserPlus, text: 'Register' },
              { to: '/signin', icon: faSignInAlt, text: 'Sign In' },
            ].map(({ to, icon, text }) => (
              <li className="nav-item" key={to}>
                <Link
                  to={to}
                  className="nav-link text-white hover-bg-light"
                  onClick={handleNavCollapse}
                  style={{
                    cursor: 'pointer',
                    transition: 'color 0.3s ease-in-out',
                  }}
                >
                  <FontAwesomeIcon icon={icon} /> {text}
                </Link>
              </li>
            ))}
          </ul>
        </div>
      </div>

      {/* Custom CSS */}
      <style>
        {`
          .nav-link {
            color: white !important;
            padding: 10px 15px;
          }

          .nav-link:hover {
            color:rgb(51, 50, 55) !important; /* Jaune */
          }

          .nav-link.active {
            color:rgb(0, 0, 0) !important; /* Rouge */
            font-weight: bold;
          }

          .btn-hover-grow {
            transition: transform 0.2s ease-in-out;
          }

          .btn-hover-grow:hover {
            transform: scale(1.1);
          }
        `}
      </style>
    </header>
  );
};

export default Header;
