import React from "react";
import { Link } from "react-router-dom";
import Header from "../components/Header";
import Footer from "../components/Footer";
import "bootstrap/dist/css/bootstrap.min.css";

const Volunteer = () => {
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
          <h1 className="display-4 fw-bold">Join Our Volunteer Team</h1>
          <p className="lead mb-4">
          Make a meaningful impact in your community by donating your time
            and skills.
          </p>
          <Link to="#volunteer-form" className="btn btn-lg btn-light">
            Apply Now
          </Link>
        </div>
      </section>

      {/* Why Volunteer Section */}
      <section className="why-volunteer py-5">
        <div className="container text-center">
          <h2 className="mb-5">Why Volunteer with Us?</h2>
          <div className="row">
            <div className="col-md-4">
              <div className="card shadow-lg border-0">
                <div className="card-body">
                  <i className="fa fa-heart fa-4x mb-3"></i>
                  <h5 className="card-title">Make a Difference</h5>
                  <p className="card-text">
                    Help fight hunger and create a positive impact in the
                    lives of those in need.
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card shadow-lg border-0">
                <div className="card-body">
                  <i className="fa fa-handshake fa-4x mb-3"></i>
                  <h5 className="card-title">Build Connections</h5>
                  <p className="card-text">
                    Meet like-minded individuals and form meaningful
                    relationships.
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card shadow-lg border-0">
                <div className="card-body">
                  <i className="fa fa-leaf fa-4x mb-3"></i>
                  <h5 className="card-title">Grow Personally</h5>
                  <p className="card-text">
                    Enhance your skills, gain experience, and learn while
                    giving back.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Volunteer Form Section */}
      <section id="volunteer-form" className="volunteer-form py-5 bg-light">
        <div className="container">
          <h2 className="text-center mb-4">Apply to Become a Volunteer</h2>
          <form className="row g-3">
            <div className="col-md-6">
              <label htmlFor="firstName" className="form-label">
                First Name
              </label>
              <input
                type="text"
                className="form-control"
                id="firstName"
                placeholder="Enter your first name"
                required
              />
            </div>
            <div className="col-md-6">
              <label htmlFor="lastName" className="form-label">
                Last Name
              </label>
              <input
                type="text"
                className="form-control"
                id="lastName"
                placeholder="Enter your last name"
                required
              />
            </div>
            <div className="col-md-6">
              <label htmlFor="email" className="form-label">
                Email Address
              </label>
              <input
                type="email"
                className="form-control"
                id="email"
                placeholder="Enter your email"
                required
              />
            </div>
            <div className="col-md-6">
              <label htmlFor="phone" className="form-label">
                Phone Number
              </label>
              <input
                type="tel"
                className="form-control"
                id="phone"
                placeholder="Enter your phone number"
                required
              />
            </div>
            <div className="col-12">
              <label htmlFor="availability" className="form-label">
                Availability
              </label>
              <textarea
                className="form-control"
                id="availability"
                rows="3"
                placeholder="Let us know when you're available to volunteer"
                required
              ></textarea>
            </div>
            <div className="col-12 text-center">
              <button type="submit" className="btn btn-lg btn-dark">
                Submit Application
              </button>
            </div>
          </form>
        </div>
      </section>

      {/* Call to Action */}
      <section className="cta py-5 text-center bg-dark text-white">
        <div className="container">
          <h2 className="mb-4">Every Helping Hand Counts</h2>
          <p className="lead">
            Your time and effort can make a big difference. Join our team of
            dedicated volunteers and help us create a better future for
            everyone.
          </p>
          <Link to="/donate" className="btn btn-lg btn-light me-3">
            Donate Food
          </Link>
          <Link to="/about" className="btn btn-lg btn-light">
            Learn More
          </Link>
        </div>
      </section>
      
      {/* Footer */}
      <Footer />
    </>
  );
};

export default Volunteer;
