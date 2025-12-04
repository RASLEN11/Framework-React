import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import "bootstrap/dist/css/bootstrap.min.css";
import { Modal, Button, Alert } from "react-bootstrap";
import { useContext } from "react";
import { UserContext } from "../context/UserContext";
import {
  faTachometerAlt,
  faUtensils,
  faCog,
  faSignOutAlt,
  faBars,
  faUserCircle,
  faEdit,
  faTrash,
  faSearch,
} from "@fortawesome/free-solid-svg-icons";

const ProviderDashboard = () => {
  const navigate = useNavigate();
  const { setUserType, setUserId, setUserName, userId } = useContext(UserContext);
  const [activeTab, setActiveTab] = useState("dashboard");
  const [sidebarCollapsed, setSidebarCollapsed] = useState(false);
  const [providerInfo, setProviderInfo] = useState({
    cin: "",
    name: "",
    email: "",
    phone: "",
    password: "********",
  });
  const [foodList, setFoodList] = useState([]);
  const [newFood, setNewFood] = useState({
    name: "",
    ingredients: "",
    quantity: "",
    sortDate: "",
    expiryDate: "",
  });
  const [editFood, setEditFood] = useState(null);
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const [showAddFoodModal, setShowAddFoodModal] = useState(false);
  const [showEditFoodModal, setShowEditFoodModal] = useState(false);
  const [searchTerm, setSearchTerm] = useState("");
  const [expiryDateFilter, setExpiryDateFilter] = useState("");
  const [loading, setLoading] = useState(true);

  // Fetch provider data and food list on component mount
  useEffect(() => {
    if (userId) {
      fetchProviderInfo();
      fetchFoodList();
    }
  }, [userId]);

  const fetchProviderInfo = async () => {
    try {
      // You'll need to implement this endpoint in your backend
      const response = await fetch(`/api/providers/${userId}`);
      if (!response.ok) throw new Error("Failed to fetch provider info");
      const data = await response.json();
      setProviderInfo(data);
    } catch (err) {
      setError(err.message);
    }
  };

  const fetchFoodList = async () => {
    try {
      const response = await fetch(`/api/foods/${userId}`);
      if (!response.ok) throw new Error("Failed to fetch food list");
      const data = await response.json();
      setFoodList(data);
      setLoading(false);
    } catch (err) {
      setError(err.message);
      setLoading(false);
    }
  };

  // Timeout for alerts
  useEffect(() => {
    if (error || success) {
      const timer = setTimeout(() => {
        setError("");
        setSuccess("");
      }, 3000);
      return () => clearTimeout(timer);
    }
  }, [error, success]);

  // Handle adding a new food item
  const handleAddFood = async () => {
    if (
      !newFood.name ||
      !newFood.ingredients ||
      !newFood.quantity ||
      !newFood.sortDate ||
      !newFood.expiryDate
    ) {
      setError("All fields are required.");
      return;
    }

    try {
      const response = await fetch("/api/foods", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          ...newFood,
          provider_id: userId,
        }),
      });

      if (!response.ok) throw new Error("Failed to add food item");

      const result = await response.json();
      setFoodList([...foodList, { ...newFood, food_id: result.food_id }]);
      setNewFood({ name: "", ingredients: "", quantity: "", sortDate: "", expiryDate: "" });
      setSuccess("Food item added successfully!");
      setShowAddFoodModal(false);
    } catch (err) {
      setError(err.message);
    }
  };

  // Handle deleting a food item
  const handleDelete = async (id) => {
    try {
      const response = await fetch(`/api/foods/${id}`, {
        method: "DELETE",
      });

      if (!response.ok) throw new Error("Failed to delete food item");

      const updatedList = foodList.filter((food) => food.food_id !== id);
      setFoodList(updatedList);
      setSuccess("Food item deleted successfully!");
    } catch (err) {
      setError(err.message);
    }
  };

  // Handle updating a food item
  const handleUpdate = async () => {
    if (
      !editFood.name ||
      !editFood.ingredients ||
      !editFood.quantity ||
      !editFood.sortDate ||
      !editFood.expiryDate
    ) {
      setError("All fields are required.");
      return;
    }

    try {
      const response = await fetch(`/api/foods/${editFood.food_id}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          name: editFood.name,
          ingredients: editFood.ingredients,
          quantity: editFood.quantity,
          sortDate: editFood.sortDate,
          expiryDate: editFood.expiryDate,
        }),
      });

      if (!response.ok) throw new Error("Failed to update food item");

      const updatedList = foodList.map((food) =>
        food.food_id === editFood.food_id ? editFood : food
      );
      setFoodList(updatedList);
      setEditFood(null);
      setSuccess("Food item updated successfully!");
      setShowEditFoodModal(false);
    } catch (err) {
      setError(err.message);
    }
  };

  // Filter food items based on search term and expiry date
  const filteredFoodList = foodList.filter((item) => {
    const matchesSearch =
      item.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
      item.ingredients.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesExpiryDate = expiryDateFilter
      ? item.expiry_date === expiryDateFilter
      : true;
    return matchesSearch && matchesExpiryDate;
  });

  const handleLogout = () => {
    setUserType(null);
    setUserId(null);
    setUserName(null);
    navigate("/");
  };

  // Render the sidebar (unchanged from your original code)
  const renderSidebar = () => (
    <nav
      className={`bg-dark text-white p-3 d-flex flex-column justify-content-between`}
      style={{
        width: sidebarCollapsed ? "80px" : "250px",
        height: "100vh",
        transition: "width 0.3s ease",
        position: "fixed",
        left: 0,
        top: 0,
        zIndex: 1000,
      }}
    >
      <div>
        <button
          className="btn btn-link text-white"
          onClick={() => setSidebarCollapsed(!sidebarCollapsed)}
          aria-label={sidebarCollapsed ? "Expand Sidebar" : "Collapse Sidebar"}
        >
          <FontAwesomeIcon icon={faBars} />
        </button>
        <ul className="nav flex-column mt-4">
          <li className="nav-item d-flex align-items-center mb-3">
            <FontAwesomeIcon icon={faUserCircle} size="2x" className="me-2" />
            {!sidebarCollapsed && <span className="text-light">{providerInfo.name}</span>}
          </li>
          {["dashboard", "manageFood", "settings"].map((tab) => (
            <li key={tab} className="nav-item">
              <button
                className={`nav-link text-white ${activeTab === tab ? "active" : ""}`}
                onClick={() => setActiveTab(tab)}
              >
                <FontAwesomeIcon
                  icon={
                    tab === "dashboard"
                      ? faTachometerAlt
                      : tab === "manageFood"
                      ? faUtensils
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
          {!sidebarCollapsed && " Logout"}
        </button>
      </div>
    </nav>
  );

  // Render the main content based on the active tab
  const renderMainContent = () => {
    if (loading) {
      return <div className="text-center mt-5">Loading...</div>;
    }

    switch (activeTab) {
      case "dashboard":
        return (
          <div className="dashboard">
            <h1>Dashboard</h1>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && <Alert variant="success">{success}</Alert>}
            <table className="table table-bordered">
              <thead>
                <tr>
                  <th>CIN</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Food Quantity</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{providerInfo.cin}</td>
                  <td>{providerInfo.name}</td>
                  <td>{providerInfo.email}</td>
                  <td>{providerInfo.phone}</td>
                  <td>{foodList.reduce((sum, food) => sum + parseInt(food.quantity), 0)}</td>
                </tr>
              </tbody>
            </table>
          </div>
        );
      case "manageFood":
        return (
          <div className="food-management">
            <h1>Manage Food</h1>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && <Alert variant="success">{success}</Alert>}

            {/* Search and Filter Controls */}
            <div className="row mb-3">
              <div className="col-md-6">
                <div className="input-group">
                  <span className="input-group-text">
                    <FontAwesomeIcon icon={faSearch} />
                  </span>
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Search by name or ingredients..."
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                  />
                </div>
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

            <button className="btn btn-success mb-3" onClick={() => setShowAddFoodModal(true)}>
              Add Food
            </button>
            <table className="table table-bordered">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Ingredients</th>
                  <th>Quantity</th>
                  <th>Sort Date</th>
                  <th>Expiry Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                {filteredFoodList.length > 0 ? (
                  filteredFoodList.map((item) => (
                    <tr key={item.food_id}>
                      <td>{item.name}</td>
                      <td>{item.ingredients}</td>
                      <td>{item.quantity}</td>
                      <td>{new Date(item.sort_date).toLocaleDateString()}</td>
                      <td>{new Date(item.expiry_date).toLocaleDateString()}</td>
                      <td>
                        <button
                          className="btn btn-warning me-2"
                          onClick={() => {
                            setEditFood(item);
                            setShowEditFoodModal(true);
                          }}
                        >
                          <FontAwesomeIcon icon={faEdit} />
                        </button>
                        <button className="btn btn-danger" onClick={() => handleDelete(item.food_id)}>
                          <FontAwesomeIcon icon={faTrash} />
                        </button>
                      </td>
                    </tr>
                  ))
                ) : (
                  <tr>
                    <td colSpan="6" className="text-center">
                      No food items found
                    </td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        );
      case "settings":
        return (
          <div className="settings">
            <h1>Settings</h1>
            {error && <Alert variant="danger">{error}</Alert>}
            {success && <Alert variant="success">{success}</Alert>}
            <div className="settings-form">
              {["cin", "name", "email", "phone", "password"].map((field) => (
                <div key={field} className="mb-3">
                  <label className="form-label">{field.charAt(0).toUpperCase() + field.slice(1)}:</label>
                  <input
                    type={field === "password" ? "password" : field === "email" ? "email" : "text"}
                    className="form-control"
                    value={providerInfo[field]}
                    onChange={(e) =>
                      setProviderInfo({ ...providerInfo, [field]: e.target.value })
                    }
                  />
                </div>
              ))}
              <button
                className="btn btn-dark"
                onClick={async () => {
                  try {
                    const response = await fetch(`/api/providers/${userId}`, {
                      method: "PUT",
                      headers: {
                        "Content-Type": "application/json",
                      },
                      body: JSON.stringify(providerInfo),
                    });

                    if (!response.ok) throw new Error("Failed to update provider info");

                    setSuccess("Information updated successfully!");
                    setError("");
                  } catch (err) {
                    setError(err.message);
                  }
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
        style={{ marginLeft: sidebarCollapsed ? "80px" : "250px", transition: "margin-left 0.3s ease" }}
      >
        <header className="d-flex justify-content-between align-items-center p-4">
          <h1>Welcome, {providerInfo.name}</h1>
        </header>
        <main className="bg-light p-4">{renderMainContent()}</main>
      </div>

      {/* Add Food Modal */}
      <Modal show={showAddFoodModal} onHide={() => setShowAddFoodModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Add Food</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {error && <Alert variant="danger">{error}</Alert>}
          {["name", "ingredients", "quantity", "sortDate", "expiryDate"].map((field) => (
            <div key={field} className="mb-3">
              <label className="form-label">{field.charAt(0).toUpperCase() + field.slice(1)}:</label>
              <input
                type={field.includes("Date") ? "date" : field === "quantity" ? "number" : "text"}
                className="form-control"
                value={newFood[field]}
                onChange={(e) => setNewFood({ ...newFood, [field]: e.target.value })}
                placeholder={field.charAt(0).toUpperCase() + field.slice(1)}
                required
              />
            </div>
          ))}
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowAddFoodModal(false)}>
            Close
          </Button>
          <Button variant="success" onClick={handleAddFood}>
            Add Food
          </Button>
        </Modal.Footer>
      </Modal>

      {/* Edit Food Modal */}
      <Modal show={showEditFoodModal} onHide={() => setShowEditFoodModal(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Edit Food</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          {error && <Alert variant="danger">{error}</Alert>}
          {["name", "ingredients", "quantity", "sortDate", "expiryDate"].map((field) => (
            <div key={field} className="mb-3">
              <label className="form-label">{field.charAt(0).toUpperCase() + field.slice(1)}:</label>
              <input
                type={field.includes("Date") ? "date" : field === "quantity" ? "number" : "text"}
                className="form-control"
                value={editFood ? editFood[field] : ""}
                onChange={(e) => setEditFood({ ...editFood, [field]: e.target.value })}
              />
            </div>
          ))}
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={() => setShowEditFoodModal(false)}>
            Close
          </Button>
          <Button variant="primary" onClick={handleUpdate}>
            Update
          </Button>
        </Modal.Footer>
      </Modal>
    </div>
  );
};

export default ProviderDashboard;