import React from 'react';
import { Container, Row, Col, Nav } from 'react-bootstrap';

const Footer = () => {
  return (
    <footer className="bg-dark text-white pt-5 pb-3">
      <Container>
        <Row className="mb-4">
          {/* Contact Us Section */}
          <Col md={4} sm={12} className="mb-3">
            <h5>Contact Us</h5>
            <p>Email: <a href="mailto:rklaboussi15@gmail.com" className="text-white text-decoration-none">rklaboussi15@gmail.com</a></p>
            <p>Phone: +216 29098543</p>
          </Col>

          {/* Quick Links Section */}
          <Col md={4} sm={12} className="mb-3">
            <h5>Quick Links</h5>
            <Nav className="flex-column">
              <Nav.Link href="/" className="text-white text-decoration-none">Home</Nav.Link>
              <Nav.Link href="/about" className="text-white text-decoration-none">About Us</Nav.Link>
              <Nav.Link href="/donate" className="text-white text-decoration-none">Donate</Nav.Link>
              <Nav.Link href="/contact" className="text-white text-decoration-none">Contact</Nav.Link>
            </Nav>
          </Col>

          {/* Follow Us Section */}
          <Col md={4} sm={12} className="mb-3">
            <h5>Follow Us</h5>
            <div className="social-icons">
              <a
                href="https://facebook.com"
                className="text-white me-3"
                aria-label="Facebook"
                data-bs-toggle="tooltip" 
                title="Facebook"
              >
                <i className="fa fa-facebook fa-2x"></i>
              </a>
              <a
                href="https://twitter.com"
                className="text-white me-3"
                aria-label="Twitter"
                data-bs-toggle="tooltip"
                title="Twitter"
              >
                <i className="fa fa-twitter fa-2x"></i>
              </a>
              <a
                href="https://instagram.com"
                className="text-white"
                aria-label="Instagram"
                data-bs-toggle="tooltip"
                title="Instagram"
              >
                <i className="fa fa-instagram fa-2x"></i>
              </a>
            </div>
          </Col>
        </Row>

        <div className="text-center py-3">
          <p>&copy; 2025 Food Donation. All rights reserved.</p>
        </div>
      </Container>
    </footer>
  );
};

export default Footer;
