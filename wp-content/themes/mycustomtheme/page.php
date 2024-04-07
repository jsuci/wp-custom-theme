<?php get_header(); ?>


<main aria-label="Main content" class="flex flex-col gap-y-8">
    <?php while (have_posts()) : the_post(); ?>
        <h2 class="text-4xl/snug font-semibold mb-6"><?php the_title() ?></h2>
        <div>
            <?php the_content(); ?>
        </div>
    <?php endwhile; ?>
</main>



<?php get_footer(); ?>