import React from 'react';
import { Link } from 'react-router-dom';
import { FaUtensils, FaDollarSign, FaPeopleCarry } from 'react-icons/fa';
import 'bootstrap/dist/css/bootstrap.min.css';
import Header from '../components/Header';
import Footer from '../components/Footer';

const Home = () => {
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
          height: '80vh',
          display: 'flex',
          alignItems: 'center',
        }}
      >
        <div className="container">
          <h1 className="display-4 fw-bold">Together, We Can End Hunger</h1>
          <p className="lead mb-4">
            Empower communities and reduce food waste by donating surplus food and resources.
          </p>
          <Link to="/donate" className="btn btn-lg btn-outline-light me-2">
            Donate Now
          </Link>
          <Link to="/volunteer" className="btn btn-lg btn-outline-light">
            Become a Volunteer
          </Link>
        </div>
      </section>

      {/* Features Section */}
      <section className="features py-5 bg-light">
        <div className="container text-center">
          <h2 className="mb-5">How You Can Help</h2>
          <div className="row">
            <div className="col-md-4">
              <div className="card border-0 shadow mb-4">
                <div className="card-body">
                  <FaUtensils className="fa-4x mb-3" />
                  <h5 className="card-title">Donate Food</h5>
                  <p className="card-text">
                    Share surplus food with those in need and reduce food waste.
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card border-0 shadow mb-4">
                <div className="card-body">
                  <FaDollarSign className="fa-4x mb-3" />
                  <h5 className="card-title">Support Financially</h5>
                  <p className="card-text">
                    Your monetary contributions help us reach more families in need.
                  </p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card border-0 shadow mb-4">
                <div className="card-body">
                  <FaPeopleCarry className="fa-4x mb-3" />
                  <h5 className="card-title">Volunteer</h5>
                  <p className="card-text">
                    Join our team of volunteers and be a part of the solution.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Testimonials Section */}
      <section className="testimonials py-5">
        <div className="container text-center">
          <h2 className="mb-5">What People Are Saying</h2>
          <div className="row">
            <div className="col-md-4">
              <div className="card shadow-sm border-0">
                <div className="card-body">
                  <p className="card-text">
                    "Food Donation has made a huge difference in our community. Their efforts are incredible."
                  </p>
                  <p><strong>- Jane Doe, Volunteer</strong></p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card shadow-sm border-0">
                <div className="card-body">
                  <p className="card-text">
                    "Thanks to their donations, we’ve been able to feed so many families. Truly life-changing!"
                  </p>
                  <p><strong>- John Smith, Recipient</strong></p>
                </div>
              </div>
            </div>
            <div className="col-md-4">
              <div className="card shadow-sm border-0">
                <div className="card-body">
                  <p className="card-text">
                    "I’ve never seen an organization work so hard to reduce food waste. Amazing team!"
                  </p>
                  <p><strong>- Emily Johnson, Donor</strong></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Call to Action Section */}
      <section className="cta py-5 bg-dark text-white text-center">
        <div className="container">
          <h2 className="mb-4">Ready to Make a Difference?</h2>
          <p className="lead mb-4">
            Whether you’re an individual, a business, or a community group, there’s a place for you in our mission.
          </p>
          <Link to="/involved" className="btn btn-lg btn-light me-3">
            Get Involved
          </Link>
          <Link to="/contact" className="btn btn-lg btn-outline-light">
            Contact Us
          </Link>
        </div>
      </section>
      <Footer />
    </>
  );
};

export default Home;
