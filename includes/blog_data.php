<?php
$blogPosts = [
    'innovation-numerique-casamance' => [
        'title' => "L'innovation numérique en Casamance",
        'image' => 'assets/images/blog/blog_post_innovation_africa.png',
        'date' => '16 Jan, 2026',
        'author' => 'Admin',
        'category' => 'Innovation',
        'excerpt' => "Découvrez comment les nouvelles technologies transforment le paysage entrepreneurial au sud du Sénégal. De l'agriculture intelligente à l'éducation, le numérique ouvre de nouvelles opportunités pour la jeunesse.",
        'content' => [
            "L'Afrique est en pleine effervescence technologique, et le Sénégal se positionne comme un hub incontournable en Afrique de l'Ouest. En Casamance, l'innovation numérique ne se limite plus à la simple digitalisation des processus existants, mais redéfinit fondamentalement la manière dont les entreprises opèrent et interagissent avec leurs clients.",
            "Des startups locales aux grandes entreprises, l'intégration de solutions sur mesure permet de répondre à des défis spécifiques tels que l'inclusion financière, l'accès aux soins de santé et l'optimisation agricole.",
            "Chez ETAAM, nous croyons fermement que le développement de logiciels adaptés est la clé pour libérer le potentiel économique de la région. En utilisant des technologies modernes comme l'intelligence artificielle et le cloud computing, nous aidons nos partenaires à gagner en efficacité et à créer de la valeur ajoutée."
        ],
        'tags' => ['Technologie', 'Innovation', 'Casamance']
    ],
    'ia-agriculture-revolution-verte' => [
        'title' => "IA et Agriculture : Une révolution verte",
        'image' => 'assets/images/blog/blog_post_it_challenges.png',
        'date' => '12 Jan, 2026',
        'author' => 'Albert Malang Diatta',
        'category' => 'AgriTech',
        'excerpt' => "L'usage de l'intelligence artificielle permet d'optimiser les rendements agricoles. Analyse des sols, prévisions météo et gestion des ressources sont désormais accessibles aux agriculteurs locaux.",
        'content' => [
            "L'agriculture est le pilier de l'économie sénégalaise. Cependant, elle fait face à de nombreux défis : changement climatique, gestion de l'eau, et accès aux marchés. L'Intelligence Artificielle apporte aujourd'hui des réponses concrètes.",
            "Grâce à des capteurs IoT et à l'analyse de données satellite, nous pouvons désormais prédire les rendements, détecter les maladies des plantes avant qu'elles ne se propagent, et optimiser l'irrigation pour économiser l'eau.",
            "Les solutions développées par ETAAM permettent aux agriculteurs de Ziguinchor et de toute la région de prendre des décisions éclairées, augmentant ainsi leur productivité tout en préservant l'environnement."
        ],
        'tags' => ['AgriTech', 'IA', 'Agriculture']
    ],
    'cybersecurite-pme-senegalaises' => [
        'title' => "La Cybersécurité pour les PME Sénégalaises",
        'image' => 'assets/images/blog/blog-post-change.png',
        'date' => '05 Jan, 2026',
        'author' => 'Oumar Fall',
        'category' => 'Cybersécurité',
        'excerpt' => "À l'ère du tout numérique, la protection des données est cruciale. Voici les bonnes pratiques pour sécuriser votre entreprise contre les cybermenaces grandissantes.",
        'content' => [
            "Avec la digitalisation croissante des entreprises sénégalaises, les risques de cyberattaques augmentent exponentiellement. Ransomwares, phishing, et vols de données ne concernent pas que les multinationales.",
            "Pour une PME, une attaque peut être fatale. Il est donc essentiel de mettre en place une stratégie de défense robuste. Cela passe par la formation des employés, la mise à jour régulière des systèmes, et l'utilisation de solutions de sécurité adaptées.",
            "Nos experts en cybersécurité accompagnent les PME locales pour auditer leurs systèmes et renforcer leur résilience face aux menaces numériques."
        ],
        'tags' => ['Sécurité', 'PME', 'Data']
    ]
];

// Recent Posts Data (Automatically derived from the latest 3 posts)
$recentPosts = [];
$count = 0;
foreach ($blogPosts as $slug => $post) {
    if ($count >= 3) break;
    $recentPosts[] = [
        'title' => $post['title'],
        'image' => $post['image'],
        'date'  => $post['date'],
        'slug'  => $slug
    ];
    $count++;
}

// Extract unique categories and tags
$categories = [];
$tags = [];

foreach ($blogPosts as $post) {
    // Categories
    if (isset($post['category']) && !in_array($post['category'], $categories)) {
        $categories[] = $post['category'];
    }
    
    // Tags
    if (isset($post['tags']) && is_array($post['tags'])) {
        foreach ($post['tags'] as $tag) {
            if (!in_array($tag, $tags)) {
                $tags[] = $tag;
            }
        }
    }
}
sort($categories);
sort($tags);
?>
