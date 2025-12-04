import React from 'react';
import 'font-awesome/css/font-awesome.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { BrowserRouter as Router } from 'react-router-dom';
import AppRoutes from './Router';
import './App.css';

function App() {
  return (
    <Router>
      <div className="app-container">
        <AppRoutes />
      </div>
    </Router>
  );
}

export default App;
