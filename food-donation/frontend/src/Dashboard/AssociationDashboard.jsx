import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Alert, Badge, Modal, Button } from 'react-bootstrap';
import { useContext } from 'react';
import { UserContext } from '../context/UserContext';
import {
  faTachometerAlt,
  faUtensils,
  faCog,
  faSignOutAlt,
  faBars,
  faHandHoldingUsd,
  faUserCircle,
  faShoppingCart,
} from '@fortawesome/free-solid-svg-icons';

const AssociationDashboard = () => {
  const navigate = useNavigate();
  const { setUserType, setUserId, setUserName } = useContext(UserContext);
  const [activeTab, setActiveTab] = useState('dashboard');
  const [sidebarCollapsed, setSidebarCollapsed] = useState(false);
  const [associationInfo] = useState({
    cin: '123456',
    name: 'Green Earth Association',
    email: 'association@gmail.com',
    telephone: '123-456-7890',
    password: '********',
  });
  const [foodList, setFoodList] = useState([
    {
      _id: 1,
      name: 'Apple',
      ingredients: 'Fruit',
      quantity: 10,
      sortDate: '2023-10-01',
      expiryDate: '2023-10-15',
      status: 'Fresh',
      donated: 0,
      donor: 'Local Farm',
    },
    {
      _id: 2,
      name: 'Bread',
      ingredients: 'Flour, Water, Yeast',
      quantity: 5,
      sortDate: '2023-10-05',
      expiryDate: '2023-10-20',
      status: 'Expired',
      donated: 0,
      donor: 'Bakery Shop',
    },
    {
      _id: 3,
      name: 'Carrot',
      ingredients: 'Vegetable',
      quantity: 15,
      sortDate: '2023-10-10',
      expiryDate: '2023-10-25',
      status: 'Fresh',
      donated: 0,
      donor: 'Local Farm',
    },
  ]);

  const [donations, setDonations] = useState([
    {
      _id: 1,
      name: 'Alice',
      amount: 100,
      date: '2023-10-10',
    },
    {
      _id: 2,
      name: 'Bob',
      amount: 200,
      date: '2023-10-15',
    },
  ]);

  const [cart, setCart] = useState([]);
  const [showCartModal, setShowCartModal] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedDonor, setSelectedDonor] = useState('all');
  const [expiryDateFilter, setExpiryDateFilter] = useState('');

  // Timeout for alerts
  useEffect(() => {
    if (error || success) {
      const timer = setTimeout(() => {
        setError('');
        setSuccess('');
      }, 3000);
      return () => clearTimeout(timer);
    }
  }, [error, success]);

  // Filter food items based on search and filters
  const filteredFoodList = foodList.filter((item) => {
    const searchLower = searchTerm.toLowerCase();
    const matchesSearch =
      item.name.toLowerCase().includes(searchLower) ||
      item.ingredients.toLowerCase().includes(searchLower);
    const matchesDonor = selectedDonor === 'all' || item.donor === selectedDonor;
    const matchesExpiry = expiryDateFilter ? item.expiryDate === expiryDateFilter : true;

    return matchesSearch && matchesDonor && matchesExpiry;
  });

  const handleLogout = () => {
    setUserType(null); // Clear The User Type
    setUserId(null);
    setUserName(null);
    navigate("/"); // Redirect To Homepage
  };

  const handleDonate = (id) => {
    const updatedFoodList = foodList.map((item) =>
      item._id === id ? { ...item, donated: item.quantity, status: 'Donated' } : item
    );
    setFoodList(updatedFoodList);

    const donatedItem = foodList.find((item) => item._id === id);
    setDonations([
      ...donations,
      {
        _id: donations.length + 1,
        name: 'Anonymous Donor',
        amount: donatedItem.quantity * 10, // Example calculation
        date: new Date().toISOString().split('T')[0],
      },
    ]);

    setSuccess('Food item donated successfully!');
    setError('');
  };

  const handleDelete = (id) => {
    const updatedFoodList = foodList.filter((item) => item._id !== id);
    setFoodList(updatedFoodList);
    setSuccess('Food item deleted successfully!');
    setError('');
  };

  const handleAddToCart = (item) => {
    if (item.status !== 'Fresh') {
      setError('Only fresh items can be added to the cart.');
      setSuccess('');
      return;
    }
    setCart([...cart, item]);
    setSuccess('Item added to cart successfully!');
    setError('');
  };

  const handleRemoveFromCart = (id) => {
    const updatedCart = cart.filter((item) => item._id !== id);
    setCart(updatedCart);
    setSuccess('Item removed from cart successfully!');
    setError('');
  };

  const totalDonations = donations.reduce((total, donation) => total + donation.amount, 0);
  const totalAvailableFood = foodList.filter((item) => item.status === 'Fresh').length;
  const totalExpiredFood = foodList.filter((item) => item.status === 'Expired').length;
  const totalDonatedFood = foodList.reduce((total, item) => total + (item.donated || 0), 0);

  const renderSidebar = () => (
    <nav
      className="bg-dark text-white p-3 d-flex flex-column justify-content-between"
      style={{
        width: sidebarCollapsed ? '80px' : '250px',
        height: '100vh',
        transition: 'width 0.3s ease',
        position: 'fixed',
        left: 0,
        top: 0,
        zIndex: 1000,
      }}
    >
      <div>
        <button
          className="btn btn-link text-white"
          onClick={() => setSidebarCollapsed(!sidebarCollapsed)}
          aria-label={sidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'}
        >
          <FontAwesomeIcon icon={faBars} />
        </button>
        <ul className="nav flex-column mt-4">
          <li className="nav-item d-flex align-items-center mb-3">
            <FontAwesomeIcon icon={faUserCircle} size="2x" className="me-2" />
            {!sidebarCollapsed && <span className="text-light">{associationInfo.name}</span>}
          </li>
          {['dashboard', 'manageFood', 'donation', 'settings'].map((tab) => (
            <li key={tab} className="nav-item">
              <button
                className={`nav-link text-white ${activeTab === tab ? 'active' : ''}`}
                onClick={() => setActiveTab(tab)}
              >
                <FontAwesomeIcon
                  icon={
                    tab === 'dashboard'
                      ? faTachometerAlt
                      : tab === 'manageFood'
                      ? faUtensils
                      : tab === 'donation'
                      ? faHandHoldingUsd
                      : faCog
                  }
                />
                {!sidebarCollapsed && ` ${tab.charAt(0).toUpperCase() + tab.slice(1)}`}
              </button>
            </li>
          ))}
        </ul>
      </div>
      <div>
        <button className="nav-link text-white" onClick={handleLogout}>
          <FontAwesomeIcon icon={faSignOutAlt} />
          {!sidebarCollapsed && ' Logout'}
        </button>
      </div>
    </nav>
  );

  const renderMainContent = () => {
    switch (activeTab) {
      case 'dashboard':
        return (
          <div className="dashboard">
            <h1>Dashboard</h1>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && <Alert variant="success">{success}</Alert>}
            <div className="row mb-4">
              <div className="col-md-4">
                <div className="card bg-success text-white">
                  <div className="card-body">
                    <h5 className="card-title">Available Food</h5>
                    <p className="card-text">{totalAvailableFood} items</p>
                  </div>
                </div>
              </div>
              <div className="col-md-4">
                <div className="card bg-danger text-white">
                  <div className="card-body">
                    <h5 className="card-title">Expired Food</h5>
                    <p className="card-text">{totalExpiredFood} items</p>
                  </div>
                </div>
              </div>
              <div className="col-md-4">
                <div className="card bg-primary text-white">
                  <div className="card-body">
                    <h5 className="card-title">Donated Food</h5>
                    <p className="card-text">{totalDonatedFood} items</p>
                  </div>
                </div>
              </div>
            </div>
            <table className="table table-bordered">
              <thead>
                <tr>
                  <th>CIN</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Telephone</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{associationInfo.cin}</td>
                  <td>{associationInfo.name}</td>
                  <td>{associationInfo.email}</td>
                  <td>{associationInfo.telephone}</td>
                </tr>
              </tbody>
            </table>
          </div>
        );
      case 'manageFood':
        return (
          <div className="food-management">
            <h1>Manage Food</h1>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && <Alert variant="success">{success}</Alert>}

            {/* Search and Filter Controls */}
            <div className="mb-3">
              <input
                type="text"
                className="form-control"
                placeholder="Search by name or ingredients..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
              />
            </div>
            <div className="row mb-3">
              <div className="col-md-6">
                <select
                  className="form-select"
                  value={selectedDonor}
                  onChange={(e) => setSelectedDonor(e.target.value)}
                >
                  <option value="all">All Donors</option>
                  {[...new Set(foodList.map((item) => item.donor))].map((donor) => (
                    <option key={donor} value={donor}>
                      {donor}
                    </option>
                  ))}
                </select>
              </div>
              <div className="col-md-6">
                <input
                  type="date"
                  className="form-control"
                  value={expiryDateFilter}
                  onChange={(e) => setExpiryDateFilter(e.target.value)}
                />
              </div>
            </div>

            <table className="table table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Ingredients</th>
                  <th>Quantity</th>
                  <th>Sort Date</th>
                  <th>Expiry Date</th>
                  <th>Status</th>
                  <th>Donor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {filteredFoodList.map((item) => (
                  <tr key={item._id}>
                    <td>{item.name}</td>
                    <td>{item.ingredients}</td>
                    <td>{item.quantity}</td>
                    <td>{item.sortDate}</td>
                    <td>{item.expiryDate}</td>
                    <td>{item.status}</td>
                    <td>{item.donor}</td>
                    <td>
                      {item.status === 'Fresh' && (
                        <>
                          <button
                            className="btn btn-success me-2"
                            onClick={() => handleAddToCart(item)}
                          >
                            Add to Cart
                          </button>
                          <button
                            className="btn btn-primary me-2"
                            onClick={() => handleDonate(item._id)}
                          >
                            Donate
                          </button>
                        </>
                      )}
                      <button
                        className="btn btn-danger"
                        onClick={() => handleDelete(item._id)}
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        );
      case 'donation':
        return (
          <div className="donation-management">
            <h1>Donations</h1>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && <Alert variant="success">{success}</Alert>}
            <div className="mb-4">
              <h4>Total Donations: ${totalDonations}</h4>
            </div>
            <table className="table table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                {donations.map((donation) => (
                  <tr key={donation._id}>
                    <td>{donation.name}</td>
                    <td>${donation.amount}</td>
                    <td>{donation.date}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        );
      case 'settings':
        return (
          <div className="settings">
            <h1>Settings</h1>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && <Alert variant="success">{success}</Alert>}
            <div className="settings-form">
              {['cin', 'name', 'email', 'password', 'telephone'].map((field) => (
                <div key={field} className="mb-3">
                  <label className="form-label">{field.charAt(0).toUpperCase() + field.slice(1)}:</label>
                  <input
                    type={field === 'password' ? 'password' : field === 'email' ? 'email' : 'text'}
                    className="form-control"
                    value={associationInfo[field]}
                    readOnly
                  />
                </div>
              ))}
              <button
                className="btn btn-dark"
                onClick={() => {
                  setSuccess('Information saved successfully!');
                  setError('');
                }}
              >
                Save
              </button>
            </div>
          </div>
        );
      default:
        return null;
    }
  };

  return (
    <div className="d-flex bg-light">
      {renderSidebar()}
      <div
        className="container-fluid"
        style={{ marginLeft: sidebarCollapsed ? '80px' : '250px', transition: 'margin-left 0.3s ease' }}
      >
        <header className="d-flex justify-content-between align-items-center p-4">
          <h1>Welcome, {associationInfo.name}</h1>
          <button className="btn btn-primary" onClick={() => setShowCartModal(true)}>
            <FontAwesomeIcon icon={faShoppingCart} />{' '}
            <Badge bg="danger">{cart.length}</Badge>
          </button>
        </header>
        <main className="bg-light p-4">{renderMainContent()}</main>
      </div>

      {/* Cart Modal */}
      <Modal show={showCartModal} onHide={() => setShowCartModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Cart</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {cart.length === 0 ? (
            <p>Your cart is empty.</p>
          ) : (
            <table className="table table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Quantity</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                {cart.map((item) => (
                  <tr key={item._id}>
                    <td>{item.name}</td>
                    <td>{item.quantity}</td>
                    <td>
                      <button
                        className="btn btn-danger"
                        onClick={() => handleRemoveFromCart(item._id)}
                      >
                        Remove
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          )}
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowCartModal(false)}>
            Close
          </Button>
          <Button variant="primary" onClick={() => alert('Checkout functionality not implemented yet.')}>
            Checkout
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default AssociationDashboard;