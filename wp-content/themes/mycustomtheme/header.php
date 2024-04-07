<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo("charset") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body class="flex flex-col gap-y-9 bg-slate-900 text-slate-300 mx-auto px-4 text-lg">
    <header class="flex flex-col pt-8 gap-y-6 md:flex-row md:justify-between md:items-center">
        <h1 class="logo">
            <a href="/" aria-label="Home page">
                <img src="<?php echo get_theme_file_uri('images/bestcheatfiles-logo.png'); ?>" alt="Site Logo">
            </a>
        </h1>
        <nav aria-label="Main menu" class="p-4">
            <?php wp_nav_menu(array(
                'theme_location' => 'headerMenuLocation',
                'menu_class' => 'flex flex-col gap-y-4 md:flex-row md:gap-x-6', // Add this line
                'container' => 'ul'
            )); ?>
        </nav>
    </header>