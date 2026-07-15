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

@media (min-width: 993px) and  (max-width: 1024px){
    .values-list-right {
           grid-auto-flow: row !important;
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
    padding: 5rem 10px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 3rem;
    text-align: center;
}

.stat-item h3 {
    font-size: clamp(2.5rem, 4vw, 1.5rem);
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
/* Center the main section heading */
.stats-heading {
  text-align: center;
  margin-bottom: 2rem;
  font-size: 2rem;
  text-transform: uppercase;
}

/* Optional: Clean grid styling for the stat items */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  text-align: center;
}

.stat-item h3 {
  font-size: 2.2rem;
  margin-bottom: 0.5rem;
}

.stat-item p {
  font-size: 1rem;
  color: #ffffff;
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
.none{
    display:none;
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
                    <h1 class="about-title">Homeland Infinia: Where Every View Inspires Every Day</h1>
                    
                    <p class="about-text">
                        Homeland Infinia is the newest landmark by Homeland Group, thoughtfully designed to redefine luxury living in New Chandigarh. Overlooking the iconic PCA Cricket Stadium, Infinia offers Grandstand View Residences that combine architectural excellence, premium amenities, and seamless connectivity in one exceptional address. 
                    </p>

                    <p class="about-text">
                        Crafted for discerning homeowners, Homeland Infinia is more than a residence - it's a lifestyle destination where every detail reflects sophistication, comfort, and timeless elegance. From expansive living spaces to curated recreational experiences, every element has been designed to elevate everyday living.
                    </p>
                    <p> Backed by Homeland Group's legacy of delivering premium developments across the Tricity, Homeland Infinia stands as a symbol of trust, innovation, and uncompromising quality.
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
                    <span class="section-subtitle">Mission & Values</span>
                    <h2 style="font-size: 42px; line-height: 1.2; margin-top: 10px; margin-bottom: 20px; color: var(--primary-color);">Our Mission & Values</h2>
                    <!-- <p class="about-text" style="font-size: 16px;"></p> -->
                </div>

                <div class="values-list-right ">
                    <div class="value-row " >
                        <div class="value-icon " >⚡</div>
                        <div class="value-info">
                            <h3>Visionary Design</h3>
                            <p>
                                Every residence is thoughtfully planned with contemporary architecture, spacious layouts, premium finishes, and breathtaking grandstand views, creating homes that are both timeless and functional.
                            </p>
                        </div>
                    </div>
                    <div class="value-row">
                        <div class="value-icon">🔍</div>
                        <div class="value-info">
                            <h3>Uncompromising Quality</h3>
                            <p>From construction excellence to carefully selected materials, every aspect of Homeland Infinia reflects our commitment to delivering superior craftsmanship and lasting value
                            </p>
                        </div>
                    </div>
                    <div class="value-row">
                        <div class="value-icon">⏱️</div>
                        <div class="value-info">
                            <h3>Lifestyle Beyond Expectations</h3>
                            <p>Experience an elevated way of life with world-class amenities, landscaped open spaces, wellness facilities, recreational zones, and community-centric living designed for every generation.
                            </p>
                        </div>
                    </div>
                    <div class="value-row">
                        <div class="value-icon">🌱</div>
                        <div class="value-info">
                            <h3>Trust & Transparency</h3>
                            <p>Built on the legacy of Homeland Group, we uphold the highest standards of integrity, timely delivery, and customer-first service, ensuring complete confidence throughout your homeownership journey.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <section class="stats-section">
  <!-- Heading centered at the top -->
  <h2 class="stats-heading">OUR ACHIEVEMENTS</h2>
  
  <div class="stats-grid">
    <div class="stat-item">
      <h3>13+</h3>
      <p >Years of Trusted Excellence</p>
    </div>
    <div class="stat-item">
      <h3>1,000+</h3>
      <p >Happy Families Across Homeland Developments</p>
    </div>
    <div class="stat-item">
      <h3>10.5+ Million</h3>
      <p >Sq. Ft. of Premium Developments Delivered & Under Development</p>
    </div>
    <div class="stat-item">
      <h3>One Vision</h3>
      <p >Creating Landmark Communities Across the Tricity</p>
    </div>
  </div>
</section>

    <section class="brand-story">
        <div class="container">
            <div class="story-header-top">
                <span class="section-subtitle">Our Story</span>
                <h2>Crafting Landmarks. Creating Legacies.</h2>
                <p class="story-desc">Since its inception, Homeland Group has been committed to developing destinations that redefine urban living. With every project, we have combined thoughtful planning, exceptional architecture, and customer-centric design to build communities that stand the test of time.
<br><br>Homeland Infinia represents the next chapter in this journey - a premium residential destination overlooking the iconic PCA Stadium in New Chandigarh. Designed to offer unmatched views, modern conveniences, and a refined lifestyle, Infinia reflects our vision of creating homes that are as inspiring as the people who live in them.
</p>
            </div>

            <div class="story-split-layout">
                
                <div class="story-single-image-wrapper">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/homeland-heights.webp'); ?>" alt="Homeland Managed Modern Architecture">
                </div>

                <div class="story-scroll-container">
                    <div class="timeline-compact-list">
                        
                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2013</span>
                            <div class="compact-card-content">
                                <h4>The Homeland Vision Begins</h4>
                                <p>Homeland Group embarks on a mission to create premium residential and commercial destinations that transform modern urban living.</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2014</span>
                            <div class="compact-card-content">
                                <h4>Building Trust</h4>
                                <p>Successful delivery of landmark developments strengthens Homeland's reputation for quality, transparency, and customer satisfaction.
</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2021</span>
                            <div class="compact-card-content">
                                <h4>Expanding Horizons</h4>
                                <p>Homeland continues to shape the Tricity skyline with thoughtfully designed communities, premium amenities, and future-ready infrastructure.
</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2024</span>
                            <div class="compact-card-content">
                                <h4>The Vision of Infinia</h4>
                                <p>Homeland Infinia is envisioned as a signature luxury address overlooking the iconic PCA Cricket Stadium, introducing Grandstand View Residences to New Chandigarh.

</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">2026</span>
                            <div class="compact-card-content">
                                <h4>Homeland Infinia Unveiled</h4>
                                <p>The launch of Homeland Infinia marks a new era of elevated living, combining premium architecture, curated lifestyle amenities, and an unmatched location in New Chandigarh.</p>
                            </div>
                        </div>

                        <div class="timeline-compact-card">
                            <span class="compact-year-pill">The Future</span>
                            <div class="compact-card-content">
                                <h4>Building Tomorrow's Landmarks</h4>
                                <p>With innovation, sustainability, and customer experience at the heart of every development, Homeland Group continues to create iconic destinations that inspire generations.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>