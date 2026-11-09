<?php

/*
|--------------------------------------------------------------------------
| Contenido del portafolio
|--------------------------------------------------------------------------
|
| Todo el contenido de la página vive acá. Los textos están escritos como
| claves de traducción (inglés) y se traducen al renderizar, nunca al cargar
| la configuración: en ese momento todavía no se resolvió el idioma.
|
*/

return [
    'name' => 'Lizandro Britto',
    'role' => 'Full Stack Developer',

    // Ruta dentro de public/. La usan el carnet del hero y Sobre mí; si el
    // archivo no existe se muestra un avatar genérico.
    'photo' => 'assets/about/lizandro.webp',

    'socials' => [
        'github' => 'https://github.com/LizandroGBritto',
        'linkedin' => 'https://www.linkedin.com/in/lizandro-britto',
        'email' => 'brittolizandro@gmail.com',
    ],

    'navigation' => [
        ['id' => 'hero-section', 'label' => 'Home'],
        ['id' => 'projects', 'label' => 'Projects'],
        ['id' => 'skills', 'label' => 'Skills'],
        ['id' => 'about', 'label' => 'About'],
        ['id' => 'contact', 'label' => 'Contact'],
    ],

    'hero' => [
        'description' => 'Passionate about creating digital solutions with unique and functional designs',
        'status' => 'Working at Porta Web Agency',
    ],

    // Dorso del carnet: [tecnología, rubro]
    'carnet_skills' => [
        ['Laravel', 'backend'],
        ['Livewire', 'backend'],
        ['Tailwind CSS', 'frontend'],
        ['React · Node.js', 'full stack'],
        ['MySQL', 'data'],
    ],

    'about' => [
        'bio' => 'Software developer with experience building modern, scalable web applications. I specialize in the Laravel, PHP and JavaScript stack and modern frameworks.',
    ],

    'contact' => [
        'email' => 'brittolizandro@gmail.com',
        'location' => 'Paraguay',
        'github_url' => 'https://github.com/LizandroGBritto',
        'github_handle' => '@LizandroGBritto',
        'linkedin_url' => 'https://www.linkedin.com/in/lizandro-britto',
        'linkedin_handle' => 'lizandro-britto',
    ],

    /*
    | Tecnologías que giran alrededor del robot.
    |
    | - category: rubro, se traduce.
    | - match: fragmentos (en minúscula) que se buscan en las etiquetas de
    |   cada proyecto para saber dónde se usó. Sin coincidencias, el panel
    |   dice que no hay proyecto asociado; nunca se inventa uso.
    | - uses: proyectos a mano, para lo que las etiquetas no cubren.
    */
    'technologies' => [
        ['name' => 'Laravel', 'category' => 'Backend', 'match' => ['laravel']],
        ['name' => 'PHP', 'category' => 'Backend', 'match' => ['php']],
        ['name' => 'Livewire', 'category' => 'Backend', 'match' => [], 'uses' => ['This portfolio']],
        ['name' => 'JavaScript', 'category' => 'Frontend', 'match' => ['javascript']],
        ['name' => 'React', 'category' => 'Frontend', 'match' => ['react']],
        ['name' => 'Node.js', 'category' => 'Backend', 'match' => ['node']],
        ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'match' => ['tailwind']],
        ['name' => 'MySQL', 'category' => 'Backend', 'match' => ['mysql']],
        ['name' => 'Docker', 'category' => 'Tools', 'match' => []],
        ['name' => 'Git', 'category' => 'Tools', 'match' => ['git']],
    ],

    /*
    | Proyectos de la baraja, en orden.
    |
    | - slug: identificador estable (no se traduce) para el registro de interacciones.
    | - image: ruta dentro de public/ (WebP, ver `npm run imagenes`).
    | - mobile: captura en celular; si existe, la card ofrece alternar entre notebook y celular.
    |   Sin `mobile` la captura va sola en un notebook; esos proyectos van al final.
    | - views: otras vistas del proyecto para el modal de detalles (label, image 960 px y, si existe, mobile 390 px).
    |   La vista de inicio sale de image/mobile y no se repite acá.
    | - main_label: nombre de la captura principal en el modal (por defecto «Home»).
    | - highlights: puntos clave del modal; salen de la descripción, sin inventar alcance.
    | - placeholder: etiqueta que se muestra cuando todavía no hay captura.
    */
    'projects' => [
        [
            'badge' => 'Freelance Project',
            'title' => 'Alonzo Style',
            'slug' => 'alonzo-style',
            'views' => [
                [
                    'label' => 'Agenda',
                    'image' => 'assets/projects/alonzo-style-agenda-desktop.webp',
                    'mobile' => 'assets/projects/alonzo-style-agenda-mobile.webp',
                ],
            ],
            'highlights' => [
                'Appointment agenda for clients',
                'Push notifications to barbers',
                'Automated WhatsApp confirmation, rescheduling, and cancellation',
                'Management of customers, services, and barbers',
            ],
            'description' => 'Customer, appointment, service, and barber management system with a scheduling agenda for clients. It sends push notifications to barbers and enables automated WhatsApp contact for appointment confirmation, rescheduling, or cancellation, automating virtually all management tasks.',
            'tech' => ['MongoDB', 'Express', 'React.js', 'Node.js', 'Flowbite', 'Tailwind', 'JWT', 'Git/GitHub'],
            'demo' => 'http://alonzostyle.com/',
            'image' => 'assets/projects/alonzo-style-desktop.webp',
            'mobile' => 'assets/projects/alonzo-style-mobile.webp',
        ],
        [
            'badge' => 'Institutional',
            'title' => 'Amalia Acosta',
            'slug' => 'amalia-acosta',
            'views' => [
                [
                    'label' => 'Projects',
                    'image' => 'assets/projects/amalia-acosta-proyectos-desktop.webp',
                    'mobile' => 'assets/projects/amalia-acosta-proyectos-mobile.webp',
                ],
                [
                    'label' => 'Services',
                    'image' => 'assets/projects/amalia-acosta-servicios-desktop.webp',
                    'mobile' => 'assets/projects/amalia-acosta-servicios-mobile.webp',
                ],
            ],
            'highlights' => [
                'High-traffic institutional platform',
                'Specialized multilingual support',
                'Professional content management',
                'Meta and Google marketing analytics',
            ],
            'description' => 'Development and optimization of high-traffic institutional platforms, featuring specialized multilingual support, professional content management solutions, and integrated Meta and Google marketing analytics.',
            'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
            'demo' => 'https://amaliaacosta.com/',
            'image' => 'assets/projects/amalia-acosta-desktop.webp',
            'mobile' => 'assets/projects/amalia-acosta-mobile.webp',
        ],
        [
            'badge' => 'Web Catalogs',
            'title' => 'Científica Ragusa',
            'slug' => 'cientifica-ragusa',
            'main_label' => 'Catalog',
            'views' => [
                [
                    'label' => 'Home',
                    'image' => 'assets/projects/cientifica-ragusa-inicio-desktop.webp',
                    'mobile' => 'assets/projects/cientifica-ragusa-inicio-mobile.webp',
                ],
                [
                    'label' => 'Product sheet',
                    'image' => 'assets/projects/cientifica-ragusa-ficha-desktop.webp',
                    'mobile' => 'assets/projects/cientifica-ragusa-ficha-mobile.webp',
                ],
            ],
            'highlights' => [
                'High-concurrency catalog with advanced caching',
                'Real-time product and stock synchronization through external APIs',
                'Specialized multilingual support and integrated logistics',
                'Meta and Google analytics',
            ],
            'description' => 'Development of high-concurrency web catalogs designed for maximum performance and scalability with advanced caching. Features real-time product and stock synchronization via external API integrations, specialized multilingual support, and integrated logistics, powered by Meta and Google analytics.',
            'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
            'demo' => 'https://www.cientificaragusa.com/catalogo',
            'image' => 'assets/projects/cientifica-ragusa-desktop.webp',
            'mobile' => 'assets/projects/cientifica-ragusa-mobile.webp',
        ],
        [
            'badge' => 'E-commerce',
            'title' => 'Ramirez Ramirez',
            'slug' => 'ramirez-ramirez',
            'views' => [
                [
                    'label' => 'Catalog',
                    'image' => 'assets/projects/ramirez-ramirez-catalogo-desktop.webp',
                    'mobile' => 'assets/projects/ramirez-ramirez-catalogo-mobile.webp',
                ],
                [
                    'label' => 'Product sheet',
                    'image' => 'assets/projects/ramirez-ramirez-producto-desktop.webp',
                    'mobile' => 'assets/projects/ramirez-ramirez-producto-mobile.webp',
                ],
            ],
            'highlights' => [
                'Advanced caching and specialized shipping workflows',
                'Real-time stock synchronization with external web services through an API',
                'Mass import tools',
                'Meta and Google tracking',
            ],
            'description' => 'Architected high-performance e-commerce ecosystems leveraging advanced caching and specialized shipping workflows. Integrated real-time synchronization with external web services via API to ensure stock consistency, coupled with mass import tools and Meta/Google tracking for maximized ROI.',
            'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
            'demo' => 'https://ramirezramirez.com.py/',
            'image' => 'assets/projects/ramirez-ramirez-desktop.webp',
            'mobile' => 'assets/projects/ramirez-ramirez-mobile.webp',
        ],
        [
            'badge' => 'E-commerce',
            'title' => 'Gisele Stephanie',
            'slug' => 'gisele-stephanie',
            'views' => [
                [
                    'label' => 'Category',
                    'image' => 'assets/projects/gisele-stephanie-categoria-desktop.webp',
                    'mobile' => 'assets/projects/gisele-stephanie-categoria-mobile.webp',
                ],
                [
                    'label' => 'Product sheet',
                    'image' => 'assets/projects/gisele-stephanie-producto-desktop.webp',
                    'mobile' => 'assets/projects/gisele-stephanie-producto-mobile.webp',
                ],
            ],
            'highlights' => [
                'Advanced caching and specialized shipping workflows',
                'Real-time stock synchronization with external web services through an API',
                'Mass import tools',
                'Meta and Google tracking',
            ],
            'description' => 'Architected high-performance e-commerce ecosystems leveraging advanced caching and specialized shipping workflows. Integrated real-time synchronization with external web services via API to ensure stock consistency, coupled with mass import tools and Meta/Google tracking for maximized ROI.',
            'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
            'demo' => 'https://giselestephanie.com.py/',
            'image' => 'assets/projects/gisele-stephanie-desktop.webp',
            'mobile' => 'assets/projects/gisele-stephanie-mobile.webp',
        ],
        [
            'badge' => 'Community Project',
            'title' => 'SIS System',
            'slug' => 'sis',
            'highlights' => [
                'Patient and appointment management',
                'Developed with the Autonomous University of Encarnación and the European HEIComp Project',
                'Created for use at the Lazos del Sur oncology hospital',
            ],
            'description' => 'Patient and appointment management system developed in collaboration with the Autonomous University of Encarnación and the European HEIComp Project, created for use at the Lazos del Sur oncology hospital',
            'tech' => ['Laravel', 'JavaScript', 'PHP', 'HTML/CSS', 'Bootstrap', 'Git/GitHub'],
            'image' => 'assets/projects/sis.webp',
        ],
        [
            'badge' => 'Community Project',
            'title' => 'Cloud SIS System',
            'slug' => 'cloud-sis',
            'highlights' => [
                'Modules for appointments, doctors, rooms, specialties, users, and reports',
                'Role-based access control with a dashboard for each role',
                'Real-time operation protected against multiple edits of the same value',
                'Created for a Family Health Unit in Encarnación',
            ],
            'description' => 'Hospital management system developed for use in a Family Health Unit in the city of Encarnación. It features modules for appointments, doctors, room management, specialties, users, reports, role-based access control with dashboards adapted to each role, as well as support for real-time operations with protection against multiple modifications to the same value.',
            'tech' => ['React JS', 'Flowbite', 'Express JS', 'Node.js', 'AWS EC2', 'Tailwind', 'Git/GitHub', 'Socket.io'],
            'image' => 'assets/projects/cloud-sis.webp',
        ],
    ],
];
