import React, { useState, useEffect } from "react";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faBacon, faMoneyBill, faUsers, faBuilding, faChartLine, faTrophy, faCalendarCheck, } from '@fortawesome/free-solid-svg-icons';
import { Modal, Button } from "react-bootstrap";
import 'bootstrap/dist/css/bootstrap.min.css';
import Header from "../components/Header";
import Footer from "../components/Footer";

const Dashboard = () => {
  const [foodDonations, setFoodDonations] = useState(0);
  const [moneyDonations, setMoneyDonations] = useState(0);
  const [provider, setDonors] = useState(0);
  const [associations, setAssociations] = useState(0);
  const [recentDonations, setRecentDonations] = useState(15);
  const [topDonors, setTopDonors] = useState(5);
  const [activeCampaigns, setActiveCampaigns] = useState(3);

  const [showModal, setShowModal] = useState(false);
  const [modalContent, setModalContent] = useState({ title: "", body: "", icon: null });

  useEffect(() => {
    // Simulate fetching data
    setFoodDonations(250);
    setMoneyDonations(1500);
    setDonors(120);
    setAssociations(30);
    setRecentDonations(15);
    setTopDonors(5);
    setActiveCampaigns(3);
  }, []);

  const handleCardClick = (title, body, icon) => {
    setModalContent({ title, body, icon });
    setShowModal(true);
  };

  const handleCloseModal = () => setShowModal(false);

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
          <h1 className="display-4 fw-bold">Dashboard Overview</h1>
          <p className="lead mb-4">
            Statistics and insights on your donations and contributions.
          </p>
        </div>
      </section>

      <div className="container my-5">
        {/* Main Statistics Section */}
        <div className="row text-center">
          {/* Food Donations Card */}
          <div className="col-md-3 mb-4">
            <div
              className="p-4 border rounded shadow-sm bg-white h-100 d-flex flex-column justify-content-center"
              style={{ transition: 'transform 0.3s', cursor: 'pointer' }}
              onMouseEnter={(e) => (e.currentTarget.style.transform = 'scale(1.05)')}
              onMouseLeave={(e) => (e.currentTarget.style.transform = 'scale(1)')}
              onClick={() =>
                handleCardClick(
                  "Food Donations",
                  `${foodDonations} items have been donated so far.`,
                  faBacon
                )
              }
            >
              <FontAwesomeIcon icon={faBacon} size="3x" className="mb-3" aria-label="Food Donations" />
              <h3>Food Donations</h3>
              <p className="fs-5">{foodDonations} items donated</p>
            </div>
          </div>

          {/* Money Donations Card */}
          <div className="col-md-3 mb-4">
            <div
              className="p-4 border rounded shadow-sm bg-white h-100 d-flex flex-column justify-content-center"
              style={{ transition: 'transform 0.3s', cursor: 'pointer' }}
              onMouseEnter={(e) => (e.currentTarget.style.transform = 'scale(1.05)')}
              onMouseLeave={(e) => (e.currentTarget.style.transform = 'scale(1)')}
              onClick={() =>
                handleCardClick(
                  "Money Donations",
                  `A total of $${moneyDonations} has been donated.`,
                  faMoneyBill
                )
              }
            >
              <FontAwesomeIcon icon={faMoneyBill} size="3x" className="mb-3" aria-label="Money Donations" />
              <h3>Money Donations</h3>
              <p className="fs-5">${moneyDonations} donated</p>
            </div>
          </div>

          {/* Provider Card */}
          <div className="col-md-3 mb-4">
            <div
              className="p-4 border rounded shadow-sm bg-white h-100 d-flex flex-column justify-content-center"
              style={{ transition: 'transform 0.3s', cursor: 'pointer' }}
              onMouseEnter={(e) => (e.currentTarget.style.transform = 'scale(1.05)')}
              onMouseLeave={(e) => (e.currentTarget.style.transform = 'scale(1)')}
              onClick={() =>
                handleCardClick(
                  "Provider",
                  `There are ${provider} active providers.`,
                  faUsers
                )
              }
            >
              <FontAwesomeIcon icon={faUsers} size="3x" className="mb-3" aria-label="Provider" />
              <h3>Provider</h3>
              <p className="fs-5">
                {provider} provider
              </p>
            </div>
          </div>

          {/* Associations Card */}
          <div className="col-md-3 mb-4">
            <div
              className="p-4 border rounded shadow-sm bg-white h-100 d-flex flex-column justify-content-center"
              style={{ transition: 'transform 0.3s', cursor: 'pointer' }}
              onMouseEnter={(e) => (e.currentTarget.style.transform = 'scale(1.05)')}
              onMouseLeave={(e) => (e.currentTarget.style.transform = 'scale(1)')}
              onClick={() =>
                handleCardClick(
                  "Associations",
                  `There are ${associations} active associations.`,
                  faBuilding
                )
              }
            >
              <FontAwesomeIcon icon={faBuilding} size="3x" className="mb-3" aria-label="Associations" />
              <h3>Associations</h3>
              <p className="fs-5">
                {associations} associations
              </p>
            </div>
          </div>
        </div>

        {/* Additional Statistics Section */}
        <div className="row text-center mt-4">
          {/* Recent Donations Card */}
          <div className="col-md-4 mb-4">
            <div
              className="p-4 border rounded shadow-sm bg-white h-100 d-flex flex-column justify-content-center"
              style={{ transition: 'transform 0.3s', cursor: 'pointer' }}
              onMouseEnter={(e) => (e.currentTarget.style.transform = 'scale(1.05)')}
              onMouseLeave={(e) => (e.currentTarget.style.transform = 'scale(1)')}
              onClick={() =>
                handleCardClick(
                  "Recent Donations",
                  `There have been ${recentDonations} donations this week.`,
                  faChartLine
                )
              }
            >
              <FontAwesomeIcon icon={faChartLine} size="3x" className="mb-3" aria-label="Recent Donations" />
              <h3>Recent Donations</h3>
              <p className="fs-5">{recentDonations} donations this week</p>
            </div>
          </div>

          {/* Top Donors Card */}
          <div className="col-md-4 mb-4">
            <div
              className="p-4 border rounded shadow-sm bg-white h-100 d-flex flex-column justify-content-center"
              style={{ transition: 'transform 0.3s', cursor: 'pointer' }}
              onMouseEnter={(e) => (e.currentTarget.style.transform = 'scale(1.05)')}
              onMouseLeave={(e) => (e.currentTarget.style.transform = 'scale(1)')}
              onClick={() =>
                handleCardClick(
                  "Top Donors",
                  `There are ${topDonors} top donors contributing regularly.`,
                  faTrophy
                )
              }
            >
              <FontAwesomeIcon icon={faTrophy} size="3x" className="mb-3" aria-label="Top Donors" />
              <h3>Top Donors</h3>
              <p className="fs-5">{topDonors} active donors</p>
            </div>
          </div>

          {/* Active Campaigns Card */}
          <div className="col-md-4 mb-4">
            <div
              className="p-4 border rounded shadow-sm bg-white h-100 d-flex flex-column justify-content-center"
              style={{ transition: 'transform 0.3s', cursor: 'pointer' }}
              onMouseEnter={(e) => (e.currentTarget.style.transform = 'scale(1.05)')}
              onMouseLeave={(e) => (e.currentTarget.style.transform = 'scale(1)')}
              onClick={() =>
                handleCardClick(
                  "Active Campaigns",
                  `There are ${activeCampaigns} ongoing campaigns.`,
                  faCalendarCheck
                )
              }
            >
              <FontAwesomeIcon icon={faCalendarCheck} size="3x" className="mb-3" aria-label="Active Campaigns" />
              <h3>Active Campaigns</h3>
              <p className="fs-5">{activeCampaigns} ongoing campaigns</p>
            </div>
          </div>
        </div>
      </div>

      {/* Modal for Detailed Information */}
      <Modal show={showModal} onHide={handleCloseModal} centered>
        <Modal.Header
          closeButton
          className="border-0 text-center-white"
        >
          <Modal.Title>
            <FontAwesomeIcon icon={modalContent.icon} className="me-2" />
            {modalContent.title}
          </Modal.Title>
        </Modal.Header>
        <Modal.Body style={{ padding: "20px" }}>
          <p>{modalContent.body}</p>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleCloseModal}>
            Close
          </Button>
        </Modal.Footer> 
      </Modal>
      {/* Footer */}
      <Footer />
    </>
  );
};

export default Dashboard;