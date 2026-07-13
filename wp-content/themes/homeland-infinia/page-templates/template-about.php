<?php
/**
 * Template Name: About Us
 */
get_header();
?>

<style>
/* --- Modern Scoped CSS for About Page --- */
:root {
    --primary-color: #1a2b3c;    /* Deep Luxury Slate Blue */
    --accent-color: #c5a880;     /* Warm Premium Gold */
    --text-dark: #222222;
    --text-muted: #666666;
    --bg-light: #f9f9f9;
    --border-color: #eeeeee;
    --transition-smooth: cubic-bezier(0.25, 1, 0.5, 1);
}

.about-page-wrap {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: var(--text-dark);
    line-height: 1.6;
    background-color: #ffffff;
    overflow-x: hidden;
        padding-top: 10%;
        position: relative;
        z-index: 2;
}


.about-page-wrap .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
}

footer {
    margin-top: 0px;
    background-color:white;
    max-width: 100%;
}
.disclaimer-text {
    font-size: clamp(0.65rem, 1.2vw, 0.72rem);
    color: #000000c2;
    max-width:1100px;
    margin: 0 auto;
    padding: 1rem 0rem;
}


.about-page-wrap .section-subtitle, 
.about-page-wrap .small-title {
    display: block;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--accent-color);
    font-weight: 600;
    margin-bottom: 1rem;
}

/* --- About Hero Section --- */
.about-hero {
    padding: 6rem 0;
    background-color: #ffffff00;
    .about-text{
         color: var(--text-muted);
    }
}

.about-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: 4rem;
    align-items: center;
}

.bg-video-dim{
    filter: brightness(0.2);
}
.about-title {
    font-size: clamp(2.2rem, 4vw, 3.5rem);
    font-weight: 700;
    line-height: 1.15;
    color: var(--primary-color);
    margin-bottom: 2rem;
    letter-spacing: -0.02em;
}

.about-text {
    font-size: 1.05rem;
    color: var(--text-muted);
    margin-bottom: 1.5rem;
}

.about-image img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 12px;
       box-shadow: 0 13px 30px rgb(0 0 0 / 23%);
    display: block;
}

/* --- Core Values Section (Sticky Left) --- */
.core-values {
    padding: 6rem 0;
    background-color: var(--bg-light);
    box-shadow: 0 -6px 7px -2px rgb(0 0 0 / 8%);
}

.values-split {
    display:block;
    grid-template-columns: 1fr 1.3fr;
    gap: 5rem;
}

.values-sticky-left {
    position: relative;
}

@media (min-width: 993px) {
    .values-sticky-left {
        position: sticky;
        top: 40px;
        height: max-content;
    }
}

.values-list-right {
    display: grid;
    gap: 2.5rem;
    grid-column: 4;
    flex-direction: row;
    align-items: stretch;
    grid-auto-flow: column;
}

.value-row {
    background: #ffffff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.02);
    border-left: 3px solid transparent;
    transition: all 0.3s var(--transition-smooth);
}

.value-row:hover {
    transform: translateX(5px);
    border-left-color: var(--accent-color);
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.value-icon {
    font-size: 2rem;
    line-height: 1;
}

.value-info h3 {
    font-size: 1.3rem;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.value-info p {
    color: var(--text-muted);
    margin: 0;
    font-size: 0.95rem;
}

/* --- Stats Counter Section --- */
.stats-section {
    background-color: var(--primary-color);
    color: #ffffff;
    padding: 5rem 0;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 3rem;
    text-align: center;
}

.stat-item h3 {
    font-size: clamp(2.5rem, 4vw, 3.5rem);
    font-weight: 700;
    color: var(--accent-color);
    margin-bottom: 0.5rem;
}

.stat-item p {
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
}

/* --- Redesigned Our Story Section (Single Image + Compact Scrollable Timeline) --- */
.brand-story {
    padding: 7rem 0;
    background-color: #ffffff;
}

.story-header-top {
    margin: 0 auto 5rem auto;
    text-align: center;
}

.story-header-top h2 {
    font-size: clamp(2rem, 3.5vw, 2.75rem);
    line-height: 1.2;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
}

.story-desc {
    font-size: 1.1rem;
    color: var(--text-muted);
}

.story-split-layout {
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    gap: 5rem;
    align-items: start;
}

/* Left Sticky Side - Single Image */
.story-single-image-wrapper {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.06);
    height: 520px;
}

@media (min-width: 993px) {
    .story-single-image-wrapper {
        position: sticky;
        top: 60px;
    }
}

.story-single-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    filter: brightness(0.9);
}

