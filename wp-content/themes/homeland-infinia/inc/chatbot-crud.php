<?php
/**
 * Chatbot Q&A CRUD admin screen
 * wp-admin sidebar -> "Chatbot Q&A"
 *
 * Table: wp_hi_chatbot_qa (question = comma-separated keywords, response = HTML answer)
 */

if (!defined('ABSPATH')) exit;

function hi_register_chatbot_qa_admin_page() {
    add_menu_page(
        'Chatbot Q&A',
        'Chatbot Q&A',
        'manage_options',
        'hi-chatbot-qa',
        'hi_render_chatbot_qa_admin_page',
        'dashicons-editor-help',
        28
    );
}
add_action('admin_menu', 'hi_register_chatbot_qa_admin_page');

function hi_render_chatbot_qa_admin_page() {
    if (!current_user_can('manage_options')) return;

    global $wpdb;
    $table = $wpdb->prefix . 'hi_chatbot_qa';

    /* ---------------------------------------------------
     * Handle Delete
     * ------------------------------------------------- */
    if (isset($_GET['action'], $_GET['id'], $_GET['_wpnonce']) && $_GET['action'] === 'delete') {
        $id = (int) $_GET['id'];
        if (wp_verify_nonce($_GET['_wpnonce'], 'hi_chatbot_qa_delete_' . $id)) {
            $wpdb->delete($table, array('id' => $id));
            echo '<div class="notice notice-success is-dismissible"><p>Q&A pair deleted.</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>Security check failed. Nothing was deleted.</p></div>';
        }
    }

    /* ---------------------------------------------------
     * Handle Add / Update
     * ------------------------------------------------- */
    $editing_row = null;

    if (isset($_POST['hi_chatbot_qa_nonce']) && wp_verify_nonce($_POST['hi_chatbot_qa_nonce'], 'hi_chatbot_qa_save')) {
        $question = sanitize_textarea_field($_POST['question'] ?? '');
        $response = wp_kses_post($_POST['response'] ?? '');
        $id       = isset($_POST['qa_id']) ? (int) $_POST['qa_id'] : 0;

        if ($question === '' || $response === '') {
            echo '<div class="notice notice-error"><p>Both Keywords and Response are required.</p></div>';
        } else {
            if ($id > 0) {
                $wpdb->update($table, array('question' => $question, 'response' => $response), array('id' => $id));
                echo '<div class="notice notice-success is-dismissible"><p>Q&A pair updated.</p></div>';
            } else {
                $wpdb->insert($table, array('question' => $question, 'response' => $response));
                echo '<div class="notice notice-success is-dismissible"><p>Q&A pair added.</p></div>';
            }
        }
    }

    /* ---------------------------------------------------
     * Load row for editing (?edit=ID)
     * ------------------------------------------------- */
    if (isset($_GET['edit'])) {
        $edit_id = (int) $_GET['edit'];
        $editing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %d", $edit_id));
    }

    $rows = $wpdb->get_results("SELECT * FROM $table ORDER BY id DESC");
    ?>
    <div class="wrap">
        <h1><?php echo $editing_row ? 'Edit Q&A Pair' : 'Add New Q&A Pair'; ?></h1>

        <form method="post" style="max-width: 800px; background:#fff; padding:20px; border:1px solid #ccd0d4; margin-bottom:30px;">
            <?php wp_nonce_field('hi_chatbot_qa_save', 'hi_chatbot_qa_nonce'); ?>
            <input type="hidden" name="qa_id" value="<?php echo $editing_row ? esc_attr($editing_row->id) : ''; ?>">

            <table class="form-table">
                <tr>
                    <th scope="row"><label for="question">Keywords</label></th>
                    <td>
                        <textarea name="question" id="question" rows="2" class="large-text" required><?php echo $editing_row ? esc_textarea($editing_row->question) : ''; ?></textarea>
                        <p class="description">Comma-separated keywords/phrases that trigger this answer. Example: <code>price, rate, cost, pricing, budget</code></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="response">Response</label></th>
                    <td>
                        <textarea name="response" id="response" rows="5" class="large-text" required><?php echo $editing_row ? esc_textarea($editing_row->response) : ''; ?></textarea>
                        <p class="description">The chatbot's reply. Basic HTML like <code>&lt;a href=""&gt;</code> is allowed.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button($editing_row ? 'Update Q&A Pair' : 'Add Q&A Pair'); ?>
            <?php if ($editing_row): ?>
                <a href="<?php echo esc_url(admin_url('admin.php?page=hi-chatbot-qa')); ?>" class="button">Cancel Edit</a>
            <?php endif; ?>
        </form>

        <h2>Existing Q&A Pairs (<?php echo count($rows); ?>)</h2>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th style="width: 35%;">Keywords</th>
                    <th>Response</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($rows): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?php echo esc_html(wp_trim_words($row->question, 12)); ?></td>
                            <td><?php echo wp_kses_post(wp_trim_words($row->response, 20)); ?></td>
                            <td>
                                <a href="<?php echo esc_url(admin_url('admin.php?page=hi-chatbot-qa&edit=' . $row->id)); ?>">Edit</a>
                                |
                                <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=hi-chatbot-qa&action=delete&id=' . $row->id), 'hi_chatbot_qa_delete_' . $row->id)); ?>"
                                   onclick="return confirm('Delete this Q&A pair? This cannot be undone.');"
                                   style="color:#b32d2e;">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3">No Q&A pairs yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}