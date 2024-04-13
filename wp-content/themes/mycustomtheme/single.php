<?php

get_header(); ?>



<main aria-label="Main content" class="flex flex-col gap-y-8 lg:flex-row lg:gap-x-8">
    <div class="lg:w-9/12">
        <?php while (have_posts()) : the_post(); ?>
            <article aria-labelledby="post-title-<?php the_ID(); ?>" class="bg-slate-700 p-6 rounded-lg mb-6">
                <header class="mb-6">
                    <h1 id="post-title-<?php the_ID(); ?>" class="text-4xl/snug font-semibold mb-6 post-title"><?php the_title(); ?></h2>
                        <div class="flex flex-wrap gap-y-2 divide-x-2 divide-slate-600 text-base post-details">
                            <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="pr-3"><?php echo get_the_date(); ?></time>
                            <span class="divider">|</span>
                            <div class="px-3">
                                <?php
                                $rating = get_field('ratings');
                                if ($rating) {
                                    // Output the stars
                                    echo '<div class="rating-stars">';
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<span class="star filled">&#9733;</span>'; // Filled star
                                        } else {
                                            echo '<span class="star">&#9734;</span>'; // Empty star
                                        }
                                    }
                                    echo '</div>'; // .rating-stars
                                }
                                ?>
                            </div>
                            <span class="divider">|</span>
                            <div class="pl-3">
                                <?php echo get_comments_number(); ?> comments
                            </div>
                        </div>
                </header>
                <div class="post-content">
                    <img src="<?php echo the_field('post_image') ?>" />
                    <p><?php echo the_field('post_description') ?></p>
                    <?php echo the_field("post_steps") ?>
                    <a href="<?php echo the_field('download_link') ?>">Download Now</a>
                </div>
            </article>
        <?php endwhile; ?>
        <section aria-labelledby="comments-heading" class="bg-slate-700 p-6 rounded-lg">
            <h3 id="comments-heading" class="sidebar-heading">Comments</h3>
            <?php
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
        </section>
    </div>

    <aside aria-label="Sidebar" class="flex flex-col gap-y-6 lg:w-3/12">
        <section aria-labelledby="search-heading" class="bg-slate-700 p-6 rounded-lg">
            <h3 id="search-heading" class="sr-only">Search</h3>
            <form action="/search" method="get" class="flex items-center">
                <label for="search" class="sr-only">Search</label>
                <input type="search" id="search" name="search" class="w-full p-2 rounded-lg" placeholder="Search..." aria-label="Search" />
                <button type="submit" class="search-btn ml-2 px-4 py-2 bg-pink-500 text-white rounded-lg hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" aria-label="Submit search">
                    Search
                </button>
            </form>
        </section>
        <section aria-labelledby="recent-posts-heading" class="bg-slate-700 p-6 rounded-lg">
            <h3 id="recent-posts-heading" class="sidebar-heading">Recent Posts</h3>
            <ul>
                <?php
                $args = array(
                    'posts_per_page' => 10, // Number of posts to display
                    'orderby' => 'rand', // Order by random
                    'post_status' => 'publish', // Only show published posts
                );
                $rand_posts = new WP_Query($args);
                if ($rand_posts->have_posts()) :
                    while ($rand_posts->have_posts()) : $rand_posts->the_post();
                ?>
                        <li>
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                                <?php the_title(); ?>
                            </a>
                        </li>
                <?php
                    endwhile;
                endif;
                wp_reset_postdata(); // Reset post data to avoid conflicts
                ?>
            </ul>
        </section>
        <section aria-labelledby="categories-heading" class="bg-slate-700 p-6 rounded-lg">
            <h3 id="categories-heading" class="sidebar-heading">Categories</h3>
            <ul>
                <li><a href="category_link_1">Category 1</a></li>
                <li><a href="category_link_2">Category 2</a></li>
                <!-- More categories -->
            </ul>
        </section>
    </aside>
</main>



<?php get_footer(); ?>