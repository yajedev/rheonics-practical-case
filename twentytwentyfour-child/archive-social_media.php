<?php
get_header();
?>

<main class="social-media-archive-layout">


    <?php get_template_part('partials/archive-hero'); ?>

    <section class="container">

        <?php
        $taxonomy = 'social_media_category';
        $terms = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        ]);


        $total_posts = 0;
        if ($terms) {
            foreach ($terms as $term) {
                $total_posts = $total_posts + $term->count;
            }
        }
        ?>

        <div class="filter-container">

            <button class="filter-btn active" data-filter="all">
                All Content <span class="count"><?php echo $total_posts; ?></span>
            </button>

            <?php if ($terms) : ?>
                <?php foreach ($terms as $term) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr($term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                        <span class="count"><?php echo $term->count; ?></span>
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <?php if (have_posts()) : ?>

            <div class="posts-grid">

                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    $post_terms = get_the_terms(get_the_ID(), $taxonomy);
                    $slugs = [];

                    if ($post_terms && !is_wp_error($post_terms)) {
                        foreach ($post_terms as $pt) {
                            $slugs[] = $pt->slug;
                        }
                    }

                    $card_date = get_field('date');
                    $card_location = get_field('location');
                    ?>

                    <article class="social-card" data-category="<?php echo esc_attr(implode(' ', $slugs)); ?>">

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="social-card__image" style="position: relative;">
                                <?php the_post_thumbnail('large'); ?>

                                <?php
                                /* Dynamic badges */
                                if ($post_terms && !is_wp_error($post_terms)) :
                                    $main_badge = $post_terms[0];
                                    $badge_text = !empty($main_badge->description) ? $main_badge->description : $main_badge->name;

                                    $text_color = get_field('badge_text_color', $taxonomy . '_' . $main_badge->term_id);
                                    $bg_color   = get_field('badge_background_color', $taxonomy . '_' . $main_badge->term_id);

                                    $final_text_color = !empty($text_color) ? $text_color : '#155DFC';
                                    $final_bg_color   = !empty($bg_color) ? $bg_color : '#EFF6FF';
                                ?>
                                    <span class="social-card__badge" style="color: <?php echo esc_attr($final_text_color); ?>; background-color: <?php echo esc_attr($final_bg_color); ?>;">
                                        <?php echo esc_html($badge_text); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="social-card__content">

                            <h2>
                                <a href="<?php the_permalink(); ?>" class="main-card-link">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p><?php the_excerpt(); ?></p>

                            <div class="social-card__meta">
                                <?php if (!empty($card_date) && is_string($card_date)) : ?>
                                    <span><?php echo esc_html($card_date); ?></span>
                                <?php endif; ?>

                                <?php if (!empty($card_location) && is_string($card_location)) : ?>
                                    <span><?php echo esc_html($card_location); ?></span>
                                <?php endif; ?>
                            </div>

                        </div>

                    </article>

                <?php endwhile; ?>

            </div>

        <?php else : ?>

            <p>No posts found.</p>

        <?php endif; ?>

        <div class="pagination">
            <?php
            the_posts_pagination([
                'mid_size'  => 1,
                'prev_text' => '←',
                'next_text' => '→',
            ]);
            ?>
        </div>

    </section>

    <?php get_template_part('partials/contact-banner'); ?>
</main>



<?php get_footer(); ?>