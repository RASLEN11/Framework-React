import './Footer.css';
import logoFooter from '../../images/dictators.png';

function Footer({ children }) {


  return (
    <div>

      <main>{children}</main>
      <footer>
        <img src={logoFooter} alt="Kasa logo footer" className="logo-footer" />
        <p>© 2024 DICTATORS. Tous droits réservés.</p>
         <p>⚠️ Ce site est un projet DICTATORS TEAMS cree par <a href="https://www.instagram.com/raslen.11/" target="_blank" rel="noopener noreferrer" >
            <strong>RASLEN11</strong>
          </a>
        </p>
      </footer>
    </div>
  );
}
export default Footer;
