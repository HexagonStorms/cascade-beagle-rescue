<?php
/**
 * Cascade Beagle Rescue Child Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue parent and child theme styles
 */
function cascade_rescue_child_enqueue_styles() {
    // Enqueue parent theme style
    wp_enqueue_style(
        'twentytwentyfive-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );
    
    // Enqueue child theme style
    wp_enqueue_style(
        'cascade-rescue-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('twentytwentyfive-style'),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'cascade_rescue_child_enqueue_styles');

/**
 * Custom theme support and setup
 */
function cascade_rescue_child_setup() {
    // Add custom logo support with appropriate size
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add support for custom colors (for easy theme switching)
    add_theme_support('custom-colors');
}
add_action('after_setup_theme', 'cascade_rescue_child_setup');

/**
 * Register custom block patterns for rescue-specific content
 */
function cascade_rescue_register_block_patterns() {
    // Dog adoption card pattern
    register_block_pattern(
        'cascade-rescue/dog-adoption-card',
        array(
            'title'       => __('Dog Adoption Card', 'cascade-beagle-rescue-child'),
            'description' => __('A card layout for showcasing adoptable dogs', 'cascade-beagle-rescue-child'),
            'content'     => '<!-- wp:group {"className":"dog-card"} -->
                <div class="wp-block-group dog-card">
                    <!-- wp:image {"width":200} -->
                    <figure class="wp-block-image is-resized">
                        <img src="' . get_stylesheet_directory_uri() . '/images/placeholder-dog.jpg" alt="Dog photo" width="200"/>
                    </figure>
                    <!-- /wp:image -->
                    
                    <!-- wp:heading {"level":3} -->
                    <h3>Dog Name</h3>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph -->
                    <p>Age: <span class="rescue-highlight">2 years</span></p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:paragraph -->
                    <p>Brief description of the dog\'s personality and needs.</p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:button {"className":"rescue-cta"} -->
                    <div class="wp-block-button rescue-cta">
                        <a class="wp-block-button__link">Learn More</a>
                    </div>
                    <!-- /wp:button -->
                </div>
                <!-- /wp:group -->',
            'categories'  => array('rescue'),
        )
    );
    
    // Donation CTA pattern
    register_block_pattern(
        'cascade-rescue/donation-cta',
        array(
            'title'       => __('Donation Call-to-Action', 'cascade-beagle-rescue-child'),
            'description' => __('A prominent donation section', 'cascade-beagle-rescue-child'),
            'content'     => '<!-- wp:group {"style":{"color":{"background":"var(--rescue-primary)"},"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}}}} -->
                <div class="wp-block-group has-background" style="background-color:var(--rescue-primary);padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
                    <!-- wp:heading {"textAlign":"center","style":{"color":{"text":"#ffffff"}}} -->
                    <h2 class="has-text-align-center" style="color:#ffffff">Help Save More Beagles</h2>
                    <!-- /wp:heading -->
                    
                    <!-- wp:paragraph {"align":"center","style":{"color":{"text":"#ffffff"}}} -->
                    <p class="has-text-align-center" style="color:#ffffff">Your donation helps us rescue, rehabilitate, and rehome beagles in need.</p>
                    <!-- /wp:paragraph -->
                    
                    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
                    <div class="wp-block-buttons">
                        <!-- wp:button {"style":{"color":{"background":"var(--rescue-accent)","text":"#ffffff"}}} -->
                        <div class="wp-block-button">
                            <a class="wp-block-button__link has-text-color has-background" style="color:#ffffff;background-color:var(--rescue-accent)">Donate Now</a>
                        </div>
                        <!-- /wp:button -->
                    </div>
                    <!-- /wp:buttons -->
                </div>
                <!-- /wp:group -->',
            'categories'  => array('rescue'),
        )
    );
}
add_action('init', 'cascade_rescue_register_block_patterns');

/**
 * Register custom block pattern category
 */
function cascade_rescue_register_pattern_categories() {
    register_block_pattern_category(
        'rescue',
        array('label' => __('Rescue Patterns', 'cascade-beagle-rescue-child'))
    );
}
add_action('init', 'cascade_rescue_register_pattern_categories');

/**
 * Customize the admin area for better rescue workflow
 */
function cascade_rescue_admin_customizations() {
    // Custom CSS for admin area (optional)
    echo '<style>
        .rescue-highlight { color: var(--rescue-primary); font-weight: bold; }
    </style>';
}
add_action('admin_head', 'cascade_rescue_admin_customizations');