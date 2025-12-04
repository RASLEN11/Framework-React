// src/App.js
import { BrowserRouter as Router } from 'react-router-dom';
import { ThemeProvider } from './styles/theme';
import { LanguageProvider } from './styles/LanguageContext';
import AppRoutes from './AppRoutes';
import './App.css';

function App() {
  return (
    <LanguageProvider>
      <ThemeProvider>
        <Router>
          <AppRoutes />
        </Router>
      </ThemeProvider>
    </LanguageProvider>
  );
}

export default App;