/* Right Scrollable Timeline Window */
.story-scroll-container {
    max-height: 520px; /* Perfectly matches the image height */
    overflow-y: auto;
    padding-right: 1.5rem;
}

/* Elegant Minimalist Scrollbar Design */
.story-scroll-container::-webkit-scrollbar {
    width: 4px;
}

.story-scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.story-scroll-container::-webkit-scrollbar-thumb {
    background: var(--accent-color);
    border-radius: 10px;
}

.timeline-compact-list {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.timeline-compact-card {
    background: var(--bg-light);
    border-radius: 8px;
    padding: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    border-left: 3px solid transparent;
    transition: all 0.3s var(--transition-smooth);
}

.timeline-compact-card:hover {
    background: #ffffff;
    border-left-color: var(--accent-color);
    box-shadow: 0 10px 25px rgba(0,0,0,0.04);
}

.compact-year-pill {
    background: var(--primary-color);
    color: #ffffff;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 0.3rem 0.8rem;
    border-radius: 4px;
    flex-shrink: 0;
}

.compact-card-content h4 {
    font-size: 1.1rem;
    margin: 0 0 0.35rem 0;
    color: var(--primary-color);
}

.compact-card-content p {
    font-size: 0.9rem;
    color: var(--text-muted);
    margin: 0;
    line-height: 1.45;
}

/* --- Responsive Adjustments --- */
@media (max-width: 992px) {
    .about-page-wrap {
            padding-top: 20%;
    }
    .about-grid, 
    .values-split, 
    .story-split-layout {
        grid-template-columns: 1fr;
        gap: 3.5rem;
    }
    
    .about-image {
        order: -1;
    }

    .about-image img {
        height: 350px;
    }

    .story-single-image-wrapper {
        height: 350px;
    }
    
    .story-scroll-container {
        max-height: none; /* Let content flow naturally on mobile devices */
        overflow-y: visible;
        padding-right: 0;
    }
    
    .about-hero, .core-values, .brand-story {
        padding: 4rem 0;
    }
    .values-list-right {
    display: grid;
    gap: 2.5rem;
    grid-column: 4;
    flex-direction: row;
    align-items: stretch;
    grid-auto-flow: row;
}
}
@media (max-width:768px) {
    .about-grid {
    display: block;
    }
}
</style>
<video class="bg-video-layer bg-video-dim" src="<?php echo esc_url(get_template_directory_uri() . '/assets/video/homeland_bg_video.mp4'); ?>" autoplay loop muted playsinline webkit-playsinline></video>
<div class="about-page-wrap">

    <section class="about-hero">
        <div class="container">
            <div class="about-grid">
                <div>
                    <div class="small-title">About Our Company</div>
                    <h1 class="about-title">Homeland: Big Dreams Through Exceptional Real Estate</h1>
                    
                    <p class="about-text">
                        Founded in 2016 by industry veterans Renaud Lerooy and Frédéric Remeur, Homeland has positioned itself from day one as a digitally native property management company that puts technology at the core of everything it does. 
                    </p>

                    <p class="about-text">
                        In our own words, we are <strong>“the syndic for demanding homeowners”</strong> – a condo manager that is responsive, available, transparent, and budget-conscious, thanks to a unique blend of human service and digital efficiency. Today, our network spans Paris, Brussels, and over 100 cities across the Île-de-France region.
                    </p>
                </div>

                <div class="about-image">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.jpeg'); ?>" alt="Homeland Office Space">
                </div>
            </div>
        </div>
    </section>

    <section class="core-values">
        <div class="container">
            <div class="values-split">
                <div class="values-sticky-left">
                    <span class="section-subtitle">Our Mission & Values</span>
                    <h2 style="font-size: 42px; line-height: 1.2; margin-top: 10px; margin-bottom: 20px; color: var(--primary-color);">A New Vision of Real Estate</h2>
                    <p class="about-text" style="font-size: 16px;">As a mission-driven company, Homeland pairs tailored expert guidance with strong social and environmental principles to best serve modern co-owners.</p>
                </div>

                <div class="values-list-right">
                    <div class="value-row">
                        <div class="value-icon">⚡</div>
                        <div class="value-info">
                            <h3>Innovation & Technology</h3>
                            <p>We pioneered a néo-syndic model, building custom digital platforms that automate routine administrative tasks and offer co-owners 24/7 visibility over building ops.</p>
                        </div>
                    </div>
                    <div class="value-row">
                        <div class="value-icon">🔍</div>
                        <div class="value-info">
                            <h3>Absolute Transparency</h3>
                            <p>All property financial data, invoices, and active maintenance logs live on our secure online portal. Supported by straightforward, highly competitive fee schedules.</p>
                        </div>
                    </div>
                    <div class="value-row">
                        <div class="value-icon">⏱️</div>
                        <div class="value-info">
                            <h3>Elite Responsiveness</h3>
                            <p>Our dedicated teams feature multi-disciplinary experts available throughout the workweek, tied to an active round-the-clock hotline that dispatches rapid emergency maintenance within hours.</p>
                        </div>
                    </div>
                    <div class="value-row">
                        <div class="value-icon">🌱</div>
                        <div class="value-info">
                            <h3>Eco-Responsibility</h3>
                            <p>We lead environmental overhauls and curb emissions via strategic green-energy implementation across every managed property.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item"><h3>850+</h3><p>Condominiums Managed</p></div>
                <div class="stat-item"><h3>40k</h3><p>Properties Under Management</p></div>
                <div class="stat-item"><h3>23%</h3><p>Average Operating Cost Reduction</p></div>
                <div class="stat-item"><h3>€11M+</h3><p>Funding Secured For Expansion</p></div>
            </div>
        </div>
    </section>

    <section class="brand-story">
        <div class="container">
            <div class="story-header-top">
                <span class="section-subtitle">Our Story</span>
                <h2>Creating Landmarks.<br>Building Trust Since 2016.</h2>
                <p class="story-desc">We believe every managed property should facilitate a modern, streamlined lifestyle. By pooling personalized expert guidance with agile technology, we have scaled our footprint while staying true to our founding promise.</p>
            </div>

            <div class="story-split-layout">
                
                <div class="story-single-image-wrapper">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/homeland-heights.webp'); ?>" alt="Homeland Managed Modern Architecture">
                </div>

                <div class="story-scroll-container">
                    <div class="timeline-compact-list">
                        
                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2016</span>
                            <div class="compact-card-content">
                                <h4>The Journey Began</h4>
                                <p>Homeland launched its digital-first property management platform, rethinking traditional real estate operations from the ground up.</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2019</span>
                            <div class="compact-card-content">
                                <h4>Seed Funding Injection</h4>
                                <p>Raised structural funding to ramp up software development capabilities and expand property operations regionally.</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2022</span>
                            <div class="compact-card-content">
                                <h4>Series A & International Growth</h4>
                                <p>Secured further expansion rounds, taking our innovative néo-syndic solutions into competitive international metropolitan networks.</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2023</span>
                            <div class="compact-card-content">
                                <h4>Massive Scale Milestones</h4>
                                <p>Successfully managed portfolios expanded cross-borders, onboarding thousands of co-owners into our digital ecosystem.</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2025</span>
                            <div class="compact-card-content">
                                <h4>Strategic Mergers</h4>
                                <p>Unified operations to build the ultimate property ecosystem across multi-tier city blocks and premium properties.</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">Today</span>
                            <div class="compact-card-content">
                                <h4>Looking Ahead</h4>
                                <p>Delivering smarter, sustainable property management solutions with built-in eco-responsibility initiatives designed for modern living.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>