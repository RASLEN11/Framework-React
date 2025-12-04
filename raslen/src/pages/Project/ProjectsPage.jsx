import { useEffect, useState } from 'react';
import { motion } from 'framer-motion';
import { useTheme } from '../../styles/theme';
import { useLanguage } from '../../styles/LanguageContext';
import { projects } from '../../utils/ProjectData';
import { useParams, useNavigate } from 'react-router-dom';
import './ProjectsPage.css';

const ProjectsPage = ({ isHomepage = false }) => {
  const { theme } = useTheme();
  const { language } = useLanguage();
  const { id } = useParams();
  const navigate = useNavigate();
  const [selectedProject, setSelectedProject] = useState(null);
  const displayedProjects = isHomepage ? projects.slice(0, 3) : projects;

  const translations = {
    backButton: {
      en: "← Back to Projects",
      fr: "← Retour aux projets"
    },
    title: {
      en: "Featured ",
      fr: "Projets "
    },
    highlight: {
      en: "Projects",
      fr: "mis en avant"
    },
    viewDetails: {
      en: "View Details →",
      fr: "Voir détails →"
    },
    viewAll: {
      en: "View All Projects",
      fr: "Voir tous les projets"
    },
    demo: {
      en: "Live Demo",
      fr: "Démo en direct"
    },
    code: {
      en: "View Code",
      fr: "Voir le code"
    },
    defaultContent: {
      en: "This is the detailed content for",
      fr: "Voici le contenu détaillé pour"
    }
  };

  useEffect(() => {
    if (id) {
      const project = projects.find(p => p.id === parseInt(id, 10));
      setSelectedProject(project || null);
    } else {
      setSelectedProject(null);
    }
  }, [id]);

  const handleBackToList = () => {
    setSelectedProject(null);
    navigate('/projects');
  };

  const renderContent = (content) => {
    if (typeof content === 'string') {
      return <p>{content}</p>;
    }

    if (Array.isArray(content)) {
      return content.map((item, index) => (
        <p key={`para-${index}`}>{item}</p>
      ));
    }

    if (typeof content === 'object' && content !== null) {
      return (
        <div className={`project-structured-content theme-${theme}`}>
          {content.heading && <h3>{content.heading}</h3>}
          {content.paragraphs?.map((para, index) => (
            <p key={`p-${index}`}>{para}</p>
          ))}
          {content.image && (
            <div className="project-content-image-container">
              <img
                src={content.image}
                alt={content.caption || 'Project content illustration'}
              />
              {content.caption && (
                <p className="image-caption">{content.caption}</p>
              )}
            </div>
          )}
        </div>
      );
    }

    return null;
  };

  if (selectedProject) {
    return (
      <section
        className={`projects-section ${theme === 'dark' ? 'theme-dark' : 'theme-light'} ${isHomepage ? 'projects-section-home' : ''}`}
        id="projects"
      >
        <div className="projects-container">
          <motion.button
            onClick={handleBackToList}
            className="project-back-button"
            whileHover={{ x: -5 }}
            whileTap={{ scale: 0.95 }}
          >
            {translations.backButton[language]}
          </motion.button>

          <article className="project-detail-article">
            <header className="project-detail-header">
              <span className="project-category">{selectedProject.category[language]}</span>
              <h1 className="project-title">{selectedProject.title[language]}</h1>
              <div className="project-card-footer">
                <span className="project-date">{selectedProject.date}</span>
              </div>
              {selectedProject.image && (
                <div className="project-card-image-container">
                  <img
                    src={selectedProject.image}
                    alt={selectedProject.title[language] || 'Project'}
                    className="project-card-image"
                  />
                </div>
              )}
            </header>

            <div className="project-description">
              {selectedProject.content?.[language]
                ? selectedProject.content[language].map((block, i) => (
                    <div key={i}>{renderContent(block)}</div>
                  ))
                : <p>{translations.defaultContent[language]} {selectedProject.title[language]}</p>
              }
            </div>

            <div className="project-links">
              {selectedProject.github && (
                <motion.a
                  href={selectedProject.github}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="project-link"
                  whileHover={{ scale: 1.05 }}
                  whileTap={{ scale: 0.95 }}
                >
                  {translations.code[language]}
                </motion.a>
              )}
              {selectedProject.demo && (
                <motion.a
                  href={selectedProject.demo}
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
          </article>
        </div>
      </section>
    );
  }

  return (
    <section
      className={`projects-section ${theme === 'dark' ? 'theme-dark' : 'theme-light'} ${isHomepage ? 'projects-section-home' : ''}`}
      id="projects"
    >
      <div className="projects-container">
        {!isHomepage && (
          <motion.h2
            className="projects-title"
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{
              duration: 0.6,
              type: "spring",
              stiffness: 100,
              damping: 10
            }}
          >
            {translations.title[language]}{' '}
            <span className="projects-title-highlight">
              {translations.highlight[language]}
            </span>
          </motion.h2>
        )}

        <div className={`projects-grid ${isHomepage ? 'projects-grid-home' : 'projects-grid-full'}`}>
          {displayedProjects.map((project, index) => (
            <motion.article
              key={project.id}
              initial={{ opacity: 0, y: 30, scale: 0.98 }}
              whileInView={{
                opacity: 1,
                y: 0,
                scale: 1
              }}
              transition={{
                duration: 0.5,
                delay: index * 0.15,
                type: "spring",
                stiffness: 120,
                damping: 12
              }}
              viewport={{ once: true, margin: "0px 0px -100px 0px" }}
              whileHover={{
                y: -5,
                transition: { duration: 0.2 }
              }}
              className="project-card-wrapper"
            >
              <div
                className="project-card"
                onClick={() => navigate(`/projects/${project.id}`)}
              >
                {project.image && (
                  <div className="project-card-image-container">
                    <img
                      src={project.image}
                      alt={project.title[language] || 'Project'}
                      className="project-card-image"
                    />
                  </div>
                )}
                <div className="project-card-content">
                  <div className="project-card-header">
                    <span className="project-category">{project.category[language]}</span>
                    <span className="project-date">{project.date}</span>
                  </div>
                  <h3 className="project-title">{project.title[language]}</h3>
                  <p className="project-description">
                    {project.description[language]}
                  </p>
                  <div className="project-card-footer">
                    <motion.button
                      className="project-view-details"
                      onClick={(e) => {
                        e.stopPropagation();
                        navigate(`/projects/${project.id}`);
                      }}
                      whileHover={{ x: 5 }}
                      whileTap={{ scale: 0.95 }}
                    >
                      {translations.viewDetails[language]}
                    </motion.button>
                  </div>
                </div>
              </div>
            </motion.article>
          ))}
        </div>

        {isHomepage && projects.length > 3 && (
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            whileInView={{
              opacity: 1,
              y: 0,
              transition: {
                duration: 0.6,
                delay: 0.4
              }
            }}
            viewport={{ once: true }}
            className="projects-view-all"
          >
            <motion.div
              whileHover={{ scale: 1.05 }}
              whileTap={{ scale: 0.95 }}
            >
              <button
                className="projects-view-all-button"
                onClick={() => navigate('/projects')}
              >
                {translations.viewAll[language]}
              </button>
            </motion.div>
          </motion.div>
        )}
      </div>
    </section>
  );
};

export default ProjectsPage;