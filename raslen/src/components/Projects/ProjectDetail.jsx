import { useParams, useNavigate } from 'react-router-dom';
import { motion } from 'framer-motion';
import { useTheme } from '../../styles/theme';
import { useLanguage } from '../../styles/LanguageContext';
import { projects } from '../../utils/ProjectData';
import './ProjectDetail.css';

const ProjectDetail = () => {
  const { theme } = useTheme();
  const { language } = useLanguage();
  const { id } = useParams();
  const navigate = useNavigate();
  const project = projects.find(p => p.id === parseInt(id, 10));

  if (!project) {
    return (
      <div className={`project-not-found ${theme === 'dark' ? 'theme-dark' : 'theme-light'}`}>
        {language === 'fr' ? 'Projet non trouvé' : 'Project not found'}
      </div>
    );
  }

  const translations = {
    backButton: {
      en: "← Back to Projects",
      fr: "← Retour aux projets"
    },
    demo: {
      en: "Live Demo",
      fr: "Démo en direct"
    },
    code: {
      en: "View Code",
      fr: "Voir le code"
    }
  };

  const renderContent = (content, index) => {
    if (typeof content === 'string') {
      return <p key={index}>{content}</p>;
    }
    if (Array.isArray(content)) {
      return content.map((item, i) => <p key={`${index}-${i}`}>{item}</p>);
    }
    if (typeof content === 'object' && content !== null) {
      return (
        <motion.div 
          className="project-content-block"
          key={index}
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5, delay: index * 0.1 }}
        >
          {content.heading && <h2>{content.heading[language]}</h2>}
          {content.paragraphs?.[language]?.map((para, i) => (
            <p key={`${index}-p-${i}`}>{para}</p>
          ))}
          {content.code && (
            <pre>
              <code>{content.code}</code>
            </pre>
          )}
          {content.image && (
            <div className="project-content-image">
              <img 
                src={content.image} 
                alt={content.caption?.[language] || project.title[language]} 
              />
              {content.caption && (
                <p className="image-caption">{content.caption[language]}</p>
              )}
            </div>
          )}
        </motion.div>
      );
    }
    return null;
  };

  return (
    <section className={`project-detail-section ${theme === 'dark' ? 'theme-dark' : 'theme-light'}`}>
      <div className="project-detail-container">
        {/* Back Button */}
        <motion.button 
          className="project-back-button" 
          onClick={() => navigate('/projects')}
          initial={{ opacity: 0, x: -20 }}
          animate={{ opacity: 1, x: 0 }}
          transition={{ duration: 0.4 }}
          whileHover={{ x: -5 }}
          whileTap={{ scale: 0.95 }}
        >
          {translations.backButton[language]}
        </motion.button>

        <motion.article 
          className="project-detail-article"
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6 }}
        >
          <header className="project-detail-header">
            <motion.span 
              className="project-detail-category"
              initial={{ opacity: 0, scale: 0.8 }}
              animate={{ opacity: 1, scale: 1 }}
              transition={{ duration: 0.4, delay: 0.2 }}
            >
              {project.category[language]}
            </motion.span>
            <motion.h1 
              className="project-detail-title"
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ duration: 0.5, delay: 0.3 }}
            >
              {project.title[language]}
            </motion.h1>
            <motion.div 
              className="project-detail-meta"
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              transition={{ duration: 0.4, delay: 0.4 }}
            >
              <span className="project-detail-date">{project.date}</span>
            </motion.div>
            {project.image && (
              <motion.div 
                className="project-detail-image-container"
                initial={{ opacity: 0, scale: 0.95 }}
                animate={{ opacity: 1, scale: 1 }}
                transition={{ duration: 0.5, delay: 0.5 }}
              >
                <img 
                  src={project.image} 
                  alt={project.title[language]} 
                  className="project-detail-image" 
                />
              </motion.div>
            )}
          </header>

          <div className="project-detail-content">
            {project.content?.map((block, index) => renderContent(block, index))}
          </div>

          <div className="project-links">
            {project.github && (
              <motion.a
                href={project.github}
                target="_blank"
                rel="noopener noreferrer"
                className="project-link"
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
              >
                {translations.code[language]}
              </motion.a>
            )}
            {project.demo && (
              <motion.a
                href={project.demo}
                target="_blank"
                rel="noopener noreferrer"
                className="project-link demo"
                whileHover={{ scale: 1.05 }}
                whileTap={{ scale: 0.95 }}
              >
                {translations.demo[language]}
              </motion.a>
            )}
          </div>
        </motion.article>
      </div>
    </section>
  );
};

export default ProjectDetail;