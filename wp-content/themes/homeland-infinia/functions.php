<?php
/**
 * Homeland Infinia theme functions
 */

if (!defined('ABSPATH')) exit;

/* Chatbot Q&A CRUD admin screen (Add/Edit/Delete keyword-response pairs) */
require_once get_template_directory() . '/inc/chatbot-crud.php';

/* ---------------------------------------------------
 * Theme setup
 * ------------------------------------------------- */
function hi_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'homeland-infinia'),
    ));
}
add_action('after_setup_theme', 'hi_theme_setup');

/**
 * Fallback nav if no menu is assigned yet in Appearance > Menus
 */
function hi_default_menu_fallback() {
    echo '<a href="' . esc_url(home_url('/about-us/')) . '" class="nav-link" '.(is_page('about-us') ? 'style="color: #d1ac7c;font-weight: 600;"' : '') . '>About Us</a>';
    echo '<span class="nav-divider">|</span>';
    echo '<a href="' . esc_url(home_url('/blog/')) . '" class="nav-link" '.(is_page('blog') ? 'style="color: #d1ac7c;font-weight: 600;"' : '') . '>Blog</a>';
    echo '<span class="nav-divider">|</span>';
    echo '<a href="' . esc_url(home_url('/contact/')) . '" class="nav-link" '.(is_page('contact-us') ? 'style="color: #d1ac7c;font-weight: 600;"' : '') . '>Contact Us</a>';
}


function add_homepage_meta_tags() {
    // Only target the main homepage
    if ( is_front_page() ) {
        $meta_title = "Luxury Apartments in New Chandigarh | Homeland Infinia";
        $meta_description = "Discover Homeland Infinia, offering luxury apartments in New Chandigarh. Experience premium residences, modern amenities, & elegant living.";

        echo '<title>' . esc_html( $meta_title ) . '</title>' . "\n";
        echo '<meta name="description" content="' . esc_attr( $meta_description ) . '">' . "\n";
    }
}
// Automatically inserts these into header.php
add_action( 'wp_head', 'add_homepage_meta_tags', 1 );

/* ---------------------------------------------------
 * Enqueue styles & scripts
 * ------------------------------------------------- */
