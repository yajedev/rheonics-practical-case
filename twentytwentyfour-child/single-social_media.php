<?php get_header(); ?>

<main class="single-social-media-layout">

    <?php while (have_posts()) : the_post(); ?>

        <section class="social-single-header container">

            <?php
            $taxonomy_name = 'social_media_category';
            $terms = get_the_terms(get_the_ID(), $taxonomy_name);
            if ($terms && !is_wp_error($terms)) :
                $term = $terms[0];
                $badge_text = !empty($term->description) ? $term->description : $term->name;
                $text_color = get_field('badge_text_color', $taxonomy_name . '_' . $term->term_id);
                $bg_color   = get_field('badge_background_color', $taxonomy_name . '_' . $term->term_id);

                $final_text_color = !empty($text_color) ? $text_color : '#155DFC';
                $final_bg_color   = !empty($bg_color) ? $bg_color : '#EFF6FF';
            ?>
                <span class="single-badge" style="color: <?php echo esc_attr($final_text_color); ?>; background-color: <?php echo esc_attr($final_bg_color); ?>; border: 1px solid <?php echo esc_attr($final_text_color); ?>33;">
                    <span class="badge-icon"><?php echo esc_html($badge_text); ?></span>
                    
                </span>
            <?php endif; ?>

            <h1 class="social-single-title"><?php the_title(); ?></h1>

            <div class="social-single-meta">
                <?php if ($date = get_field('date')) : ?>
                    <span class="meta-item date-item">
                        <span class="meta-icon"><?php echo esc_html($date); ?></span>
                    </span>
                <?php endif; ?>

                <?php if ($location = get_field('location')) : ?>
                    <span class="meta-item location-item">
                        <span class="meta-icon"><?php echo esc_html($location); ?></span>
                    </span>
                <?php endif; ?>
            </div>

        </section>

        <?php if (has_post_thumbnail()) : ?>
            <section class="social-single-featured-image">
                <?php the_post_thumbnail('full'); ?>
            </section>
        <?php endif; ?>

        <section class="social-single-body-wrapper container">



            <div class="social-single-content entry-content">
                <?php the_content(); ?>
            </div>

        </section>


        <?php get_template_part('partials/contact-banner'); ?>

        <nav class="social-post-navigation">
            <div class="nav-links-wrapper">

                <?php
                $prev_post = get_previous_post(true, '', 'social_media_category');
                if (!empty($prev_post)) : ?>
                    <div class="nav-post-item nav-previous">
                        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                            <span class="nav-arrow">‹</span>
                            <span class="nav-post-title"><?php echo esc_html($prev_post->post_title); ?></span>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="nav-post-item nav-empty"></div>
                <?php endif; ?>

                <?php
                $next_post = get_next_post(true, '', 'social_media_category');
                if (!empty($next_post)) : ?>
                    <div class="nav-post-item nav-next">
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                            <span class="nav-post-title"><?php echo esc_html($next_post->post_title); ?></span>
                            <span class="nav-arrow">›</span>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="nav-post-item nav-empty"></div>
                <?php endif; ?>

            </div>
        </nav>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>