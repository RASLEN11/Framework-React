import React, { useContext } from 'react';
import { UserContext } from './context/UserContext.jsx';
import { Route, Routes, Navigate } from 'react-router-dom';
import Error from './pages/Error';
import Home from './pages/Home';
import Volunteer from './pages/Volunteer';
import Involved from './pages/involved';
import Donate from './pages/Donate';
import About from './pages/About';
import Contact from './pages/Contact';
import Dashboard from './pages/Dashboard';
import Register from './auth_backend/Register.jsx';
import SignIn from './auth_backend/SignIn.jsx';
import Provider from './Dashboard/ProviderDashboard';
import Association from './Dashboard/AssociationDashboard';
import Admin from './Dashboard/AdminDashboard';

function AppRoutes(){
  const { userType } = useContext(UserContext);
  if (userType === "admin") {
    return (
    <>
      <Routes>
        <Route path="/*" element={<Error />} />
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/donate" element={<Donate />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/volunteer" element={<Volunteer />} />
        <Route path="/involved" element={<Involved />} />
        <Route path="/register" element={<Register />} />
        <Route path="/signin" element={<Navigate to="/admin" />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/provider" element={<Provider />} />
        <Route path="/association" element={<Association />} />
        <Route path="/admin" element={<Admin />} />
      </Routes>
    </>
  );
} else if (userType === "provider") {
  return (
    <>
      <Routes>
        <Route path="/*" element={<Error />} />
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/donate" element={<Donate />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/volunteer" element={<Volunteer />} />
        <Route path="/register" element={<Register />} />
        <Route path="/signin" element={<Navigate to="/provider" />} />
        <Route path="/involved" element={<Involved />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/provider" element={<Provider />} />
      </Routes>
    </>
  );

} else if (userType === "association"){
  return (
    <>
      <Routes>
        <Route path="/*" element={<Error />} />
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/donate" element={<Donate />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/volunteer" element={<Volunteer />} />
        <Route path="/register" element={<Register />} />
        <Route path="/signin" element={<Navigate to="/association" />} />
        <Route path="/involved" element={<Involved />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/association" element={<Provider />} />
      </Routes>
    </>
  );
} else {
  return(
  <>
      <Routes>
        <Route path="/*" element={<Error />} />
        <Route path="/" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/donate" element={<Donate />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/register" element={<Register />} />
        <Route path="/signin" element={<SignIn />} />
        <Route path="/volunteer" element={<Volunteer />} />
        <Route path="/involved" element={<Involved />} />
        <Route path="/dashboard" element={<Dashboard />} />
      </Routes>
  </>
  );
}
};

export default AppRoutes;