import React from 'react';
import Header from './components/Header';
import Profile from './components/Profile';
import SocialLinks from './components/SocialLinks';
import Footer from './components/Footer';
import { socialData } from './data/socialData';
import './styles/App.css';
import './styles/animations.css';

function App() {
  return (
    <div className="App">
      {/* Animated tennis balls and cats in background */}
      <div className="tennis-ball"></div>
      <div className="tennis-ball"></div>
      <div className="tennis-ball"></div>
      <div className="floating-cat"></div>
      <div className="floating-cat"></div>
      
      <div className="container">
        <div className="main-card">
          {/* Card Header */}
          <div className="card-header">
            <Header />
          </div>
          
          {/* Scrollable Content */}
          <div className="card-content">
            <Profile profile={socialData.profile} />
            <SocialLinks links={socialData.links} />
          </div>
          
          {/* Card Footer */}
          <div className="card-footer">
            <Footer />
          </div>
        </div>
      </div>
    </div>
  );
}

export default App;