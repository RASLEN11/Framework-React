import React from "react";
import { Link } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import { FaBullhorn, FaEye, FaUsers, FaHandHoldingHeart, FaDonate, } from "react-icons/fa";
import Header from "../components/Header";
import Footer from "../components/Footer";

const About = () => {
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
          <h1 className="display-4 fw-bold">About Us</h1>
          <p className="lead mb-4">
          Learn more about our mission, vision, and the people behind our
          cause.
          </p>
        </div>
      </section>

      {/* Mission, Vision, and Team Section */}
      <section className="py-5">
        <div className="container">
          <div className="row g-4">
            {/* Mission */}
            <div className="col-md-4">
              <div className="card shadow-lg border-0 rounded-3 h-100">
                <div className="card-body text-center">
                  <FaBullhorn className="mb-3" style={{ fontSize: "3rem" }} />
                  <h5 className="card-title mb-3">Our Mission</h5>
                  <p className="card-text">
                    At Food Donation, our mission is to reduce food waste while
                    helping those in need. We connect surplus food from
                    restaurants, stores, and individuals with hungry families,
                    ensuring no food goes to waste and no one goes hungry.
                  </p>
                </div>
              </div>
            </div>

            {/* Vision */}
            <div className="col-md-4">
              <div className="card shadow-lg border-0 rounded-3 h-100">
                <div className="card-body text-center">
                  <FaEye className="mb-3" style={{ fontSize: "3rem" }} />
                  <h5 className="card-title mb-3">Our Vision</h5>
                  <p className="card-text">
                    We envision a world where food insecurity is eradicated and
                    resources are used wisely to create sustainable communities.
                    Through collaboration and innovation, we strive to bring
                    hope and nourishment to everyone.
                  </p>
                </div>
              </div>
            </div>

            {/* Team */}
            <div className="col-md-4">
              <div className="card shadow-lg border-0 rounded-3 h-100">
                <div className="card-body text-center">
                  <FaUsers className="mb-3" style={{ fontSize: "3rem" }} />
                  <h5 className="card-title mb-3">Our Team</h5>
                  <p className="card-text">
                    We are a passionate group of volunteers, donors, and
                    partners dedicated to fighting hunger. Together, we’re
                    committed to building a compassionate community that
                    uplifts and supports everyone.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Call to Action Section */}
      <section className="text-center my-5 py-5 bg-dark text-white rounded-3 shadow-lg">
        <h2 className="mb-4">
          <FaHandHoldingHeart className="me-2" style={{ fontSize: "2rem" }} />
          Join Our Cause
        </h2>
        <p className="lead mb-4">
          Be a part of the solution. Whether you’re donating food, volunteering
          your time, or contributing financially, your support helps us make a
          difference.
        </p>
        <Link to="/donate" className="btn btn-lg btn-outline-light">
          <FaDonate className="me-2" /> Donate Now
        </Link>
      </section>

      {/* Testimonials Section */}
      <section className="my-5">
        <div className="container">
          <h2 className="text-center mb-4">What People Are Saying</h2>
          <div className="row">
            <div className="col-md-4">
              <div className="card shadow-sm border-0">
                <div className="card-body text-center">
                  <p className="card-text">
                    "The Food Donation team has changed lives in our community.
                    It's amazing how something as simple as food can make such a
                    big impact."
                  </p>
                  <p>
                    <strong>Jane Doe</strong> - Volunteer
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card shadow-sm border-0">
                <div className="card-body text-center">
                  <p className="card-text">
                    "Thanks to Food Donation, we’ve been able to help so many
                    families in need. The work they do is truly invaluable."
                  </p>
                  <p>
                    <strong>John Smith</strong> - Donor
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card shadow-sm border-0">
                <div className="card-body text-center">
                  <p className="card-text">
                    "Food Donation isn’t just about giving food; it’s about
                    giving hope to those who need it the most."
                  </p>
                  <p>
                    <strong>Emily Johnson</strong> - Beneficiary
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      {/* Footer */}
      <Footer />
    </>
  );
};

export default About;
