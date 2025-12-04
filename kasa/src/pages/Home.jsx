import logo from '../logo.svg';
import '../App.css';
import Header from './composants/Header/Header';
import Click from './composants/Click/Click';
import Checkbox from './composants/Checkbox/CheckboxToggle';
import Select from './composants/Select/Select';
import Color from './composants/Color/Color';
import Ajouter from './composants/Ajouter/Ajouter';
import Commentaire from './composants/Commentaire/Commentaire';

function Home() {
  return (
    <div className="App">
      <Header />
      <body className="App-body">
        <img src={logo} className="App-logo" alt="logo" />
        {/* <Click /> */}
        {/* <Checkbox /> */}
        {/* <Select /> */}
        {/* <Color /> */}
        <Ajouter />
        {/* <Commentaire /> */} 
      </body>
    </div>
  );
}

export default Home
