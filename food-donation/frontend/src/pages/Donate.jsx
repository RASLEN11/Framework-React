import React, { useState } from "react";
import { FaMoneyBillWave, FaAppleAlt, FaUser, FaEnvelope, FaCalendarAlt, FaIdCard, FaDonate } from "react-icons/fa";
import { Button, Form, Col, Row, InputGroup, Card, Alert } from "react-bootstrap";
import 'bootstrap/dist/css/bootstrap.min.css';
import Header from "../components/Header";
import Footer from "../components/Footer";

const Donate = () => {
  const [donationType, setDonationType] = useState("money");
  const [formData, setFormData] = useState({
    cin: "",
    firstName: "",
    lastName: "",
    age: "",
    email: "",
    amount: "",
    foodQuantity: "",
    foodType: "",
  });

  const [showAlert, setShowAlert] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleDonationTypeChange = (type) => {
    setDonationType(type);
  };

  const handleFormSubmit = (e) => {
    e.preventDefault();
    console.log("Donation submitted:", formData);

    // Show success alert
    setShowAlert(true);

    // Clear the form fields
    setFormData({
      cin: "",
      firstName: "",
      lastName: "",
      age: "",
      email: "",
      amount: "",
      foodQuantity: "",
      foodType: "",
    });

    // Hide the alert after 5 seconds
    setTimeout(() => {
      setShowAlert(false);
    }, 5000);
  };

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
          <h1 className="display-4 fw-bold">Donate to Fight Hunger</h1>
          <p className="lead mb-4">
            Your contribution makes a difference!
          </p>
        </div>
      </section>

      <div className="container my-5">
        {/* Donation Type Buttons */}
        <div className="text-center mb-4">
          <Button
            variant={donationType === "money" ? "dark" : "outline-dark"}
            className="mx-3"
            onClick={() => handleDonationTypeChange("money")}
          >
            <FaMoneyBillWave className="me-2" /> Money
          </Button>
          <Button
            variant={donationType === "food" ? "dark" : "outline-dark"}
            className="mx-3"
            onClick={() => handleDonationTypeChange("food")}
          >
            <FaAppleAlt className="me-2" /> Food
          </Button>
        </div>

        <Card className="p-4 shadow-sm border">
          {/* Bootstrap Alert for Success Message */}
          {showAlert && (
            <Alert variant="success" onClose={() => setShowAlert(false)} dismissible>
              Thank you for your donation! We appreciate your support.
            </Alert>
          )}

          <Form onSubmit={handleFormSubmit}>
            <Row className="mb-3">
              <Col sm={12} md={6}>
                <Form.Group controlId="cin">
                  <Form.Label><FaIdCard className="me-2" /> CIN</Form.Label>
                  <Form.Control
                    type="text"
                    name="cin"
                    value={formData.cin}
                    onChange={handleChange}
                    required
                  />
                </Form.Group>
              </Col>
              <Col sm={12} md={6}>
                <Form.Group controlId="firstName">
                  <Form.Label><FaUser className="me-2" /> First Name</Form.Label>
                  <Form.Control
                    type="text"
                    name="firstName"
                    value={formData.firstName}
                    onChange={handleChange}
                    required
                  />
                </Form.Group>
              </Col>
            </Row>

            <Row className="mb-3">
              <Col sm={12} md={6}>
                <Form.Group controlId="lastName">
                  <Form.Label><FaUser className="me-2" /> Last Name</Form.Label>
                  <Form.Control
                    type="text"
                    name="lastName"
                    value={formData.lastName}
                    onChange={handleChange}
                    required
                  />
                </Form.Group>
              </Col>
              <Col sm={12} md={6}>
                <Form.Group controlId="age">
                  <Form.Label><FaCalendarAlt className="me-2" /> Age</Form.Label>
                  <Form.Control
                    type="number"
                    name="age"
                    value={formData.age}
                    onChange={handleChange}
                    required
                  />
                </Form.Group>
              </Col>
            </Row>

            <Row className="mb-3">
              <Col sm={12} md={6}>
                <Form.Group controlId="email">
                  <Form.Label><FaEnvelope className="me-2" /> Email</Form.Label>
                  <Form.Control
                    type="email"
                    name="email"
                    value={formData.email}
                    onChange={handleChange}
                    required
                  />
                </Form.Group>
              </Col>
            </Row>

            {/* Conditional Fields for Food or Money Donation */}
            {donationType === "food" && (
              <>
                <Row className="mb-3">
                  <Col sm={12} md={6}>
                    <Form.Group controlId="foodType">
                      <Form.Label><FaAppleAlt className="me-2" /> Type of Food</Form.Label>
                      <Form.Control
                        type="text"
                        name="foodType"
                        value={formData.foodType}
                        onChange={handleChange}
                        required
                      />
                    </Form.Group>
                  </Col>
                  <Col sm={12} md={6}>
                    <Form.Group controlId="foodQuantity">
                      <Form.Label><FaAppleAlt className="me-2" /> Quantity (kg)</Form.Label>
                      <Form.Control
                        type="number"
                        name="foodQuantity"
                        value={formData.foodQuantity}
                        onChange={handleChange}
                        required
                      />
                    </Form.Group>
                  </Col>
                </Row>
              </>
            )}

            {donationType === "money" && (
              <>
                <Row className="mb-3">
                  <Col sm={12} md={6}>
                    <Form.Group controlId="amount">
                      <Form.Label><FaMoneyBillWave className="me-2" /> Donation Amount (USD)</Form.Label>
                      <InputGroup>
                        <InputGroup.Text>$</InputGroup.Text>
                        <Form.Control
                          type="number"
                          name="amount"
                          value={formData.amount}
                          onChange={handleChange}
                          required
                        />
                      </InputGroup>
                    </Form.Group>
                  </Col>
                </Row>
              </>
            )}

            <div className="text-center">
              <Button type="submit" variant={donationType === "food" ? "dark" : "outline-dark"} size="lg">
                <FaDonate className="me-2" /> Donate Now
              </Button>
            </div>
          </Form>
        </Card>
      </div>
      {/* Footer */}
      <Footer />
    </>
  );
};

export default Donate;