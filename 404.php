<?php get_header(); ?>

<main class="page-main page-error" id="main-content" role="main">
    <div class="page-content width-full">

<?php breadcrumb_trail(); ?>

<article class="page-404 page type-page not-found status-publish" id="page-404" name="page-404" role="article" itemscope itemtype="http://schema.org/NewsArticle">
    <div class="page-404-container">
        <div class="page-404-image">
            <svg class="logo-404" height="230" viewBox="0 0 114 50" width="428" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-label="404"><linearGradient id="a" gradientUnits="userSpaceOnUse" x1="104.6" x2="104.2" y1="33.1" y2="65"><stop offset="0" stop-color="#2a7fff"/><stop offset="1" stop-color="#2a7fff" stop-opacity="0.5"/></linearGradient><radialGradient id="b" cx="105.2" cy="59.6" gradientTransform="matrix(1.14621 -.0033 .00017 .0606 -16 56.5)" gradientUnits="userSpaceOnUse" r="57.3"><stop offset="0" stop-color="#ccc"/><stop offset="0.3" stop-color="#eee"/><stop offset="1" stop-color="#fff" stop-opacity="0"/></radialGradient><g transform="translate(-48 -14)"><ellipse cx="104.5" cy="59.8" fill="url(#b)" rx="56.6" ry="3.5"/><path d="m86.2 51.5h-4.5v8h-11v-8h-16.1v-8l17-25h10.2v24.8h4.5zm-15.4-8.2c0-3.6-.1-7.2.2-10.8-2.2 3.7-4.4 7-7 10.8zm47.7-68.1c0 5.3-.4 11-3.4 15.6-2.4 3.7-7 5.4-11.3 5.3-4.2.1-8.7-1.6-11-5.2a29 29 0 0 1 -3.8-16.7c.2-5.2.7-10.6 3.7-15 2.5-3.8 7.3-5.3 11.8-5 4.2 0 8.4 2 10.6 5.7 2.9 4.5 3.4 10 3.4 15.3zm-18.5 0c.1 3.4 0 6.9 1.1 10.1.5 1.7 2.8 2.7 4.3 1.5 1.7-1.6 1.7-4.3 2-6.5.2-4.6.4-9.3-.5-13.9-.3-1.6-1.4-3.7-3.4-3.4-2.1.2-2.8 2.6-3 4.4-.4 2.6-.5 5.2-.5 7.8zm53.2 76.3h-4.5v8h-10.9v-8h-16.3v-8l17-25h10.2v24.8h4.5zm-15.4-8.2c0-3.6 0-7.2.3-10.8l-7 10.8z" stroke="white" stroke-width="0.4"/><path id="svgBear" d="m112.6 17.8c9.3 3.8 14.9 11 15.4 20.3 0 12-10.7 21.7-23.9 21.7-13 0-23.7-9.7-23.7-21.7.2-9.4 7.8-17.4 15.3-20.3a25 25 0 0 1 16.9 0zm-8.4 20c-3 0-5.4 1.4-5.4 3.3 0 1.8 2.4 3.2 5.4 3.2s5.4-1.4 5.4-3.2c0-1.9-2.4-3.3-5.4-3.3zm6.7-8.4a2.8 2.8 0 1 0 0 5.6 2.8 2.8 0 0 0 0-5.6zm-13.3 0a2.8 2.8 0 1 0 0 5.6 2.8 2.8 0 0 0 0-5.6zm-8.6-15.2c2.4-.1 4.4 1.1 6 2.7-5.7 2-10.2 6.1-13 11.3-1.3-1.3-1.3-3.4-1.5-5 0-5 3.8-9 8.5-9zm30.7 0c-2.4-.1-4.3 1.1-6 2.7a24 24 0 0 1 13 11.3c1.3-1.4 1.4-3.4 1.5-5 0-5-3.8-9.1-8.5-9.1z" fill="url(#a)"/></g></svg>
            <style>
            #svgBear {
                transform-origin: 90% 95%;
                animation: rot 2s ease-in-out 0s alternate infinite;
            }
            @keyframes rot {
                0% { transform: rotate(-20deg) }
                100% { transform: rotate(20deg) }
            }
            </style>
        </div>
        <h2 class="page-title" id="error-page" itemprop="title">Page Not Found</h2>
        <div class="content-404">
            <p>Whoops... Well that page is gone.</p>
            <p>But real talk, the page must have been removed, renamed or didn't exist in the first place. 🤔</p>
            <?php get_search_form(); ?>
            
        </div>
    </div>
</article>

    </div>
</main>

<?php get_footer(); ?>