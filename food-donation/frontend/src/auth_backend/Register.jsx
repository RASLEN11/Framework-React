import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faUser, faLock, faPhoneAlt } from "@fortawesome/free-solid-svg-icons";
import { faGoogle, faFacebook } from "@fortawesome/free-brands-svg-icons";
import "bootstrap/dist/css/bootstrap.min.css";
import Header from "../components/Header";
import Footer from "../components/Footer";
import { useNavigate } from "react-router-dom";
import axios from "axios";

function Register(){
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    confirmPassword: "",
    cin: "",
    telephone: "",
    role: "provider",
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const navigate = useNavigate();

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = (event) => {
  event.preventDefault();

  // Basic validations
  if (!formData.name.trim()) {
    setError("Please enter your full name.");
    return;
  }

  if (!formData.email.trim()) {
    setError("Please enter your email address.");
    return;
  }

  if (!formData.password) {
    setError("Please enter your password.");
    return;
  }

  if (formData.password.length < 6) {
    setError("Password should be at least 6 characters long.");
    return;
  }

  if (!formData.confirmPassword) {
    setError("Please confirm your password.");
    return;
  }

  if (formData.password !== formData.confirmPassword) {
    setError("Passwords do not match.");
    return;
  }

  if (!formData.cin.trim()) {
    setError("Please enter your CIN.");
    return;
  }

  if (!/^\d{8}$/.test(formData.cin)) {
    setError("CIN must be 8 digits.");
    return;
  }

  if (!formData.telephone.trim()) {
    setError("Please enter your phone number.");
    return;
  }

  if (!/^\d{8,15}$/.test(formData.telephone)) {
    setError("Phone number must be between 8 and 15 digits.");
    return;
  }

  setError(""); // Clear any existing errors
  setLoading(true);

  const confirmCreate = window.confirm("Are You Sure You Want To Create This Account ?");
  if (!confirmCreate) {
    setLoading(false);
    return;
  }

  const payload = {
    name: formData.name,
    email: formData.email,
    password: formData.password,
    role: formData.role,
    address: formData.cin, // mapping CIN to 'address' column as per your backend
    phone: formData.telephone
  };

  axios
    .post("http://localhost:5000/register", payload)
    .then((res) => {
      if (res.status === 201) {
        alert("Account Created Successfully!");
        setTimeout(() => {
          navigate("/signin");
        }, 1000);
      }
    })
    .catch((err) => {
      if (err.response && err.response.data && err.response.data.message) {
        setError(err.response.data.message);
      } else {
        alert("Something went wrong. Please try again.");
      }
    })
    .finally(() => {
      setLoading(false);
    });
};

  return (
    <>
      <Header />

      <section
        className="hero bg-dark text-white text-center py-5"
        style={{
          backgroundSize: 'cover',
          backgroundPosition: 'center',
          height: '32vh',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
        }}
      >
        <div className="container">
          <h1 className="display-4 fw-bold">Register Now</h1>
          <p className="lead mb-4">
            Join us today! Please fill in the details to create an account.
          </p>
        </div>
      </section>

      <div className="container mt-5">
        <div
          className="register-container mx-auto p-4 shadow-lg rounded bg-white"
          style={{ maxWidth: "500px" }}
        >
          <form onSubmit={handleSubmit}>
            <div className="row mb-3">
              <div className="col-md-6">
                <label htmlFor="cin" className="form-label">
                  <FontAwesomeIcon icon={faUser} className="me-2" />
                  CIN
                </label>
                <input
                  type="text"
                  id="cin"
                  name="cin"
                  value={formData.cin}
                  onChange={handleChange}
                  className="form-control form-control-lg"
                  placeholder="Enter your CIN"
                  required
                />
              </div>
              <div className="col-md-6">
                <label htmlFor="name" className="form-label">
                  <FontAwesomeIcon icon={faUser} className="me-2" />
                  Full Name
                </label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  className="form-control form-control-lg"
                  placeholder="Enter your full name"
                  required
                />
              </div>
            </div>

            <div className="row mb-3">
              <div className="col-md-6">
                <label htmlFor="email" className="form-label">
                  <FontAwesomeIcon icon={faUser} className="me-2" />
                  Email
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  value={formData.email}
                  onChange={handleChange}
                  className="form-control form-control-lg"
                  placeholder="Enter your email"
                  required
                />
              </div>
              <div className="col-md-6">
                <label htmlFor="telephone" className="form-label">
                  <FontAwesomeIcon icon={faPhoneAlt} className="me-2" />
                  Telephone
                </label>
                <input
                  type="tel"
                  id="telephone"
                  name="telephone"
                  value={formData.telephone}
                  onChange={handleChange}
                  className="form-control form-control-lg"
                  placeholder="Enter your telephone number"
                  required
                />
              </div>
            </div>

            <div className="row mb-3">
              <div className="col-md-6">
                <label htmlFor="password" className="form-label">
                  <FontAwesomeIcon icon={faLock} className="me-2" />
                  Password
                </label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  value={formData.password}
                  onChange={handleChange}
                  className="form-control form-control-lg"
                  placeholder="Enter your password"
                  required
                />
              </div>
              <div className="col-md-6">
                <label htmlFor="confirmPassword" className="form-label">
                  <FontAwesomeIcon icon={faLock} className="me-2" />
                  Confirm Password
                </label>
                <input
                  type="password"
                  id="confirmPassword"
                  name="confirmPassword"
                  value={formData.confirmPassword}
                  onChange={handleChange}
                  className="form-control form-control-lg"
                  placeholder="Confirm your password"
                  required
                />
              </div>
            </div>

            <div className="mb-3">
              <label htmlFor="role" className="form-label">
                <FontAwesomeIcon icon={faUser} className="me-2" />
                Register As
              </label>
              <select
                id="role"
                name="role"
                value={formData.role}
                onChange={handleChange}
                className="form-select form-select-lg"
                required
              >
                <option value="provider">Provider</option>
                <option value="association">Association</option>
              </select>
            </div>

            {error && <div className="alert alert-danger">{error}</div>}

            <button
              type="submit"
              className="btn btn-primary w-100 py-2"
              disabled={loading}
            >
              {loading ? (
                <>
                  <span className="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                  Registering...
                </>
              ) : (
                "Register Now"
              )}
            </button>
          </form>

          <div className="text-center mt-4">
            <p className="text-muted">Or register with:</p>
            <div className="d-flex justify-content-center gap-3">
              <button
                className="btn btn-outline-danger d-flex align-items-center justify-content-center"
                style={{ width: "120px" }}
              >
                <FontAwesomeIcon icon={faGoogle} className="me-2" />
                Google
              </button>
              <button
                className="btn btn-outline-primary d-flex align-items-center justify-content-center"
                style={{ width: "120px" }}
              >
                <FontAwesomeIcon icon={faFacebook} className="me-2" />
                Facebook
              </button>
            </div>
          </div>

          <div className="text-center mt-4">
            <p>
              Already have an account? <a href="/signin" className="text-primary">Login Now</a>
            </p>
          </div>
        </div>
      </div>
      
      <Footer />
    </>
  );
};

export default Register;