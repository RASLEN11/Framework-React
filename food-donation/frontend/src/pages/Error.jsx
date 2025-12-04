import React, { useEffect } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';

const Error = () => { 
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
    <div className="d-flex flex-column justify-content-center align-items-center vh-100 bg-dark text-white p-4">
      <div className="text-center">
        <h1 className="display-3 fw-bold text-danger mb-3 animate__animated animate__fadeInUp">
          Oops! Something went wrong.
        </h1>
        <p className="lead mb-4 animate__animated animate__fadeInUp animate__delay-1s">
          The page you're looking for doesn't exist or there was an issue. Please go back to the homepage.
        </p>
        <Link to="/" className="btn btn-lg btn-primary shadow-lg rounded-pill animate__animated animate__fadeInUp animate__delay-2s">
          Go to Home
        </Link>
      </div>
      <div className="mt-5">
        <i className="fas fa-exclamation-triangle fa-5x text-warning animate__animated animate__bounceIn"></i>
      </div>
    </div>
  );
};

export default Error;
