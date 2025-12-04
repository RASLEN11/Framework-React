import React from 'react';
import { Link } from 'react-router-dom';
import Header from '../components/Header';
import Footer from '../components/Footer';  
import 'bootstrap/dist/css/bootstrap.min.css';

const Involved = () => {
  return (
    <>
      {/* Header */}
      <Header />

      {/* Hero Section */}
      <section
        className="hero bg-dark text-white text-center py-5"
        style={{
          backgroundSize: 'cover',
          backgroundPosition: 'center',
          height: '60vh',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
        }}
      >
        <div className="container">
          <h1 className="display-4 fw-bold">Get Involved</h1>
          <p className="lead mb-4">
            Discover ways to support our mission and make a lasting impact in the fight against hunger.
          </p>
        </div>
      </section>

      {/* Ways to Get Involved */}
      <section className="ways-to-help py-5">
        <div className="container text-center">
          <h2 className="mb-5">How You Can Help</h2>
          <div className="row">
            <div className="col-md-4">
              <div className="card border-0 shadow mb-4">
                <div className="card-body">
                  <h5 className="card-title">Donate Food</h5>
                  <p className="card-text">
                    Share your surplus food with those who need it most and reduce food waste.
                  </p>
                  <Link to="/donate" className="btn btn-dark">
                    Learn More
                  </Link>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card border-0 shadow mb-4">
                <div className="card-body">
                  <h5 className="card-title">Volunteer</h5>
                  <p className="card-text">
                    Join our team of dedicated volunteers and help us distribute food to families in need.
                  </p>
                  <Link to="/volunteer" className="btn btn-dark">
                    Get Started
                  </Link>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card border-0 shadow mb-4">
                <div className="card-body">
                  <h5 className="card-title">Fundraise</h5>
                  <p className="card-text">
                    Organize a fundraiser or event to support our programs and initiatives.
                  </p>
                  <Link to="/fundraise" className="btn btn-dark">
                    Find Out How
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Call to Action */}
      <section className="cta py-5 bg-dark text-white text-center">
        <div className="container">
          <h2 className="mb-4">Ready to Join Us?</h2>
          <p className="lead mb-4">
            Together, we can make a significant impact. Start your journey today.
          </p>
          <Link to="/contact" className="btn btn-lg btn-light me-3">
            Contact Us
          </Link>
          <Link to="/donate" className="btn btn-lg btn-outline-light">
            Donate Now
          </Link>
        </div>
      </section>
      {/* Footer */}
      <Footer />
    </>
  );
};

export default Involved;