function hi_enqueue_assets() {
    wp_enqueue_style('hi-google-fonts', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Aboreto&family=Khand:wght@300;400;500;600;700&display=swap', array(), null);

    wp_enqueue_style('hi-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_style('hi-chatbot', get_template_directory_uri() . '/assets/css/chatbot.css', array(), '1.0');

    wp_enqueue_script('hi-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);

    if (hi_chatbot_enabled()) {
        wp_enqueue_script('hi-chatbot', get_template_directory_uri() . '/assets/js/chatbot.js', array(), '1.0', true);
        wp_localize_script('hi-chatbot', 'hiChatbot', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('hi_chatbot_nonce'),
        ));
    }

    if (is_page_template('page-templates/template-contact.php')) {
        wp_enqueue_script('hi-contact', get_template_directory_uri() . '/assets/js/contact-form.js', array(), '1.0', true);
        wp_localize_script('hi-contact', 'hiContact', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('hi_contact_nonce'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'hi_enqueue_assets');

/* ---------------------------------------------------
 * Customizer: Chatbot enable/disable switch
 * Appearance -> Customize -> Chatbot Settings -> Enable Chatbot Widget
 * ------------------------------------------------- */
function hi_customize_register($wp_customize) {
    $wp_customize->add_section('hi_chatbot_section', array(
        'title'    => __('Chatbot Settings', 'homeland-infinia'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('hi_chatbot_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'hi_sanitize_checkbox',
    ));

    $wp_customize->add_control('hi_chatbot_enabled', array(
        'label'   => __('Enable Chatbot Widget', 'homeland-infinia'),
        'section' => 'hi_chatbot_section',
        'type'    => 'checkbox',
    ));
}
add_action('customize_register', 'hi_customize_register');

function hi_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

function hi_chatbot_enabled() {
    return (bool) get_theme_mod('hi_chatbot_enabled', true);
}

/* Also expose a quick toggle right on the Dashboard, since some clients
 * won't go looking in Customizer for it. */
// function hi_register_chatbot_admin_page() {
//     add_menu_page(
//         'Chatbot',
//         'Chatbot',
//         'manage_options',
//         'hi-chatbot-settings',
//         'hi_render_chatbot_admin_page',
//         'dashicons-format-chat',
//         27
//     );
// }
// add_action('admin_menu', 'hi_register_chatbot_admin_page');

function hi_render_chatbot_admin_page() {
    if (!current_user_can('manage_options')) return;

    if (isset($_POST['hi_chatbot_toggle_nonce']) && wp_verify_nonce($_POST['hi_chatbot_toggle_nonce'], 'hi_chatbot_toggle')) {
        set_theme_mod('hi_chatbot_enabled', isset($_POST['hi_chatbot_enabled']));
        echo '<div class="updated"><p>Chatbot setting saved.</p></div>';
    }

    $enabled = hi_chatbot_enabled();
    ?>
    <div class="wrap">
        <h1>Chatbot Widget</h1>
        <form method="post">
            <?php wp_nonce_field('hi_chatbot_toggle', 'hi_chatbot_toggle_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Chatbot Status</th>
                    <td>
                        <label>
                            <input type="checkbox" name="hi_chatbot_enabled" value="1" <?php checked($enabled, true); ?>>
                            Show the chatbot widget on the site
                        </label>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save'); ?>
        </form>
        <p>You can also toggle this from <a href="<?php echo esc_url(admin_url('customize.php?autofocus[section]=hi_chatbot_section')); ?>">Appearance &rarr; Customize &rarr; Chatbot Settings</a>.</p>
    </div>
    <?php
}

/* ---------------------------------------------------
 * Custom DB tables (inquiries + chatbot Q&A)
 * ------------------------------------------------- */
function hi_install_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $inquiries_table = $wpdb->prefix . 'hi_inquiries';
    $sql1 = "CREATE TABLE $inquiries_table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(191) NOT NULL,
        email VARCHAR(191) NOT NULL,
        mobile VARCHAR(50) NOT NULL,
        subject VARCHAR(191) NOT NULL,
        message TEXT NOT NULL,
        status VARCHAR(20) NOT NULL DEFAULT 'Pending',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta($sql1);

    $chatbot_table = $wpdb->prefix . 'hi_chatbot_qa';
    $sql2 = "CREATE TABLE $chatbot_table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        question TEXT NOT NULL,
        response TEXT NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    dbDelta($sql2);

    $count = $wpdb->get_var("SELECT COUNT(*) FROM $chatbot_table");
    if ((int) $count === 0) {
        $seed = hi_chatbot_seed_data();
        foreach ($seed as $row) {
            $wpdb->insert($chatbot_table, array(
                'question' => $row[0],
                'response' => $row[1],
            ));
        }
    }
}
register_activation_hook(__FILE__, 'hi_install_tables');

function hi_maybe_install_tables() {
    global $wpdb;
    $chatbot_table = $wpdb->prefix . 'hi_chatbot_qa';
    if ($wpdb->get_var("SHOW TABLES LIKE '$chatbot_table'") !== $chatbot_table) {
        hi_install_tables();
    }
}
add_action('after_switch_theme', 'hi_maybe_install_tables');

function hi_chatbot_seed_data() {
    $contact_url = home_url('/contact/');
    return array(
        array('hi, hello, hey, good morning, good afternoon, good evening, namaste', "Hello and welcome to Homeland Infinia! We are delighted to have you here. How may we assist you today — pricing, location, the virtual tour, or a site visit?"),
        array('price, rate, cost, pricing, budget, charges, payment plan, how much', "Homeland Infinia offers ultra-luxury vertical residences at New Chandigarh's most prestigious address, Eco City 2, Mullanpur. Please share your details on our Contact page and our team will get in touch with pricing."),
        array('location, address, where, situated, map, directions, near me', "Homeland Infinia is located in Eco City 2, Mullanpur, New Chandigarh — the newest story of Chandigarh's premium residential landscape."),
        array('tour, virtual, 3d, video, walkthrough, see project, images, photos', 'You can explore the property right now! Just close this chatbot window and click "Click Here for a Virtual Tour" on the homepage to launch the immersive 360° walkthrough.'),
        array('apartment, flat, unit, bhk, size, sqft, layout, floor plan', "Homeland Infinia offers thoughtfully designed vertical luxury residences. For detailed unit sizes and floor plans, please connect with our sales team via the Contact page."),
        array('amenities, facilities, features, infrastructure, clubhouse', "Homeland Infinia is being designed with premium infrastructure and curated lifestyle amenities to elevate everyday living. Full amenity details will be shared as we progress toward launch."),
        array('investment, returns, roi, rental, yield, profit, income', "Homeland Infinia presents a compelling investment opportunity backed by New Chandigarh's rapid growth trajectory. Our advisory team can walk you through the specifics."),
        array('booking, reserve, register, interested, book now', "We would be delighted to assist with your booking interest. Please share your contact details on our Contact page, and our team will personally follow up."),
        array('possession, delivery, completion, ready, when, launch date, handover', "Homeland Infinia is currently in its pre-launch phase. For the latest updates on possession timelines, please connect with our sales team directly."),
        array('developer, builder, homeland, about, who is behind, company, background', "Homeland Infinia is developed by Homeland Group, a name recognized for landmark developments across the region. Visit our About Us page to learn more about our legacy."),
        array('contact, phone, number, email, talk to someone, representative, agent', "You can reach our team directly through the <a href='" . esc_url($contact_url) . "'>Contact</a> page on this website."),
        array('brochure, catalogue, pdf, details, more information, send info', "A detailed brochure will be made available as the project progresses. Please share your details on our Contact page and we'll keep you updated."),
        array('why, unique, usp, special, advantage, benefits, why invest here', "Homeland Infinia stands apart as the newest story of Chandigarh — an architectural masterpiece bringing premium vertical living to Eco City 2, Mullanpur."),
        array('thank you, thanks, ok, okay, great, nice, good', "You're most welcome! Should you have any further questions about Homeland Infinia, feel free to ask."),
        array('bye, goodbye, see you, talk later', "Thank you for visiting Homeland Infinia! We look forward to welcoming you soon."),
        array('human, agent, real person, talk to representative, customer care', "Of course! Please share your contact details on our Contact page, and one of our representatives will personally get in touch with you."),
    );
}

/* ---------------------------------------------------
 * AJAX: Contact form submission
 * ------------------------------------------------- */
// function hi_handle_contact_submit() {
//     check_ajax_referer('hi_contact_nonce', 'nonce');

//     global $wpdb;
//     $name    = sanitize_text_field($_POST['name'] ?? '');
//     $email   = sanitize_email($_POST['email'] ?? '');
//     $mobile  = sanitize_text_field($_POST['mobile'] ?? '');
//     $subject = sanitize_text_field($_POST['subject'] ?? '');
//     $message = sanitize_textarea_field($_POST['message'] ?? '');

//     if (!$name || !$email || !$mobile || !$subject || !$message) {
//         wp_send_json_error(array('message' => 'Transmission failed. Please ensure all fields are correctly populated.'));
//     }

//     $table = $wpdb->prefix . 'hi_inquiries';
//     $ok = $wpdb->insert($table, array(
//         'name'    => $name,
//         'email'   => $email,
//         'mobile'  => $mobile,
//         'subject' => $subject,
//         'message' => $message,
//         'status'  => 'Pending',
//     ));

//     if ($ok) {
//         $admin_email = get_option('admin_email');
//         $body = "New inquiry from $name ($email, $mobile)\nSubject: $subject\n\n$message";
//         wp_mail($admin_email, 'New Website Inquiry - ' . $subject, $body);

//         wp_send_json_success(array('message' => 'Thank you! Your inquiry has been transmitted successfully.'));
//     }

//     wp_send_json_error(array('message' => 'Transmission failed. Please ensure all fields are correctly populated.'));
// }
// add_action('wp_ajax_hi_submit_contact', 'hi_handle_contact_submit');
// add_action('wp_ajax_nopriv_hi_submit_contact', 'hi_handle_contact_submit');



/* =====================================================
 * Contact Form Handler + Dynamic Notification Emails
 * ===================================================== */

/* ---------------------------------------------------
 * 1. Settings: Register + Sanitize
 * ------------------------------------------------- */
function hi_register_contact_settings() {
    register_setting('hi_contact_settings_group', 'hi_contact_notify_emails', array(
        'sanitize_callback' => 'hi_sanitize_notify_emails',
        'default'           => get_option('admin_email'),
    ));
}
add_action('admin_init', 'hi_register_contact_settings');

function hi_sanitize_notify_emails($input) {
    $emails = array_map('trim', explode(',', $input));
    $valid  = array();

    foreach ($emails as $email) {
        if (is_email($email)) {
            $valid[] = sanitize_email($email);
        }
    }

    // Fallback to admin email if nothing valid was entered
    if (empty($valid)) {
        $valid[] = get_option('admin_email');
    }

    return implode(', ', $valid);
}

/* ---------------------------------------------------
 * 2. Settings: Admin Menu Page
 * ------------------------------------------------- */
function hi_add_contact_settings_page() {
    add_options_page(
        'Contact Form Emails',
        'Contact Form Emails',
        'manage_options',
        'hi-contact-settings',
        'hi_render_contact_settings_page'
    );
}
add_action('admin_menu', 'hi_add_contact_settings_page');

function hi_render_contact_settings_page() {
    ?>
    <div class="wrap">
        <h1>Contact Form Notification Emails</h1>
        <form method="post" action="options.php">
            <?php settings_fields('hi_contact_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Recipient Email(s)</th>
                    <td>
                        <input type="text"
                               name="hi_contact_notify_emails"
                               value="<?php echo esc_attr(get_option('hi_contact_notify_emails', get_option('admin_email'))); ?>"
                               class="regular-text" />
                        <p class="description">
                            Separate multiple emails with commas. e.g.
                            <code>sales@example.com, support@example.com</code>
                        </p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/* ---------------------------------------------------
 * 3. AJAX: Contact form submission
 * ------------------------------------------------- */
function hi_handle_contact_submit() {
    check_ajax_referer('hi_contact_nonce', 'nonce');

    global $wpdb;
    $name    = sanitize_text_field($_POST['name'] ?? '');
    $email   = sanitize_email($_POST['email'] ?? '');
    $mobile  = sanitize_text_field($_POST['mobile'] ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (!$name || !$email || !$mobile || !$subject || !$message) {
        wp_send_json_error(array('message' => 'Transmission failed. Please ensure all fields are correctly populated.'));
    }

    $table = $wpdb->prefix . 'hi_inquiries';
    $ok = $wpdb->insert($table, array(
        'name'    => $name,
        'email'   => $email,
        'mobile'  => $mobile,
        'subject' => $subject,
        'message' => $message,
        'status'  => 'Pending',
    ));

    // if ($ok) {
    //     // Pull dynamic recipient list from Settings → Contact Form Emails
    //     $to_raw = get_option('hi_contact_notify_emails', get_option('admin_email'));
    //     $to     = array_map('trim', explode(',', $to_raw));

    //     $email_subject = 'New Inquiry From Homeland Infinia Website- ' . $subject;

    //     $email_body  = "<h2>New Inquiry Received From Contact From</h2>";
    //     $email_body .= "<p><strong>Name:</strong> {$name}</p>";
    //     $email_body .= "<p><strong>Email:</strong> {$email}</p>";
    //     $email_body .= "<p><strong>Mobile:</strong> {$mobile}</p>";
    //     $email_body .= "<p><strong>Subject:</strong> {$subject}</p>";
    //     $email_body .= "<p><strong>Message:</strong><br>" . nl2br($message) . "</p>";

    //     $headers = array(
    //         'Content-Type: text/html; charset=UTF-8',
    //         'Reply-To: ' . $name . ' <' . $email . '>',
    //     );

    //     wp_mail($to, $email_subject, $email_body, $headers);

    //     wp_send_json_success(array('message' => 'Thank you! Your inquiry has been transmitted successfully.'));
    // }

    if ($ok) {
        // Pull dynamic recipient list from Settings → Contact Form Emails
        $to_raw = get_option('hi_contact_notify_emails', get_option('admin_email'));
        $to     = array_map('trim', explode(',', $to_raw));

        $email_subject = 'New Inquiry From Homeland Infinia Website - ' . $subject;

        $email_body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
        </head>
            <body style="margin:0; padding:0; background-color:#f4f4f4; font-family: Arial, Helvetica, sans-serif;">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
                    <tr>
                        <td align="center">
                            <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

                                <!-- Header -->
                                <tr>
                                    <td style="background-color:#1a1a1a; padding:28px 32px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <h1 style="margin:0; color:#ffffff; font-size:20px; letter-spacing:1px; font-weight:600;">HOMELAND INFINIA</h1>
                                                    <p style="margin:4px 0 0; color:#c9a875; font-size:12px; letter-spacing:2px; text-transform:uppercase;">New Website Inquiry</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Subject strip -->
                                <tr>
                                    <td style="background-color:#c9a875; padding:14px 32px;">
                                        <p style="margin:0; color:#1a1a1a; font-size:14px; font-weight:600;">' . esc_html($subject) . '</p>
                                    </td>
                                </tr>

                                <!-- Body -->
                                <tr>
                                    <td style="padding:32px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">

                                            <tr>
                                                <td style="padding-bottom:16px; border-bottom:1px solid #eeeeee;">
                                                    <p style="margin:0 0 4px; color:#999999; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Name</p>
                                                    <p style="margin:0; color:#1a1a1a; font-size:15px; font-weight:600;">' . esc_html($name) . '</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom:16px; border-bottom:1px solid #eeeeee;">
                                                    <p style="margin:0 0 4px; color:#999999; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Email</p>
                                                    <p style="margin:0; color:#1a1a1a; font-size:14px;">
                                                        <a href="mailto:' . esc_attr($email) . '" style="color:#1a1a1a; text-decoration:none;">' . esc_html($email) . '</a>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom:16px; border-bottom:1px solid #eeeeee;">
                                                    <p style="margin:0 0 4px; color:#999999; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Mobile</p>
                                                    <p style="margin:0; color:#1a1a1a; font-size:14px;">
                                                        <a href="tel:' . esc_attr($mobile) . '" style="color:#1a1a1a; text-decoration:none;">' . esc_html($mobile) . '</a>
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:16px;">
                                                    <p style="margin:0 0 8px; color:#999999; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Message</p>
                                                    <p style="margin:0; color:#333333; font-size:14px; line-height:1.6; background-color:#f9f7f4; padding:16px; border-radius:6px; border-left:3px solid #c9a875;">' . nl2br(esc_html($message)) . '</p>
                                                </td>
                                            </tr>

                                        </table>
                                    </td>
                                </tr>

                                <!-- CTA -->
                                <tr>
                                    <td style="padding:0 32px 32px;">
                                        <a href="mailto:' . esc_attr($email) . '" style="display:inline-block; background-color:#1a1a1a; color:#ffffff; text-decoration:none; padding:12px 28px; border-radius:4px; font-size:13px; font-weight:600; letter-spacing:0.5px;">Reply to ' . esc_html($name) . '</a>
                                    </td>
                                </tr>

                                <!-- Footer -->
                                <tr>
                                    <td style="background-color:#f9f7f4; padding:18px 32px; text-align:center;">
                                        <p style="margin:0; color:#999999; font-size:11px;">This inquiry was submitted via the Homeland Infinia website contact form.</p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>';

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'Reply-To: ' . $name . ' <' . $email . '>',
        );

        wp_mail($to, $email_subject, $email_body, $headers);

        wp_send_json_success(array('message' => 'Thank you! Your inquiry has been transmitted successfully.'));
    }

    wp_send_json_error(array('message' => 'Transmission failed. Please ensure all fields are correctly populated.'));
}
add_action('wp_ajax_hi_submit_contact', 'hi_handle_contact_submit');
add_action('wp_ajax_nopriv_hi_submit_contact', 'hi_handle_contact_submit');

/* ---------------------------------------------------
 * AJAX: Chatbot message handler (same keyword-scoring logic as before)
 * ------------------------------------------------- */
function hi_handle_chatbot_message() {
    check_ajax_referer('hi_chatbot_nonce', 'nonce');

    if (!hi_chatbot_enabled()) {
        echo "The chatbot is currently unavailable. Please use our <a href='" . esc_url(home_url('/contact/')) . "'>Contact</a> page instead.";
        wp_die();
    }

    global $wpdb;
    $fallback = "Sorry, I couldn't understand your question. Please reach our team directly through the <a href='" . home_url('/contact/') . "'>Contact</a> page.";

    $message = isset($_POST['message']) ? trim(wp_unslash($_POST['message'])) : '';
    if ($message === '') {
        echo $fallback;
        wp_die();
    }

    $message = strtolower($message);
    $table = $wpdb->prefix . 'hi_chatbot_qa';
    $rows = $wpdb->get_results("SELECT question, response FROM $table");

    $bestMatch = null;
    $bestScore = 0;

    if ($rows) {
        foreach ($rows as $row) {
            $keywords = explode(',', strtolower($row->question));
            $score = 0;
            $matched = array();

            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if ($keyword === '' || strlen($keyword) < 2) continue;

                if (strlen($keyword) <= 2) {
                    if (strpos($message, $keyword) === 0
                        || preg_match('/\b' . preg_quote($keyword, '/') . '\b/', $message)
                        || preg_match('/^' . preg_quote($keyword, '/') . '+/', $message)) {
                        $score += 1.5;
                        $matched[] = $keyword;
                    }
                } else {
                    if (preg_match('/\b' . preg_quote($keyword, '/') . '\b/', $message)) {
                        $score += 1;
                        $matched[] = $keyword;
                    }
                }
            }

            if (!empty($matched)) {
                $score += count($matched) * 0.5;
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestMatch = $row->response;
                }
            }
        }
    }

    echo ($bestMatch !== null && $bestScore > 0) ? $bestMatch : $fallback;
    wp_die();
}
add_action('wp_ajax_hi_chatbot_message', 'hi_handle_chatbot_message');
add_action('wp_ajax_nopriv_hi_chatbot_message', 'hi_handle_chatbot_message');

/* ---------------------------------------------------
 * Admin: simple Inquiries list page
 * ------------------------------------------------- */
function hi_register_inquiries_admin_page() {
    add_menu_page(
        'Inquiries',
        'Inquiries',
        'manage_options',
        'hi-inquiries',
        'hi_render_inquiries_admin_page',
        'dashicons-email-alt',
        26
    );
}
add_action('admin_menu', 'hi_register_inquiries_admin_page');

// function hi_render_inquiries_admin_page() {
//     if (!current_user_can('manage_options')) return;
//     global $wpdb;
//     $table = $wpdb->prefix . 'hi_inquiries';

//     /* Handle status update */
//     if (isset($_POST['hi_inquiry_status_nonce'], $_POST['inquiry_id'], $_POST['status'])
//         && wp_verify_nonce($_POST['hi_inquiry_status_nonce'], 'hi_update_inquiry_status')) {

//         $inquiry_id = (int) $_POST['inquiry_id'];
//         $new_status = sanitize_text_field($_POST['status']);
//         $allowed_statuses = array('Pending', 'Resolved');

//         if (in_array($new_status, $allowed_statuses, true)) {
//             $wpdb->update($table, array('status' => $new_status), array('id' => $inquiry_id));
//             echo '<div class="notice notice-success is-dismissible"><p>Status updated to "' . esc_html($new_status) . '" for inquiry #' . $inquiry_id . '.</p></div>';
//         }
//     }

//     $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");
//     echo '<div class="wrap"><h1>Website Inquiries</h1>';
//     echo '<table class="widefat striped"><thead><tr><th>Date</th><th>Name</th><th>Email</th><th>Mobile</th><th>Subject</th><th>Message</th><th>Status</th><th>Change Status</th></tr></thead><tbody>';
//     if ($rows) {
//         foreach ($rows as $r) {
//             $badge_color = ($r->status === 'Resolved') ? '#10b981' : '#f59e0b';
//             printf(
//                 '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td><span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;color:#fff;background:%s;">%s</span></td><td>%s</td></tr>',
//                 esc_html($r->created_at),
//                 esc_html($r->name),
//                 esc_html($r->email),
//                 esc_html($r->mobile),
//                 esc_html($r->subject),
//                 esc_html($r->message),
//                 esc_attr($badge_color),
//                 esc_html($r->status),
//                 hi_get_status_change_form($r->id, $r->status)
//             );
//         }
//     } else {
//         echo '<tr><td colspan="8">No inquiries yet.</td></tr>';
//     }
//     echo '</tbody></table></div>';
// }

function hi_render_inquiries_admin_page() {
    if (!current_user_can('manage_options')) return;
    global $wpdb;
    $table = $wpdb->prefix . 'hi_inquiries';

    /* Handle status update */
    if (isset($_POST['hi_inquiry_status_nonce'], $_POST['inquiry_id'], $_POST['status'])
        && wp_verify_nonce($_POST['hi_inquiry_status_nonce'], 'hi_update_inquiry_status')) {

        $inquiry_id = (int) $_POST['inquiry_id'];
        $new_status = sanitize_text_field($_POST['status']);
        $allowed_statuses = array('Pending', 'Resolved');

        if (in_array($new_status, $allowed_statuses, true)) {
            $wpdb->update($table, array('status' => $new_status), array('id' => $inquiry_id));
            echo '<div class="notice notice-success is-dismissible"><p>Status updated to "' . esc_html($new_status) . '" for inquiry #' . $inquiry_id . '.</p></div>';
        }
    }

    /* Handle Inquiry Deletion */
    if (isset($_POST['hi_delete_inquiry_nonce'], $_POST['delete_inquiry_id'])
        && wp_verify_nonce($_POST['hi_delete_inquiry_nonce'], 'hi_delete_inquiry_action')) {
        
        $delete_id = (int) $_POST['delete_inquiry_id'];
        $wpdb->delete($table, array('id' => $delete_id), array('%d'));
        echo '<div class="notice notice-warning is-dismissible"><p>Inquiry #' . $delete_id . ' has been successfully deleted.</p></div>';
    }

    $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC");
    
    // Minimal dashboard styling for our View Modal & action button consistency
    echo '<style>
        .hi-actions-cell { display: flex; gap: 8px; align-items: center; }
        .hi-view-btn { background: #2271b1; color: #fff; border: none; padding: 4px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 500; }
        .hi-view-btn:hover { background: #135e96; }
        .hi-delete-form { margin: 0; display: inline; }
        .hi-delete-btn { background: #d63638; color: #fff; border: none; padding: 4px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; font-weight: 500; }
        .hi-delete-btn:hover { background: #b32d2e; }
        /* Modal Window Styles */
        .hi-modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 99999; justify-content: center; align-items: center; }
        .hi-modal-content { background: #fff; padding: 25px; border-radius: 8px; max-width: 500px; width: 90%; box-shadow: 0 4px 20px rgba(0,0,0,0.15); position: relative; }
        .hi-modal-close { position: absolute; top: 12px; right: 15px; font-size: 20px; cursor: pointer; color: #666; font-weight: bold; }
        .hi-modal-close:hover { color: #000; }
        .hi-modal-body p { font-size: 14px; margin: 12px 0; line-height: 1.5; border-bottom: 1px solid #eee; padding-bottom: 8px; }
        .hi-modal-body strong { color: #1a2b3c; display: inline-block; width: 90px; }
    </style>';

    echo '<div class="wrap"><h1>Website Inquiries</h1>';
    echo '<table class="widefat striped"><thead><tr><th>Date</th><th>Name</th><th>Email</th><th>Mobile</th><th>Subject</th><th>Status</th><th>Change Status</th><th>Actions</th></tr></thead><tbody>';
    
    if ($rows) {
        foreach ($rows as $r) {
            $badge_color = ($r->status === 'Resolved') ? '#10b981' : '#f59e0b';
            
            // Build raw JS dataset safe attributes for our modal injector
            $inquiry_json = esc_attr(wp_json_encode(array(
                'date'    => $r->created_at,
                'name'    => $r->name,
                'email'   => $r->email,
                'mobile'  => $r->mobile,
                'subject' => $r->subject,
                'message' => $r->message
            )));

            // Delete action element wrapper with verification fallback
            $delete_form = sprintf(
                '<form method="POST" class="hi-delete-form" onsubmit="return confirm(\'Are you absolutely sure you want to delete this inquiry?\');">
                    %s
                    <input type="hidden" name="delete_inquiry_id" value="%d" />
                    <button type="submit" class="hi-delete-btn">Delete</button>
                </form>',
                wp_nonce_field('hi_delete_inquiry_action', 'hi_delete_inquiry_nonce', true, false),
                (int) $r->id
            );

            // Reconstructed view action button
            $view_button = sprintf(
                '<button type="button" class="hi-view-btn" onclick=\'hiOpenInquiryModal(%s)\'>View</button>',
                $inquiry_json
            );

            printf(
                '<tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                    <td><span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;color:#fff;background:%s;">%s</span></td>
                    <td>%s</td>
                    <td><div class="hi-actions-cell">%s %s</div></td>
                </tr>',
                esc_html($r->created_at),
                esc_html($r->name),
                esc_html($r->email),
                esc_html($r->mobile),
                esc_html($r->subject),
                esc_attr($badge_color),
                esc_html($r->status),
                hi_get_status_change_form($r->id, $r->status),
                $view_button,
                $delete_form
            );
        }
    } else {
        echo '<tr><td colspan="8">No inquiries yet.</td></tr>';
    }
    echo '</tbody></table></div>';

    /* View Lightbox Modal Structure Markup Injection */
    echo '
    <div id="hiInquiryModal" class="hi-modal-overlay" onclick="hiCloseInquiryModal(event)">
        <div class="hi-modal-content" onclick="event.stopPropagation()">
            <span class="hi-modal-close" onclick="document.getElementById(\'hiInquiryModal\').style.display=\'none\'">&times;</span>
            <h2 style="margin-top:0; border-bottom:2px solid #1a2b3c; padding-bottom:10px;">Inquiry Details</h2>
            <div class="hi-modal-body" id="hiModalBody"></div>
        </div>
    </div>';

    /* JavaScript Injector logic for structural values binding */
    echo '
    <script type="text/javascript">
        function hiOpenInquiryModal(data) {
            var body = document.getElementById("hiModalBody");
            body.innerHTML = 
                "<p><strong>Date:</strong> " + data.date + "</p>" +
                "<p><strong>Name:</strong> " + data.name + "</p>" +
                "<p><strong>Email:</strong> " + data.email + "</p>" +
                "<p><strong>Mobile:</strong> " + data.mobile + "</p>" +
                "<p><strong>Subject:</strong> " + data.subject + "</p>" +
                "<div style=\'margin-top:15px;\'><p style=\'border:none; margin-bottom:5px;\'><strong>Message:</strong></p>" +
                "<div style=\'background:#f5f5f5; padding:12px; border-radius:4px; border-left:3px solid #2271b1; white-space:pre-wrap; font-size:13px;\'>" + data.message + "</div></div>";
            document.getElementById("hiInquiryModal").style.display = "flex";
        }
        function hiCloseInquiryModal(e) {
            document.getElementById("hiInquiryModal").style.display = "none";
        }
    </script>';
}

function hi_get_status_change_form($id, $current_status) {
    ob_start();
    ?>
    <form method="post" style="display:flex; gap:6px; align-items:center;">
        <?php wp_nonce_field('hi_update_inquiry_status', 'hi_inquiry_status_nonce'); ?>
        <input type="hidden" name="inquiry_id" value="<?php echo esc_attr($id); ?>">
        <select name="status" style="font-size:12px;">
            <option value="Pending" <?php selected($current_status, 'Pending'); ?>>Pending</option>
            <option value="Resolved" <?php selected($current_status, 'Resolved'); ?>>Resolved</option>
        </select>
        <button type="submit" class="button button-small">Update</button>
    </form>
    <?php
    return ob_get_clean();
}

/* ---------------------------------------------------
 * Dashboard widget: recent inquiries with status change
 * ------------------------------------------------- */
function hi_register_inquiries_dashboard_widget() {
    wp_add_dashboard_widget(
        'hi_inquiries_dashboard_widget',
        'Recent Website Inquiries',
        'hi_render_inquiries_dashboard_widget'
    );
}
add_action('wp_dashboard_setup', 'hi_register_inquiries_dashboard_widget');

function hi_render_inquiries_dashboard_widget() {
    if (!current_user_can('manage_options')) return;
    global $wpdb;
    $table = $wpdb->prefix . 'hi_inquiries';

    /* Handle status update from the dashboard widget (same nonce action as the main page) */
    if (isset($_POST['hi_inquiry_status_nonce'], $_POST['inquiry_id'], $_POST['status'])
        && wp_verify_nonce($_POST['hi_inquiry_status_nonce'], 'hi_update_inquiry_status')) {

        $inquiry_id = (int) $_POST['inquiry_id'];
        $new_status = sanitize_text_field($_POST['status']);
        $allowed_statuses = array('Pending', 'Resolved');

        if (in_array($new_status, $allowed_statuses, true)) {
            $wpdb->update($table, array('status' => $new_status), array('id' => $inquiry_id));
            echo '<div class="notice notice-success is-dismissible"><p>Status updated to "' . esc_html($new_status) . '".</p></div>';
        }
    }

    $pending_count = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table WHERE status = 'Pending'");
    $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC LIMIT 5");
    ?>
    <p>
        <strong><?php echo $pending_count; ?></strong> pending inquir<?php echo $pending_count === 1 ? 'y' : 'ies'; ?>.
        <a href="<?php echo esc_url(admin_url('admin.php?page=hi-inquiries')); ?>">View all &rarr;</a>
    </p>

    <?php if ($rows): ?>
        <table class="widefat striped" style="margin-top:10px;">
            <thead>
                <tr><th>Name</th><th>Subject</th><th>Status</th></tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r):
                    $badge_color = ($r->status === 'Resolved') ? '#10b981' : '#f59e0b';
                ?>
                    <tr>
                        <td>
                            <strong><?php echo esc_html($r->name); ?></strong><br>
                            <span style="color:#787c82; font-size:12px;"><?php echo esc_html($r->email); ?></span>
                        </td>
                        <td><?php echo esc_html(wp_trim_words($r->subject, 6)); ?></td>
                        <td>
                            <span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;color:#fff;background:<?php echo esc_attr($badge_color); ?>;">
                                <?php echo esc_html($r->status); ?>
                            </span>
                        </td>
                        <!-- <td><?php echo hi_get_status_change_form($r->id, $r->status); ?></td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No inquiries yet.</p>
    <?php endif; ?>
    <?php
}

/* ---------------------------------------------------
 * Blog: excerpt length
 * ------------------------------------------------- */
function hi_custom_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'hi_custom_excerpt_length');