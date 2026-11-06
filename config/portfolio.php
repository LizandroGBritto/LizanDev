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
        'email' => 'tu@email.com',
        'location' => 'Tu Ciudad, País',
        'github_url' => 'https://github.com',
        'github_handle' => '@tuusuario',
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
    | - image: ruta dentro de public/ (WebP, ver `npm run imagenes`).
    | - placeholder: etiqueta que se muestra cuando todavía no hay captura.
    */
    'projects' => [
        [
            'badge' => 'Community Project',
            'title' => 'SIS System',
            'description' => 'Patient and appointment management system developed in collaboration with the Autonomous University of Encarnación and the European HEIComp Project, created for use at the Lazos del Sur oncology hospital',
            'tech' => ['Laravel', 'JavaScript', 'PHP', 'HTML/CSS', 'Bootstrap', 'Git/GitHub'],
            'image' => 'assets/projects/sis.webp',
        ],
        [
            'badge' => 'Community Project',
            'title' => 'Cloud SIS System',
            'description' => 'Hospital management system developed for use in a Family Health Unit in the city of Encarnación. It features modules for appointments, doctors, room management, specialties, users, reports, role-based access control with dashboards adapted to each role, as well as support for real-time operations with protection against multiple modifications to the same value.',
            'tech' => ['React JS', 'Flowbite', 'Express JS', 'Node.js', 'AWS EC2', 'Tailwind', 'Git/GitHub', 'Socket.io'],
            'image' => 'assets/projects/cloud-sis.webp',
        ],
        [
            'badge' => 'Freelance Project',
            'title' => 'Alonzo Style',
            'description' => 'Customer, appointment, service, and barber management system with a scheduling agenda for clients. It sends push notifications to barbers and enables automated WhatsApp contact for appointment confirmation, rescheduling, or cancellation, automating virtually all management tasks.',
            'tech' => ['MongoDB', 'Express', 'React.js', 'Node.js', 'Flowbite', 'Tailwind', 'JWT', 'Git/GitHub'],
            'demo' => 'http://alonzostyle.com/',
            'image' => 'assets/projects/alonzo-style.webp',
        ],
        [
            'badge' => 'Agency Project',
            'title' => 'Institutional Pages',
            'description' => 'Development and optimization of high-traffic institutional platforms, featuring specialized multilingual support, professional content management solutions, and integrated Meta and Google marketing analytics.',
            'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
            'placeholder' => 'Porta',
        ],
        [
            'badge' => 'Agency Project',
            'title' => 'Web Catalogs',
            'description' => 'Development of high-concurrency web catalogs designed for maximum performance and scalability with advanced caching. Features real-time product and stock synchronization via external API integrations, specialized multilingual support, and integrated logistics, powered by Meta and Google analytics.',
            'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
            'placeholder' => 'Porta',
        ],
        [
            'badge' => 'Agency Project',
            'title' => 'E-commerce',
            'description' => 'Architected high-performance e-commerce ecosystems leveraging advanced caching and specialized shipping workflows. Integrated real-time synchronization with external web services via API to ensure stock consistency, coupled with mass import tools and Meta/Google tracking for maximized ROI.',
            'tech' => ['Laravel', 'Blade', 'Bootstrap', 'MySQL', 'Git'],
            'placeholder' => 'Porta',
        ],
    ],
];
