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

    'socials' => [
        'github' => 'https://github.com',
        'linkedin' => 'https://linkedin.com',
        'email' => 'tu@email.com',
    ],

    'navigation' => [
        ['id' => 'hero-section', 'label' => 'Home'],
        ['id' => 'projects', 'label' => 'Projects'],
        ['id' => 'skills', 'label' => 'Skills'],
        ['id' => 'about', 'label' => 'About'],
        ['id' => 'contact', 'label' => 'Contact'],
    ],

    'hero' => [
        'description' => 'Passionate about creating innovative and scalable digital solutions',
        'roles' => ['Front End', 'Back End', 'Full Stack'],
    ],

    'about' => [
        'bio' => 'Desarrollador de software con experiencia en crear aplicaciones web modernas y escalables. Me especializo en el stack Laravel, PHP, JavaScript y frameworks modernos.',
        // Ruta dentro de public/. Si el archivo no existe se muestra el avatar genérico.
        'photo' => 'assets/about/lizandro.jpg',
    ],

    'contact' => [
        'email' => 'tu@email.com',
        'location' => 'Tu Ciudad, País',
        'github_url' => 'https://github.com',
        'github_handle' => '@tuusuario',
    ],

    'skills' => [
        [
            'category' => 'Frontend',
            'icon' => 'monitor',
            'items' => ['HTML5/CSS3', 'JavaScript/TypeScript', 'Vue.js / React', 'Tailwind CSS', 'Bootstrap'],
        ],
        [
            'category' => 'Backend',
            'icon' => 'server',
            'items' => ['PHP / Laravel', 'Node.js', 'MySQL / PostgreSQL', 'Microservicios', 'Arquitectura MVC', 'RESTful APIs'],
        ],
        [
            'category' => 'Tools',
            'icon' => 'cog',
            'items' => ['Git / GitHub', 'Docker', 'CI/CD', 'AWS / Cloud', 'IA'],
        ],
    ],

    'also_work_with' => ['Livewire', 'Alpine.js', 'Redis', 'GraphQL', 'Jest', 'Webpack', 'Vite', 'Figma'],

    /*
    | Proyectos agrupados por categoría.
    |
    | - carousel: carpeta dentro de public/ y lista de imágenes con su leyenda.
    | - placeholder: se usa cuando el proyecto todavía no tiene capturas.
    | - reverse: muestra el medio a la izquierda en escritorio.
    */
    'project_groups' => [
        [
            'title' => 'For the Community',
            'icon' => 'users',
            'projects' => [
                [
                    'id' => 'sis',
                    'badge' => 'Community Project',
                    'title' => 'SIS System',
                    'description' => 'Patient and appointment management system developed in collaboration with the Autonomous University of Encarnación and the European HEIComp Project, created for use at the Lazos del Sur oncology hospital',
                    'tech' => ['Laravel', 'JavaScript', 'PHP', 'HTML/CSS', 'Bootstrap', 'Git/GitHub'],
                    'carousel' => [
                        'dir' => 'assets/project_img',
                        'slides' => [
                            ['file' => 'image.png', 'caption' => 'Appointment report'],
                            ['file' => 'image1.jpg', 'caption' => 'User management'],
                            ['file' => 'image2.jpg', 'caption' => 'Appointment system'],
                        ],
                    ],
                    'reverse' => false,
                ],
                [
                    'id' => 'cloud-sis',
                    'badge' => 'Community Project',
                    'title' => 'Cloud SIS System',
                    'description' => 'Hospital management system developed for use in a Family Health Unit in the city of Encarnación. It features modules for appointments, doctors, room management, specialties, users, reports, role-based access control with dashboards adapted to each role, as well as support for real-time operations with protection against multiple modifications to the same value.',
                    'tech' => ['React JS', 'Flowbite', 'Express JS', 'Node.js', 'AWS EC2', 'Tailwind', 'Git/GitHub', 'Socket.io'],
                    'carousel' => [
                        'dir' => 'assets/project2_img',
                        'slides' => [
                            ['file' => 'image.png', 'caption' => 'Main View'],
                            ['file' => 'image1.png', 'caption' => 'Control Panel'],
                            ['file' => 'image2.png', 'caption' => 'Appointment Management'],
                            ['file' => 'image3.png', 'caption' => 'User Management'],
                            ['file' => 'image4.png', 'caption' => 'Details View'],
                            ['file' => 'image5.png', 'caption' => 'Reports'],
                            ['file' => 'image6.png', 'caption' => 'Settings'],
                            ['file' => 'image7.png', 'caption' => 'Profile'],
                            ['file' => 'image8.png', 'caption' => 'Overview'],
                        ],
                    ],
                    'reverse' => true,
                ],
            ],
        ],
        [
            'title' => 'Freelance',
            'icon' => 'briefcase',
            'projects' => [
                [
                    'id' => 'barber',
                    'badge' => 'Freelance Project',
                    'title' => 'Alonzo Style',
                    'description' => 'Customer, appointment, service, and barber management system with a scheduling agenda for clients. It sends push notifications to barbers and enables automated WhatsApp contact for appointment confirmation, rescheduling, or cancellation, automating virtually all management tasks.',
                    'tech' => ['MongoDB', 'Express', 'React.js', 'Node.js', 'Flowbite', 'Tailwind', 'JWT', 'Git/GitHub'],
                    'demo' => 'http://alonzostyle.com/',
                    'carousel' => [
                        'dir' => 'assets/freelance_img',
                        'slides' => [
                            ['file' => 'alonzo1.png', 'caption' => 'Control Panel'],
                            ['file' => 'alonzo2.png', 'caption' => 'Shift Management'],
                            ['file' => 'alonzo3.png', 'caption' => 'Client Agenda'],
                            ['file' => 'alonzo4.png', 'caption' => 'Notifications'],
                            ['file' => 'alonzo5.png', 'caption' => 'Barber Settings'],
                        ],
                    ],
                    'reverse' => false,
                ],
            ],
        ],
        [
            'title' => 'Working at Porta',
            'icon' => 'collection',
            'projects' => [
                [
                    'id' => 'institutional',
                    'badge' => 'Agency Project',
                    'title' => 'Institutional Pages',
                    'description' => 'Development and optimization of high-traffic institutional platforms, featuring specialized multilingual support, professional content management solutions, and integrated Meta and Google marketing analytics.',
                    'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
                    'placeholder' => ['icon' => 'globe', 'label' => 'Porta Web Agency'],
                    'reverse' => false,
                ],
                [
                    'id' => 'catalogs',
                    'badge' => 'Agency Project',
                    'title' => 'Web Catalogs',
                    'description' => 'Development of high-concurrency web catalogs designed for maximum performance and scalability with advanced caching. Features real-time product and stock synchronization via external API integrations, specialized multilingual support, and integrated logistics, powered by Meta and Google analytics.',
                    'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
                    'placeholder' => ['icon' => 'collection', 'label' => 'Web Catalogs'],
                    'reverse' => true,
                ],
                [
                    'id' => 'ecommerce',
                    'badge' => 'Agency Project',
                    'title' => 'E-commerce',
                    'description' => 'Architected high-performance e-commerce ecosystems leveraging advanced caching and specialized shipping workflows. Integrated real-time synchronization with external web services via API to ensure stock consistency, coupled with mass import tools and Meta/Google tracking for maximized ROI.',
                    'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
                    'placeholder' => ['icon' => 'cart', 'label' => 'E-commerce'],
                    'reverse' => false,
                ],
            ],
        ],
    ],
];
