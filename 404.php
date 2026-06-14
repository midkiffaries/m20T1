<?php defined( 'ABSPATH' ) || exit; // Exit if accessed directly ?>
<?php http_response_code(404); // Set 404 status code ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?=language_attributes();?> id="top-of-site">
<head>
<?=m20t1_head();?>
<?=wp_head();?>

<style>
:root{
    --cyan:#00ffff;
    --magenta:#ff0080;
    --green:#00ff88;
}

body{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#050505;
    color:#fff;
    font-family: ui-monospace, 'Source Code Pro', Menlo, Consolas, 'DejaVu Sans Mono', monospace;
    overflow:hidden;
}

/* Animated scanlines */
body::before{
    content:"";
    position:fixed;
    inset:0;
    background:repeating-linear-gradient(0deg, #FFFFFF08 0px, #FFFFFF08 1px, #0000 1px, #0000 3px);
    pointer-events:none;
    z-index:2;
}

/* CRT flicker */
body::after{
    content:"";
    position:fixed;
    inset:0;
    background:#FFFFFF08;
    animation:flicker .15s infinite;
    pointer-events:none;
    z-index:3;
}

.glitch-404{
    position:relative;
    display:inline-block;
    font-size:clamp(5rem,18vw,12rem);
    font-weight:900;
    line-height:1;
    text-transform:uppercase;
    color:#fff;
    text-shadow: 0 0 10px #FFFFFF08, 0 0 20px #FFFFFF08;
}

.glitch-404::before,
.glitch-404::after{
    content:attr(data-text);
    position:absolute;
    inset:0;
}

.glitch-404::before{
    left:2px;
    color:var(--cyan);
    clip-path:polygon(0 0,100% 0,100% 45%,0 45%);
    animation:glitch1 .8s infinite linear alternate-reverse;
    filter:blur(2px);
}

.glitch-404::after{
    left:-2px;
    color:var(--magenta);
    clip-path:polygon(0 60%,100% 60%,100% 100%,0 100%);
    animation:glitch2 .6s infinite linear alternate-reverse;
    filter:blur(2px);
}

.subtitle-404{
    margin:20px 0 10px;
    font-size:2.3rem;
    text-transform:uppercase;
    letter-spacing:.15em;
}

.message-404{
    color:#aaa;
    margin-bottom:35px;
    font-size:1.25rem !important;
	text-wrap: balance;
}

.search-form input[type="search"]{
    background:#111;
    border:1px solid #333;
    color:#fff;
    padding:12px 15px;
    min-width:280px;
    max-width:50vw;
}

.search-form input[type="search"]:focus{
    border:1px solid var(--cyan);
}

.search-form input[type="submit"]{
    background-color:var(--cyan);
    border:1px solid var(--cyan);
    padding:12px 20px;
}

.status-404{
    color:var(--green);
    margin-top:30px;
    font-size:1rem !important;
    letter-spacing:.15em;
}

.home-btn-404{
    display:inline-block;
    text-decoration:none;
    color:var(--green);
    border:1px solid var(--green);
    padding:12px 24px;
    transition:.3s;
    text-transform:uppercase;
    letter-spacing:.1em;
}

.home-btn-404:hover{
    background:var(--green);
    color:#000;
    box-shadow:0 0 20px var(--green);
}

.home-btn-404:active{
    background:var(--green);
    color:#000;
    box-shadow:0 0 8px var(--green);
}

@keyframes glitch1{
    0%{transform:translate(0);}
    20%{transform:translate(-3px,2px);}
    40%{transform:translate(3px,-2px);}
    60%{transform:translate(-2px,1px);}
    80%{transform:translate(2px,-1px);}
    100%{transform:translate(0);}
}

@keyframes glitch2{
    0%{transform:translate(0);}
    20%{transform:translate(3px,-2px);}
    40%{transform:translate(-3px,2px);}
    60%{transform:translate(2px,1px);}
    80%{transform:translate(-2px,-1px);}
    100%{transform:translate(0);}
}

@keyframes flicker{
    0%{opacity:.97;}
    50%{opacity:1;}
    100%{opacity:.95;}
}
</style>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/<?=custom_page_scheme(get_the_ID());?>">

<main class="page-main page-error width-full" id="main-content" itemscope itemtype="https://schema.org/Article" itemprop="mainEntity">
    <div class="page-content">
        <div class="page-404-container">
            <article class="page-404 page type-page not-found status-publish" id="page-404" itemscope itemtype="https://schema.org/NewsArticle">
                <div class="glitch-404" data-text="404">404</div>

                <h1 class="subtitle-404"><?=get_option('404_image') ? '<img src="'.esc_url(get_option('404_image')).'" loading="lazy" decoding="async" itemprop="image" alt="404 Error" fetchpriority="auto" style="max-width:500px">' : "Signal Lost";?></h1>

                <p class="message-404"><?=get_option('404_text') ? nl2br(clean_html(get_option('404_text'))) : "The page you're looking for has vanished into cyberspace.<br>It may have been moved, deleted, or never existed in this timeline."; // Error Message ?></p>

                <?=get_search_form('error'); // Search Form ?>

                <p class="status-404">SYSTEM STATUS: C:\PAGE_NOT_FOUND.EXE</p>

                <p><a class="home-btn-404" href="<?=esc_url(home_url('/'));?>">Return Home</a></p>
            </article>
        </div>
    </div>
</main>

<?php wp_footer(); ?>

</body>
</html>