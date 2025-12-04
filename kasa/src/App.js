import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import logo from './logo.svg';
import './App.css';
import Header from './composants/Header/Header';
import Click from './composants/Click/Click';
import Checkbox from './composants/Checkbox/CheckboxToggle';
import Select from './composants/Select/Select';
import Color from './composants/Color/Color';
import Ajouter from './composants/Ajouter/Ajouter';
import Todolist from './composants/todolist/Todolist';
import Commentaire from './composants/Commentaire/Commentaire';
import Comment from './composants/Commentaires/CommentList';
import Footer from './composants/Footer/Footer'

function App() {
  return (
    <>
<div className="App">
      <Header />
      <body className="App-body">
        <img src={logo} className="App-logo" alt="logo" />
        {/* <Click /> */}
        {/* <Checkbox /> */}
        {/* <Select /> */}
        {/* <Color /> */}
        <Ajouter />
        <Comment />
        {/*<Todolist />*/}
        {/* <Commentaire /> */} 
      </body>
      <Footer />
    </div>
    </>
    
  );
}

export default App;
