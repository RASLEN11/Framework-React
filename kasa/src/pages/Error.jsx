import React, { useEffect } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import logo from '../assets/logo-kasa.png';
import '../styles/Error.css';

function Error() {
  const navigate = useNavigate();

  useEffect(() => {
    document.title = "Dommage, la page n'existe pas !";


    const existingCanonicalLink = document.querySelector('link[rel="canonical"]');
    if (existingCanonicalLink) {
      document.head.removeChild(existingCanonicalLink);
    }

    const timer = setTimeout(() => {
      navigate('/');
    }, 3000);

    return () => clearTimeout(timer);
  }, [navigate]);

  return (
    <>
      <header className="header">
        <Link to="/"><img src={logo} alt="logo kasa" /></Link>
        <div>
          <Link to="/">Accueil</Link>
          <Link to="/A propos">À propos</Link>
        </div>
      </header>

      <div className="error404">
        <h1>404</h1>
        <p>Oups! La page que vous demandez n'existe pas.</p>
        <Link to="/">Retourner sur la page d’accueil</Link>
      </div>
    </>
  );
}

export default Error;
