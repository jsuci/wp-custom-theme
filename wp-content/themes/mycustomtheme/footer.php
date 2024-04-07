<footer class="footer-section">

    <nav aria-label="Privacy and policy links">
        <?php wp_nav_menu(array(
            'theme_location' => 'footerMenuLocation',
            'menu_class' => 'flex flex-col gap-y-4 md:flex-row md:justify-end md:text-sm md:gap-x-6',
            'container' => 'ul'
        )); ?>
    </nav>
</footer>
<?php wp_footer(); ?>
</body>

</html>