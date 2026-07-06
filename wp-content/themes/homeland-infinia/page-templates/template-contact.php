<?php
/**
 * Template Name: Contact Us
 */
get_header();
?>
<video class="bg-video-layer bg-video-dim" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/homeland_bg_video.mp4'); ?>" autoplay loop muted playsinline webkit-playsinline></video>

<main class="contact-main-layout">
    <div class="info-side">
        <h2>We'd love to<br>hear from you.</h2>
        <p>Leave us your details and our team will reach out.</p>
        <div class="contact-details">
            <div class="detail-item">
                <strong>Phone</strong>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/whatsapp-icon.png'); ?>" width="16" alt="WhatsApp">
                <a href="https://wa.me/919988976767">+91 99889 76767</a>
                <!-- <br>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/call-icon.png'); ?>" width="16" alt="Call">
                <a href="tel:+919988976767">+91 99889 76767</a> -->
            </div>
            <div class="detail-item">
                <strong>Contact For</strong>
                <a href="mailto:marketing@homelandgroup.org">marketing@homelandgroup.org</a><br>
                <a href="mailto:enquiry@homelandgroup.org">enquiry@homelandgroup.org</a>
            </div>
            <div class="detail-item"><strong>Working Hours</strong>Mon – Sat: 10:00 AM – 6:00 PM<br>Sunday: By Appointment</div>
        </div>
    </div>

    <div class="form-side">
        <div id="hi-form-alert" class="alert"></div>

        <form id="hi-contact-form" method="POST">
            <div class="input-group"><input type="text" name="name" required><label>Your Name</label></div>
            <div class="form-grid">
                <div class="input-group"><input type="email" name="email" required><label>Email Address</label></div>
                <div class="input-group"><input type="text" name="mobile" required><label>Mobile Number</label></div>
            </div>
            <div class="input-group"><input type="text" name="subject" required><label>Subject Headline</label></div>
            <div class="input-group"><textarea name="message" required></textarea><label>Message / Inquiry</label></div>
            <button type="submit" class="submit-btn">Send Inquiry</button>
        </form>
    </div>
</main>

<?php get_footer(); ?>
