import React, { useState , useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Modal } from 'react-bootstrap';
import { useContext } from 'react';
import { UserContext } from '../context/UserContext';
import axios from 'axios';

import {
    faTachometerAlt,
    faUtensils,
    faSignOutAlt,
    faBars,
    faUserCircle,
    faUsers,
    faBuilding,
    faEdit,
    faTrash,
} from '@fortawesome/free-solid-svg-icons';

const AdminDashboard = () => {
    const navigate = useNavigate();
    const [activeTab, setActiveTab] = useState('dashboard');
    const { setUserType, setUserId, setUserName , userId } = useContext(UserContext);
    const [sidebarCollapsed, setSidebarCollapsed] = useState(false);
    const [foodList, setFoodList] = useState([]);
    const [editingFood, setEditingFood] = useState(null);
    const [editingProvider, setEditingProvider] = useState(null);
    const [editingAssociation, setEditingAssociation] = useState(null);
    const [providers, setProviders] = useState([]);
    const [associations, setAssociations] = useState([]);

    useEffect(() => {
        if (activeTab === 'manageFood') {
            fetchFoods();
        }
        else if (activeTab === 'manageProviders'){
            fetchProviders();
        }
        else if (activeTab === 'manageAssociations'){
            fetchAssociations();
        }
    }, [activeTab]);

    const fetchFoods = async () => {
        try {
            const response = await axios.get("http://localhost:5000/admin/foods");
            setFoodList(response.data);
        } catch (error) {
            console.error("Error fetching foods:", error);
        }
    };

    const fetchProviders = async () => {
        try {
            const response = await axios.get("http://localhost:5000/admin/providers");
            setProviders(response.data);
        } catch (error) {
            console.error("Error fetching providers:", error);
        }
    };

    const fetchAssociations = async () => {
        try {
            const response = await axios.get("http://localhost:5000/admin/associations");
            setAssociations(response.data);
        } catch (error) {
            console.error("Error fetching association:", error);
        }
    };

    const handleAddFood = async (editingFood) => {
        try {
            const response = await axios.post("http://localhost:5000/admin/foods/add", {
                name: editingFood.name,
                quantity: editingFood.quantity,
                expiryDate: editingFood.expiryDate,
                foodStatus: editingFood.foodStatus,
                sortDate: editingFood.sortDate,
                providerId: userId,
            });
            if (response.status === 200) {
                // Refresh the food list after adding
                fetchFoods();
                setEditingFood(null);
            }
        } catch (error) {
            console.error("Error adding food :", error);
            alert("Failed to add food");
        }
    };

    const handleEditFood = async (editingFood) => {
        try {
            const response = await axios.put("http://localhost:5000/admin/foods/edit", {
                foodId: editingFood.food_id,
                name: editingFood.name,
                quantity: editingFood.quantity,
                expiryDate: editingFood.expiryDate,
                foodStatus: editingFood.foodStatus,
                sortDate: editingFood.sortDate,
            });
            if (response.status === 200) {
                fetchFoods();
                setEditingFood(null);
            }
        } catch (error) {
            console.error("Error editing food:", error);
            alert("Failed to update food");
        }
    };

    const handleDeleteFood = async (Foodid) => {
        if (window.confirm('Are you sure you want to delete this food item?')) {
            try {
                await axios.post('http://localhost:5000/admin/foods/delete', { Foodid });
                setFoodList(foodList.filter(food => food.food_id !== Foodid));
            }
            catch (error) {
                console.error('Failed to delete food:', error);
                alert('Something went wrong while deleting the food item.');
            }
        }
    };

    const handleAddProvider = async (newProvider) => {
        try {
            const response = await axios.post('http://localhost:5000/admin/providers/add', {
                name: newProvider.name,
                email: newProvider.email,
                password: newProvider.password,
                role: 'provider',
                address: newProvider.address,
                phone: newProvider.phone,
            });
            if (response.data && response.data.provider) {
                setProviders(prev => [...prev, response.data.provider]);
            }
            setEditingProvider(null);
        } catch (error) {
            console.error('Failed to add provider:', error);
            alert('Error adding provider');
        }
    };

    const handleEditProvider = async (editingProvider) => {
        try {
            const response = await axios.put("http://localhost:5000/admin/providers/edit", {
                userId: editingProvider.user_id,
                name: editingProvider.name,
                email: editingProvider.email,
                password: editingProvider.password,
                address: editingProvider.address,
                phone: editingProvider.phone,
            });
            if (response.status === 200) {
                fetchProviders();
                setEditingProvider(null);
            }
        } catch (error) {
            console.error("Error editing provider:", error);
            alert("Failed to update provider");
        }
    };

    const handleDeleteProvider = async (userId) => {
        if (window.confirm('Are you sure you want to delete this provider?')) {
            try {
                await axios.post('http://localhost:5000/admin/providers/delete', { userId });
                setProviders(providers.filter(provider => provider.user_id !== userId));
            } catch (error) {
                console.error('Failed to delete provider:', error);
                alert('Something went wrong while deleting the provider.');
            }
        }
    };

    const handleAddAssociation = async (newAssociation) => {
        try {
            const response = await axios.post('http://localhost:5000/admin/associations/add', {
                name: newAssociation.name,
                email: newAssociation.email,
                password: newAssociation.password,
                role: 'association',
                address: newAssociation.address,
                phone: newAssociation.phone,
            });
            if (response.data && response.data.association) {
                setAssociations(prev => [...prev, response.data.association]);
            }
            setEditingAssociation(null);
        } catch (error) {
            console.error('Failed to add association:', error);
            alert('Error adding association');
        }
    };

    const handleEditAssociation = async (updatedAssociation) => {
        try {
            const response = await axios.put("http://localhost:5000/admin/associations/edit", {
                userId: updatedAssociation.user_id,
                name: updatedAssociation.name,
                email: updatedAssociation.email,
                password: updatedAssociation.password,
                address: updatedAssociation.address,
                phone: updatedAssociation.phone,
            });
            if (response.status === 200) {
                fetchAssociations();
                setEditingAssociation(null);
            }
        } catch (error) {
            console.error("Error editing association:", error);
            alert("Failed to update associations");
        }
    };

    const handleDeleteAssociation = async (userId) => {
        if (window.confirm('Are you sure you want to delete this association?')) {
            try {
            await axios.post('http://localhost:5000/admin/associations/delete', { userId }); // Send provider ID
            setAssociations(associations.filter(association => association.user_id !== userId)); // Update UI after deletion
        } catch (error) {
            console.error('Failed to delete association:', error);
            alert('Something went wrong while deleting the association.');
        }
        }
    };

    const handleLogout = () => {
        setUserType(null); // Clear The User Type
        setUserId(null);
        setUserName(null);
        navigate("/"); // Redirect To Homepage
    };

    const formatDate = (date) => {
        if (!date) return "";
        const formattedDate = new Date(date);
        const year = formattedDate.getFullYear();
        const month = String(formattedDate.getMonth() + 1).padStart(2, "0");
        const day = String(formattedDate.getDate()).padStart(2, "0");
        return `${year}-${month}-${day}`;
    };

    return (
        <div className="d-flex bg-light">
            {/* Sidebar */}
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
                }}>
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
                            {!sidebarCollapsed && <span className="text-light">Admin Panel</span>}
                        </li>
                        <li className="nav-item">
                            <button
                                className={`nav-link text-white ${activeTab === 'dashboard' ? 'active' : ''}`}
                                onClick={() => setActiveTab('dashboard')}
                            >
                                <FontAwesomeIcon icon={faTachometerAlt} />
                                {!sidebarCollapsed && ' Dashboard'}
                            </button>
                        </li>
                        <li className="nav-item">
                            <button
                                className={`nav-link text-white ${activeTab === 'manageFood' ? 'active' : ''}`}
                                onClick={() => setActiveTab('manageFood')}
                            >
                                <FontAwesomeIcon icon={faUtensils} />
                                {!sidebarCollapsed && ' Manage Food'}
                            </button>
                        </li>
                        <li className="nav-item">
                            <button
                                className={`nav-link text-white ${activeTab === 'manageProviders' ? 'active' : ''}`}
                                onClick={() => setActiveTab('manageProviders')}
                            >
                                <FontAwesomeIcon icon={faUsers} />
                                {!sidebarCollapsed && ' Manage Providers'}
                            </button>
                        </li>
                        <li className="nav-item">
                            <button
                                className={`nav-link text-white ${activeTab === 'manageAssociations' ? 'active' : ''}`}
                                onClick={() => setActiveTab('manageAssociations')}
                            >
                                <FontAwesomeIcon icon={faBuilding} />
                                {!sidebarCollapsed && ' Manage Associations'}
                            </button>
                        </li>
                    </ul>
                </div>

                <div>
                    <button className="nav-link text-white" onClick={handleLogout}>
                        <FontAwesomeIcon icon={faSignOutAlt} />
                        {!sidebarCollapsed && ' Logout'}
                    </button>
                </div>
            </nav>

            {/* Main Content Area */}
            <div className="container-fluid" style={{ marginLeft: sidebarCollapsed ? '80px' : '250px', transition: 'margin-left 0.3s ease' }}>
                <header className="d-flex justify-content-between align-items-center p-4">
                    <h1>Admin Dashboard</h1>
                </header>

                <main className="bg-light p-4">
                {activeTab === 'dashboard' && (
                    <div className="dashboard">
                        <h1>Dashboard</h1>
                        <p>Welcome to the admin dashboard. Use the sidebar to navigate through different sections.</p>
                        {/* Summary Cards */}
                        <div className="row mb-4">
                            <div className="col-md-4">
                                <div className="card text-white bg-primary mb-3">
                                    <div className="card-header">Total Food Items</div>
                                    <div className="card-body">
                                        <h5 className="card-title">{foodList.length}</h5>
                                        <p className="card-text">Total number of food items in the system.</p>
                                    </div>
                                </div>
                            </div>
                            <div className="col-md-4">
                                <div className="card text-white bg-success mb-3">
                                    <div className="card-header">Active Providers</div>
                                    <div className="card-body">
                                        <h5 className="card-title">{providers.length}</h5>
                                        <p className="card-text">Total number of active providers.</p>
                                        </div>
                                    </div>
                                </div>
                            <div className="col-md-4">
                                <div className="card text-white bg-warning mb-3">
                                    <div className="card-header">Active Associations</div>
                                    <div className="card-body">
                                        <h5 className="card-title">{associations.length}</h5>
                                        <p className="card-text">Total number of active associations.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/* Recent Activities or Charts */}
                    <div className="row">
                        <div className="col-md-6">
                            <div className="card">
                                <div className="card-header">
                                    Recent Food Items
                                </div>
                                <div className="card-body">
                                    <table className="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Expiry Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {foodList.slice(-5).map((food) => (
                                                <tr key={food._id}>
                                                    <td>{food.name}</td>
                                                    <td>{food.status}</td>
                                                    <td>{food.expiryDate}</td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6">
                            <div className="card">
                                <div className="card-header">
                                    Food Status Overview
                                </div>
                                <div className="card-body">
                                    <div className="d-flex justify-content-between">
                                        <div>
                                            <h6>Fresh</h6>
                                            <p>{foodList.filter(food => food.foodStatus === 'Fresh').length}</p>
                                        </div>
                                        <div>
                                            <h6>Expired</h6>
                                            <p>{foodList.filter(food => food.foodStatus === 'Expired').length}</p>
                                        </div>
                                    </div>
                                    {/* You can add a chart here using a library like Chart.js or Recharts */}
                                    <div style={{ height: '200px', backgroundColor: '#f8f9fa', borderRadius: '5px' }}>
                                        {/* Placeholder for a chart */}
                                        <p className="text-center pt-5">Chart Placeholder</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                )}

                {activeTab === 'manageFood' && (
                    <div className="food-management">
                        <h1>Manage Food</h1>
                        <br/>
                        <button className="btn btn-primary mb-3" onClick={() => setEditingFood({})}>Add Food</button>
                        <table className="table table-bordered">
                            <thead>                   
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Sort Date</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foodList.map((item) => (
                                    <tr key={item.food_id}>
                                        <td>{item.name}</td>
                                        <td>{item.quantity}</td>
                                        <td>{formatDate(item.sort_date)}</td>
                                        <td>{formatDate(item.expiry_date)}</td>
                                        <td>{item.food_status}</td>
                                        <td>
                                            <button className="btn btn-warning me-2" onClick={() => setEditingFood(item)}>
                                                <FontAwesomeIcon icon={faEdit} />
                                            </button>
                                            <button className="btn btn-danger" onClick={() => handleDeleteFood(item.food_id)}>
                                                <FontAwesomeIcon icon={faTrash} />
                                            </button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                
                        <Modal show={editingFood !== null} onHide={() => setEditingFood(null)}>                   
                            <Modal.Header closeButton>
                                <Modal.Title>{editingFood?.food_id ? 'Edit Food' : 'Add Food'}</Modal.Title>
                            </Modal.Header>
                            <Modal.Body>
                                <form onSubmit={(e) => {
                                    e.preventDefault();
                                    editingFood.food_id ? handleEditFood(editingFood) : handleAddFood(editingFood);
                                }}>
                                    <div className="mb-3">
                                        <label className="form-label">Name</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            value={editingFood?.name || ''}
                                            onChange={(e) => setEditingFood({ ...editingFood, name: e.target.value })}
                                        />
                                    </div>
                                    <div className="mb-3">
                                        <label className="form-label">Quantity</label>
                                        <input
                                            type="number"
                                            className="form-control"
                                            value={editingFood?.quantity || ''}
                                            onChange={(e) => setEditingFood({ ...editingFood, quantity: e.target.value })}
                                        />
                                    </div>
                                    <div className="mb-3">
                                        <label className="form-label">Sort Date</label>
                                        <input
                                            type="date"
                                            className="form-control"
                                            value={editingFood?.sortDate || ''}
                                            onChange={(e) => setEditingFood({ ...editingFood, sortDate: e.target.value })}
                                        />
                                    </div>
                                    <div className="mb-3">
                                        <label className="form-label">Expiry Date</label>
                                        <input
                                            type="date"
                                            className="form-control"
                                            value={editingFood?.expiryDate || ''}
                                            onChange={(e) => setEditingFood({ ...editingFood, expiryDate: e.target.value })}
                                        />
                                    </div>
                                    <div className="mb-3">
                                        <label className="form-label">Status</label>
                                        <select
                                        className="form-control"
                                        value={editingFood?.foodStatus}
                                        onChange={(e) => setEditingFood({ ...editingFood, foodStatus: e.target.value.toLowerCase() })}
                                        >
                                            <option>-- Select The Food Status --</option>
                                            <option value="fresh">Fresh</option>
                                            <option value="expired">Expired</option>
                                        </select>
                                    </div>
                
                                    <button type="submit" className="btn btn-primary">Save</button>
                                    <button type="button" className="btn btn-secondary ms-2" onClick={() => setEditingFood(null)}>Cancel</button>
                                </form>
                            </Modal.Body>
                        </Modal>
                    </div>
                )}


                    {activeTab === 'manageProviders' && (
                        <div className="providers-management">
                            <h1>Manage Providers</h1>
                            <br/>
                            <button className="btn btn-primary mb-3" onClick={() => setEditingProvider({})}>Add Provider</button>
                            <table className="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {providers.map((provider) => (
                                        <tr key={provider.user_id}>
                                            <td>{provider.name}</td>
                                            <td>{provider.phone}</td>
                                            <td>{provider.address}</td>
                                            <td>
                                                <button className="btn btn-warning me-2" onClick={() => setEditingProvider(provider)}>
                                                    <FontAwesomeIcon icon={faEdit} />
                                                </button>
                                                <button className="btn btn-danger" onClick={() => handleDeleteProvider(provider.user_id)}>
                                                    <FontAwesomeIcon icon={faTrash} />
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>

                            {/* Provider Modal */}
                            <Modal show={editingProvider !== null} onHide={() => setEditingProvider(null)}>
                                <Modal.Header closeButton>
                                    <Modal.Title>{editingProvider?.user_id ? 'Edit Provider' : 'Add Provider'}</Modal.Title>
                                </Modal.Header>
                                <Modal.Body>
                                    <form onSubmit={(e) => {
                                        e.preventDefault();
                                        editingProvider.user_id ? handleEditProvider(editingProvider) : handleAddProvider(editingProvider);
                                    }}>
                                        <div className="mb-3">
                                            <label className="form-label">Name</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                value={editingProvider?.name || ''}
                                                onChange={(e) => setEditingProvider({ ...editingProvider, name: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Email</label>
                                            <input
                                                type="email"
                                                className="form-control"
                                                value={editingProvider?.email || ''}
                                                onChange={(e) => setEditingProvider({ ...editingProvider, email: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Password</label>
                                            <input
                                                type="password"
                                                className="form-control"
                                                value={editingProvider?.password || ''}
                                                onChange={(e) => setEditingProvider({ ...editingProvider, password: e.target.value })}
                                                required={!editingProvider?.user_id}
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Contact</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                value={editingProvider?.phone || ''}
                                                onChange={(e) => setEditingProvider({ ...editingProvider, phone: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Address</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                value={editingProvider?.address || ''}
                                                onChange={(e) => setEditingProvider({ ...editingProvider, address: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <button type="submit" className="btn btn-primary">Save</button>
                                        <button type="button" className="btn btn-secondary ms-2" onClick={() => setEditingProvider(null)}>Cancel</button>
                                    </form>
                                </Modal.Body>
                            </Modal>
                        </div>
                    )}

                    {activeTab === 'manageAssociations' && (
                        <div className="associations-management">
                            <h1>Manage Associations</h1>
                            <br />
                            <button className="btn btn-primary mb-3" onClick={() => setEditingAssociation({})}>
                                Add Association
                            </button>
                            <table className="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {associations.map((association) => (
                                        <tr key={association.user_id}>
                                            <td>{association.name}</td>
                                            <td>{association.phone}</td>
                                            <td>{association.address}</td>
                                            <td>
                                                <button className="btn btn-warning me-2" onClick={() => setEditingAssociation(association)}>
                                                    <FontAwesomeIcon icon={faEdit} />
                                                </button>
                                                <button className="btn btn-danger" onClick={() => handleDeleteAssociation(association.user_id)}>
                                                    <FontAwesomeIcon icon={faTrash} />
                                                </button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>         
                            {/* Association Modal */}
                            <Modal show={editingAssociation !== null} onHide={() => setEditingAssociation(null)}>
                                <Modal.Header closeButton>
                                    <Modal.Title>{editingAssociation?.user_id ? 'Edit Association' : 'Add Association'}</Modal.Title>
                                </Modal.Header>
                                <Modal.Body>
                                    <form onSubmit={(e) => {
                                        e.preventDefault();
                                        editingAssociation.user_id ? handleEditAssociation(editingAssociation) : handleAddAssociation(editingAssociation);
                                        }}>
                                        <div className="mb-3">
                                            <label className="form-label">Name</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                value={editingAssociation?.name || ''}
                                                onChange={(e) => setEditingAssociation({ ...editingAssociation, name: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Email</label>
                                            <input
                                                type="email"
                                                className="form-control"
                                                value={editingAssociation?.email || ''}
                                                onChange={(e) => setEditingAssociation({ ...editingAssociation, email: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Password</label>
                                            <input
                                                type="password"
                                                className="form-control"
                                                value={editingAssociation?.password || ''}
                                                onChange={(e) => setEditingAssociation({ ...editingAssociation, password: e.target.value })}
                                                required={!editingAssociation?.user_id}
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Contact</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                value={editingAssociation?.phone || ''}
                                                onChange={(e) => setEditingAssociation({ ...editingAssociation, phone: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <div className="mb-3">
                                            <label className="form-label">Address</label>
                                            <input
                                                type="text"
                                                className="form-control"
                                                value={editingAssociation?.address || ''}
                                                onChange={(e) => setEditingAssociation({ ...editingAssociation, address: e.target.value })}
                                                required
                                            />
                                        </div>
                                        <button type="submit" className="btn btn-primary">Save</button>
                                        <button type="button" className="btn btn-secondary ms-2" onClick={() => setEditingAssociation(null)}>Cancel</button>
                                    </form>
                    
                                </Modal.Body>
                            </Modal>
                        </div>
                    )}
                </main>
            </div>
        </div>
    );
};

export default AdminDashboard;