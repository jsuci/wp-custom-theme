<?php get_header(); ?>

<main aria-label="Main content" class="flex flex-col gap-y-8 lg:flex-row lg:gap-x-8">
    <div class="lg:w-9/12">
        <?php while (have_posts()) : the_post(); ?>
            <article aria-labelledby="post-title-<?php the_ID(); ?>" class="bg-slate-700 p-6 rounded-lg mb-6">
                <header class="mb-6">
                    <h2 id="post-title-<?php the_ID(); ?>" class="text-4xl/snug font-semibold mb-6 post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="flex flex-wrap gap-y-2 divide-x-2 divide-slate-600 text-base post-details">
                        <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="pr-3"><?php echo get_the_date(); ?></time>
                        <span class="divider">|</span>
                        <div class="px-3">
                            Category 1
                        </div>
                        <span class="divider">|</span>
                        <div class="px-3">
                            <?php echo get_comments_number(); ?> comments
                        </div>
                        <span class="divider">|</span>
                        <div class="pl-3">
                            ★★★★☆
                        </div>
                    </div>
                </header>
                <div class="article-content">
                    <?php the_excerpt(); ?>
                    <div class="read-more">
                        <div class="readmore-button"><a href="<?php the_permalink(); ?>">Continue reading &raquo;</a></div>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
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