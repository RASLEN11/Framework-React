import React, { useContext, useState } from "react";
import { useNavigate } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faUser, faLock, faEye, faEyeSlash } from "@fortawesome/free-solid-svg-icons";
import { faGoogle, faFacebook } from "@fortawesome/free-brands-svg-icons";
import "bootstrap/dist/css/bootstrap.min.css";
import Header from "../components/Header";
import Footer from "../components/Footer";
import { UserContext } from "../context/UserContext";
import axios from "axios";

function SignIn(){
  const [formData, setFormData] = useState({
    email: "",
    password: "",
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const [showPassword, setShowPassword] = useState(false);
  const navigate = useNavigate();
  const { setUserType, setUserId, setUserName, setUserEmail, setUserPassword } = useContext(UserContext);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  const handleSubmit = (e) => {
  e.preventDefault();

  // Simple validation
  if (!formData.email.trim()) {
    setError("Please enter your email address.");
    return;
  }
  if (!formData.password) {
    setError("Please enter your password.");
    return;
  }
  setError(""); // Clear any previous error
  setLoading(true);

  // Submit to backend
  axios
    .post("http://localhost:5000/signin", formData)
    .then((res) => {
      if (res.data.message === "Success") {
        const { user_id, name, email, password, role } = res.data;

        setUserType(role);
        setUserId(user_id);
        setUserName(name);
        setUserEmail(email);
        setUserPassword(password); // ⚠️ Optional: Don't store plain passwords in production

        console.log("User ID:", user_id);
        console.log("Account Role:", role);

        // Navigate to correct dashboard
        if (role === "admin") {
          navigate("/admin");
        } else if (role === "provider") {
          navigate("/provider");
        } else if (role === "association") {
          navigate("/association");
        }
      } else {
        setError("Invalid credentials");
      }
    })
    .catch((err) => {
      if (err.response) {
        if (err.response.status === 404) {
          setError("Email not found");
        } else if (err.response.status === 401) {
          setError("Incorrect password");
        } else {
          setError("Something went wrong. Please try again.");
        }
      } else {
        console.error("Axios Error:", err);
        setError("Network error. Try again later.");
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
          backgroundSize: "cover",
          backgroundPosition: "center",
          height: "32vh",
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
        }}
      >
        <div className="container">
          <h1 className="display-4 fw-bold">Sign In</h1>
          <p className="lead mb-4">
            Welcome back! Please sign in to continue.
          </p>
        </div>
      </section>

      <div className="container mt-5">
        <div
          className="signin-container mx-auto p-4 shadow-lg rounded bg-white"
          style={{ maxWidth: "500px" }}
        >
          <form onSubmit={handleSubmit}>
            <div className="mb-4">
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
            <div className="mb-4">
              <label htmlFor="password" className="form-label">
                <FontAwesomeIcon icon={faLock} className="me-2" />
                Password
              </label>
              <div className="input-group">
                <input
                  type={showPassword ? "text" : "password"}
                  id="password"
                  name="password"
                  value={formData.password}
                  onChange={handleChange}
                  className="form-control form-control-lg"
                  placeholder="Enter your password"
                  required
                />
                <button
                  type="button"
                  className="btn btn-outline-secondary"
                  onClick={togglePasswordVisibility}
                >
                  <FontAwesomeIcon icon={showPassword ? faEyeSlash : faEye} />
                </button>
              </div>
            </div>
            {error && <div className="alert alert-danger">{error}</div>}
            <button
              type="submit"
              className="btn btn-outline-dark w-100"
              disabled={loading}
            >
              {loading ? (
                <>
                  <span
                    className="spinner-border spinner-border-sm"
                    role="status"
                    aria-hidden="true"
                  ></span>
                  <span className="ms-2">Signing In...</span>
                </>
              ) : (
                "Sign In"
              )}
            </button>
          </form>

          <div className="text-center mt-4">
            <p className="text-muted">Or sign in with:</p>
            <div className="d-flex justify-content-center gap-3">
              <button
                className="btn btn-outline-danger d-flex align-items-center"
                style={{ width: "120px" }}
              >
                <FontAwesomeIcon icon={faGoogle} className="me-2" />
                Google
              </button>
              <button
                className="btn btn-outline-primary d-flex align-items-center"
                style={{ width: "120px" }}
              >
                <FontAwesomeIcon icon={faFacebook} className="me-2" />
                Facebook
              </button>
            </div>
          </div>
          <div className="text-center mt-4">
            <p>
              Don't have an account?{" "}
              <a href="/register" style={{ color: "#764ba2" }}>
                Sign Up Now
              </a>
            </p>
          </div>
        </div>
      </div>
      <br /><br />
      <Footer />
    </>
  );
};

export default SignIn;