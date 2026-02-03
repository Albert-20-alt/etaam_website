<?php
$contactSteps = [
    1 => [
        'id' => 'step1',
        'title' => 'Quel est votre besoin ?',
        'subtitle' => 'Sélectionnez l\'option qui correspond le mieux à votre situation',
        'step_number' => 1,
        'options' => [
            [
                'value' => 'nouveau-projet',
                'icon' => 'fas fa-rocket',
                'icon_color' => '#6A4C93',
                'title' => 'Nouveau projet digital',
                'description' => 'Application, site web, logiciel'
            ],
            [
                'value' => 'support',
                'icon' => 'fas fa-tools',
                'icon_color' => '#6A4C93',
                'title' => 'Support technique',
                'description' => 'Maintenance, dépannage'
            ],
            [
                'value' => 'consultation',
                'icon' => 'fas fa-chart-line',
                'icon_color' => '#6A4C93',
                'title' => 'Consultation',
                'description' => 'Conseil stratégique'
            ],
            [
                'value' => 'formation',
                'icon' => 'fas fa-graduation-cap',
                'icon_color' => '#6A4C93',
                'title' => 'Formation',
                'description' => 'Renforcement de capacités'
            ],
            [
                'value' => 'partenariat',
                'icon' => 'fas fa-handshake',
                'icon_color' => '#6A4C93',
                'title' => 'Partenariat',
                'description' => 'Collaboration professionnelle'
            ]
        ]
    ],
    2 => [
        'id' => 'step2',
        'title' => 'Dans quel domaine ?',
        'subtitle' => 'Choisissez le domaine d\'expertise concerné',
        'step_number' => 2,
        'options' => [
            [
                'value' => 'ia',
                'icon' => 'fas fa-brain',
                'icon_color' => '#00d2d3',
                'title' => 'IA & Technologies',
                'description' => 'Intelligence artificielle, automatisation'
            ],
            [
                'value' => 'web-mobile',
                'icon' => 'fas fa-mobile-alt',
                'icon_color' => '#00d2d3',
                'title' => 'Web & Mobile',
                'description' => 'Sites web, applications mobiles'
            ],
            [
                'value' => 'suivi-evaluation',
                'icon' => 'fas fa-tasks',
                'icon_color' => '#00d2d3',
                'title' => 'Suivi & Évaluation',
                'description' => 'Gestion de projets, KPIs'
            ],
            [
                'value' => 'agritech',
                'icon' => 'fas fa-seedling',
                'icon_color' => '#00d2d3',
                'title' => 'AgriTech',
                'description' => 'Solutions agricoles innovantes'
            ],
            [
                'value' => 'marketing',
                'icon' => 'fas fa-bullhorn',
                'icon_color' => '#00d2d3',
                'title' => 'Marketing Digital',
                'description' => 'Stratégie digitale, SEO'
            ]
        ]
    ],
    3 => [
        'id' => 'step3',
        'title' => 'Quel est votre budget ?',
        'subtitle' => 'Estimation pour mieux vous orienter',
        'step_number' => 3,
        'options' => [
            [
                'value' => '<500k',
                'icon' => '', // No icon for budget in original, but strict array structure is good
                'icon_color' => '',
                'title' => '< 500 000 FCFA',
                'description' => 'Petit projet'
            ],
            [
                'value' => '500k-2m',
                'title' => '500K - 2M FCFA',
                'description' => 'Projet moyen'
            ],
            [
                'value' => '2m-10m',
                'title' => '2M - 10M FCFA',
                'description' => 'Grand projet'
            ],
            [
                'value' => '>10m',
                'title' => '> 10M FCFA',
                'description' => 'Projet d\'envergure'
            ],
            [
                'value' => 'a-definir',
                'title' => 'À définir',
                'description' => 'Besoin de conseil'
            ]
        ]
    ],
    4 => [
        'id' => 'step4',
        'title' => 'Quel est votre délai ?',
        'subtitle' => 'Quand souhaitez-vous démarrer ?',
        'step_number' => 4,
        'options' => [
            [
                'value' => 'urgent',
                'icon' => 'fas fa-bolt',
                'icon_color' => '#ff6b6b',
                'title' => 'Urgent',
                'description' => '< 1 mois'
            ],
            [
                'value' => 'court-terme',
                'icon' => 'fas fa-calendar-week',
                'icon_color' => '#ffa502',
                'title' => 'Court terme',
                'description' => '1 - 3 mois'
            ],
            [
                'value' => 'moyen-terme',
                'icon' => 'fas fa-calendar-alt',
                'icon_color' => '#00d2d3',
                'title' => 'Moyen terme',
                'description' => '3 - 6 mois'
            ],
            [
                'value' => 'long-terme',
                'icon' => 'fas fa-calendar',
                'icon_color' => '#6A4C93',
                'title' => 'Long terme',
                'description' => '> 6 mois'
            ],
            [
                'value' => 'flexible',
                'icon' => 'fas fa-clock',
                'icon_color' => '#a5b1c2',
                'title' => 'Flexible',
                'description' => 'Pas de contrainte'
            ]
        ]
    ]
];
?>
