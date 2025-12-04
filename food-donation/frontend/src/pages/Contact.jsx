import React, { useState } from "react";
import { Form, Button, Col, Row, Card, Alert } from "react-bootstrap";
import 'bootstrap/dist/css/bootstrap.min.css';
import { FaUser, FaEnvelope, FaCommentDots, FaPaperPlane } from 'react-icons/fa';
import Footer from "../components/Footer";
import Header from "../components/Header";

const Contact = () => {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });

  const [showAlert, setShowAlert] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log("Contact form submitted:", formData);
    setShowAlert(true);

    setFormData({
      name: "",
      email: "",
      message: "",
    });

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
          <h1 className="display-4 fw-bold">Contact Us</h1>
          <p className="lead mb-4">
            If you have any questions or need help, feel free to reach out to us!
          </p>
        </div>
      </section>

      {/* Contact Form Section */}
      <div className="container my-5">
        <div className="d-flex justify-content-center">
          <Card className="w-75 p-4 shadow-lg border-0">
            <Card.Body>
              {/* Bootstrap Alert for Success Message */}
              {showAlert && (
                <Alert variant="success" onClose={() => setShowAlert(false)} dismissible>
                  Your message has been sent successfully! We will get back to you soon.
                </Alert>
              )}

              <section className="contact-content">
                <Form onSubmit={handleSubmit} className="contact-form">
                  <Row className="mb-3">
                    <Col md={6}>
                      <Form.Group controlId="name">
                        <Form.Label><FaUser className="me-2" style={{ fontSize: '1.25rem' }} />Name:</Form.Label>
                        <Form.Control
                          type="text"
                          name="name"
                          value={formData.name}
                          onChange={handleChange}
                          required
                          className="form-control-lg"
                        />
                      </Form.Group>
                    </Col>
                    <Col md={6}>
                      <Form.Group controlId="email">
                        <Form.Label><FaEnvelope className="me-2" style={{ fontSize: '1.25rem' }} />Email:</Form.Label>
                        <Form.Control
                          type="email"
                          name="email"
                          value={formData.email}
                          onChange={handleChange}
                          required
                          className="form-control-lg"
                        />
                      </Form.Group>
                    </Col>
                  </Row>

                  <Row className="mb-3">
                    <Col>
                      <Form.Group controlId="message">
                        <Form.Label><FaCommentDots className="me-2" style={{ fontSize: '1.25rem' }} />Message:</Form.Label>
                        <Form.Control
                          as="textarea"
                          rows={4}
                          name="message"
                          value={formData.message}
                          onChange={handleChange}
                          required
                          className="form-control-lg"
                        />
                      </Form.Group>
                    </Col>
                  </Row>

                  <div className="text-center">
                    <Button 
                      type="submit" 
                      variant="outline-dark" 
                      size="lg" 
                      className="btn-lg shadow-sm"
                    >
                      <FaPaperPlane className="me-2" style={{ fontSize: '1.25rem' }} /> Send Message
                    </Button>
                  </div>
                </Form>
              </section>
            </Card.Body>
          </Card>
        </div>
      </div>
      {/* Footer */}
      <Footer />
    </>
  );
};

export default Contact;