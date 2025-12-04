// src/utils/projectsData.js
export const projects = [
  {
    id: 1,
    title: {
      en: 'E-commerce Platform',
      fr: 'Plateforme e-commerce'
    },
    description: {
      en: 'A full-featured online store with payment integration',
      fr: 'Une boutique en ligne complète avec intégration de paiement'
    },
    category: {
      en: 'Web Development',
      fr: 'Développement Web'
    },
    date: 'March 2023',
    tags: ['react', 'node', 'mongodb'],
    featured: true,
    image: '/images/ecommerce-project.jpg',
    github: 'https://github.com/raslen11/ecommerce',
    demo: 'https://ecommerce.raslen11.com',
    content: [
      {
        heading: {
          en: 'Project Overview',
          fr: 'Aperçu du projet'
        },
        paragraphs: {
          en: [
            'Built a complete e-commerce solution with React frontend and Node.js backend.',
            'Implemented Stripe payment processing and user authentication.'
          ],
          fr: [
            'Construit une solution e-commerce complète avec frontend React et backend Node.js.',
            'Mis en place le traitement des paiements Stripe et l\'authentification des utilisateurs.'
          ]
        },
        code: `// Example product route
router.get('/products', async (req, res) => {
  try {
    const products = await Product.find();
    res.json(products);
  } catch (err) {
    res.status(500).json({ message: err.message });
  }
});`,
        image: '/images/ecommerce-screenshot.jpg',
        caption: {
          en: 'Product listing page',
          fr: 'Page de liste des produits'
        }
      }
    ]
  },
  {
    id: 2,
    title: {
      en: 'Task Management App',
      fr: 'Application de gestion de tâches'
    },
    description: {
      en: 'Collaborative task management with real-time updates',
      fr: 'Gestion collaborative des tâches avec mises à jour en temps réel'
    },
    category: {
      en: 'Mobile App',
      fr: 'Application Mobile'
    },
    date: 'June 2023',
    tags: ['react-native', 'firebase'],
    image: '/images/task-app.jpg',
    github: 'https://github.com/raslen11/task-app',
    demo: 'https://taskapp.raslen11.com',
    content: [
      {
        heading: {
          en: 'Key Features',
          fr: 'Fonctionnalités clés'
        },
        paragraphs: {
          en: [
            'Real-time synchronization across devices using Firebase.',
            'Drag-and-drop interface for task organization.'
          ],
          fr: [
            'Synchronisation en temps réel entre les appareils utilisant Firebase.',
            'Interface glisser-déposer pour l\'organisation des tâches.'
          ]
        }
      }
    ]
  },
  {
    id: 3,
    title: {
      en: 'Portfolio Website',
      fr: 'Site Web Portfolio'
    },
    description: {
      en: 'Modern responsive portfolio with dark/light theme',
      fr: 'Portfolio moderne et responsive avec thème sombre/clair'
    },
    category: {
      en: 'Web Design',
      fr: 'Design Web'
    },
    date: 'January 2024',
    tags: ['react', 'css', 'javascript'],
    image: '/images/portfolio-project.jpg',
    github: 'https://github.com/raslen11/portfolio',
    demo: 'https://raslen11.com',
    content: [
      {
        heading: {
          en: 'Design Features',
          fr: 'Fonctionnalités de design'
        },
        paragraphs: {
          en: [
            'Built with React and modern CSS features.',
            'Includes dark/light theme toggle and responsive design.'
          ],
          fr: [
            'Construit avec React et des fonctionnalités CSS modernes.',
            'Inclut un commutateur de thème sombre/clair et un design responsive.'
          ]
        }
      }
    ]
  }
];