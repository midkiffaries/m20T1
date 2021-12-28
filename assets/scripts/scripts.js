/**************************
 * Base JavaScript
**************************/

"use strict";

// Declare Global Variables and settings
const siteUri = Object.freeze(document.getElementById('SiteURI').getAttribute('href')),
    themeUri = `${siteUri}wp-content/themes/m20T1/`,
    TodaysDate = new Date(),
    Locale = 'en-US';

// Keyup Events
document.addEventListener("keyup", (e) => {
	e = e || window.event;
    if (e.keyCode === 27) { // Esc Key
        closeModals('dialog-html');
        closeModals('dialog-image');
    }
    if (e.keyCode === 13) { // Enter Key
        closeModals('dialog-alert');
    }
},false);

// Modal images with a nested <figure> <a> <img> tag inside
(function(){
    let fig = document.getElementsByTagName("figure"), 
        l = fig.length;

    for (let i = 0; i < l; i++) {
        if (fig[i].firstElementChild && fig[i].firstElementChild.tagName == "A") {
            fig[i].firstElementChild.addEventListener("click", function(e) {
                e.preventDefault();
				const style = document.createElement('style'),
					dialog = document.createElement('dialog'),
					headerDiv = document.createElement('header'),
					innerDiv = document.createElement('div'),
					imgAlt = this.firstElementChild.alt,
					imgName = this.href.substring(this.href.lastIndexOf('/') + 1).replace(/_/g," ").replace(/-/g," ").split('.')[0];

				// Dialog box attributes
                dialog.setAttribute('class', 'dialog-image');	
				dialog.setAttribute('role', 'dialog');
				dialog.setAttribute('open', 'open');

				// Dialog close button
				headerDiv.setAttribute('class', 'dialog-header');
				headerDiv.innerHTML = `<button class="dialog-close-button" onclick="closeModals('dialog-image')" aria-label="Close this modal"></button>`;
	
				// Dialog body
				innerDiv.setAttribute('class', 'dialog-content');
				innerDiv.innerHTML = (`
				<p class="dialog-body-image"><img src="${this.href}" alt="${imgName}"></p>
				<h4 class="dialog-body-header">${imgName}</h4>
				<p class="dialog-body-info">${imgAlt}</p>
				<p class="dialog-body-download"><a href="${this.href}">Download this image</a></p>
				`);
				
				// Dialog style
				style.textContent = (`
				.disable-scroll {	
					overflow: hidden;
					height: auto;
				}
				.dialog-image {
					width: 100vw;
					height: 100vh;
					background-color: rgba(30,30,30,0.94);
					border: none;
					opacity: 0;
                    overflow-y: scroll;
					transition: opacity 0.15s ease-in-out 0s;
                    -webkit-backdrop-filter: blur(3px) grayscale(50%);
                    backdrop-filter: blur(3px) grayscale(50%);
				}
				.dialog-header {
					max-width: 70vw;
					max-height: calc(85vh - 15vh);
					padding: 1.1em;
					margin: 0 auto;
				}
				.dialog-content {
					max-width: 70vw;
					min-height: 16em;
					max-height: calc(85vh - 15vh);
					margin: 1vh auto 0 auto;
					padding: 0;
					background-color: transparent;
					transform: scale(0.8);
					transition: transform 0.15s ease-in-out 0s;
				}
                .dialog-content img {
                    border: 1px solid #eee;
                    min-height: 10em;
                    box-shadow: 0 1px 6px 1px rgba(0,0,0,0.3);
                    background: no-repeat center center / 5em;
                    background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='64' height='64' viewBox='0 0 128 128'%3E%3Cg%3E%3Cpath fill='white' d='M64 10a54 54 0 00-54 54H0a64 64 0 01128 0h-10a54 54 0 00-54-54z'/%3E%3CanimateTransform attributeName='transform' dur='2s' from='0 64 64' repeatCount='indefinite' to='360 64 64' type='rotate'/%3E%3C/g%3E%3C/svg%3E");
                }
                .dialog-content h4 {
                    text-transform: uppercase;
                    letter-spacing: 0.08em;
                }
                .dialog-content h4,
                .dialog-content p  {
                    color: #fff;
                    text-align: center;
                    margin: 8px 0;
                }
				.dialog-close-button {
					position: fixed;
					width: 1.3em;
					height: 1.3em;
					padding: 1.4em;
					right: 1em;
					top: 0.5em;
					border: none;
					background: transparent no-repeat center center / 1.6em;
					background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30'%3E%3Cpath d='M30 24l-9-9 9-9-6-6-9 9-9-9-6 6 9 9-9 9 6 6 9-9 9 9z' fill='white'/%3E%3C/svg%3E");
				}
				.dialog-close-button:hover {
					opacity: 0.9;
					filter: drop-shadow(0 0 5px rgba(220,220,220,0.8));
				}
				.dialog-close-button:focus:hover {
					filter: none;
				}
				.dialog-close-button:active {
					opacity: 0.5;
				}
				.dialog-open {
					opacity: 1;
				}
				.dialog-open > div {
					transform: scale(1);
				}
				.dialog-close {
					transition: opacity 0.15s ease-out 0s;
					opacity: 0;
				}
				@media (max-width: 812px) {
					.dialog-content {
						max-width: 99%;
						margin: 1vh auto;
						max-height: 85vh
					}
					.dialog-header {
						max-width: 99%;
					}
				}
				`);
                // Display Dialog
				dialog.appendChild(headerDiv);
				dialog.appendChild(innerDiv);
				dialog.appendChild(style);
				document.body.appendChild(dialog);
				
                // Display Dialog with transition
                setTimeout(() => { dialog.classList.add("dialog-open") }, 140);
            },false);
        }
    }
}());

// Close all open dialog nodes specific "c = ClassName"
function closeModals(c) {
    let dialog = document.getElementsByClassName(c), 
        l = dialog.length;
    
    if (l) {
        for (let i = 0; i < l; i++) {
            document.body.classList.remove("disable-scroll");
            dialog[i].classList.add("dialog-close");
            setTimeout(() => { 
                dialog[i].parentNode.removeChild(dialog[i]);
            }, 150);
        }
    }
}

// Dark mode switch
(function(){
	let buttonText, theme;
	const isDarkMode = window.matchMedia("(prefers-color-scheme: dark)"),
		modeButton = document.querySelector(".light-switch"),
		currentTheme = localStorage.getItem("theme"),
        st = document.createElement("style");
	
	// Get locally saved moode
	if (currentTheme == 'dark') document.body.classList.toggle("dark-mode");
	else if (currentTheme == 'light') document.body.classList.toggle("light-mode");
	
	// Set initial button title
	buttonText = (document.body.classList.contains('dark-mode')) ? 'light':'dark';
	modeButton.setAttribute("title", `Switch to ${buttonText} mode`);
	
    // Append the light switch button style [class="light-switch"]
    st.textContent = (`
    .light-switch {
        background: transparent no-repeat 50% 50% / 2em;
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='1024' height='1024'%3E%3Cpath d='M349 242c0 242 165 438 370 438 51 0 99-12 143-34a378 378 0 11-507-480c-4 25-6 50-6 76z' fill='black'/%3E%3C/svg%3E");
    }
    body.dark-mode .light-switch {
        background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='1024' height='1024'%3E%3Cpath d='M257 528a240 240 0 10480 0 240 240 0 00-480 0zm240-408l-67 135h135zm288 119l-143 47 96 96zm-433 47l-143-47 47 143zM223 459L88 527l135 67zm546 138l135-68-135-67zM497 936l67-135H429zm145-166l143 47-47-143zm-433 47l143-47-96-96z' fill='black'/%3E%3C/svg%3E");
    }
    `);
    document.body.appendChild(st);

	// Generate button switch logic
	modeButton.onclick = () => {
		//if (isDarkMode.matches) {
		//	document.body.classList.toggle("light-mode");
		//	document.body.classList.toggle("dark-mode");
		//	theme = document.body.classList.contains("light-mode") ? "light":"dark";
		//} else {
			document.body.classList.toggle("dark-mode");
			theme = document.body.classList.contains("dark-mode") ? "dark":"light";
		//}
		
		// Set button title
		buttonText = (document.body.classList.contains('dark-mode')) ? 'light':'dark';
		modeButton.setAttribute("title", `Switch to ${buttonText} mode`);
		
		// Store last used state
        localStorage.setItem("theme", theme);
	}	
}());

// Embedded YouTube video iframe auto lazy loading
(function(){
    let st = document.createElement("style"), 
        youtube = document.getElementsByClassName("youtube"), 
        l = youtube.length;

    for (let i = 0; i < l; i++) {
        let source = `https://img.youtube.com/vi/${youtube[i].dataset.embed}/sddefault.jpg`;
        let image = new Image();
        image.src = source;
        image.alt = "Play YouTube video.";
        image.addEventListener("load", function(){youtube[i].appendChild(image)}(i));
        youtube[i].addEventListener("click", function() {
            let iframe = document.createElement("iframe");
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("loading", "lazy");
            iframe.setAttribute("allow", "accelerometer;autoplay;encrypted-media;gyroscope;picture-in-picture");
            iframe.setAttribute("allowfullscreen", "");
            iframe.setAttribute("src", `https://www.youtube.com/embed/${this.dataset.embed}?feature=oembed`);
            this.innerHTML = "";
            this.appendChild(iframe);
        });
    }

    // Append stylesheet if "youtube" exists
    if (l) {
        st.textContent = (`
        .youtube {
            width: 100%;
            position: relative;
            padding-top: 56.25%;
            overflow: hidden;
        }
        .youtube img {
            width: 100%;
            top: -17%;
            cursor: pointer;
        }
        .youtube button {
            width: 6em;
            height: 4em;
            background: rgba(50,50,50,0.4);
            box-shadow: 0 0 0.9em rgba(0,0,0,0.9);
            z-index: 1;
            opacity: 0.8;
            border-radius: 0.8em;
            transition: background 0.5s;
        }
        .youtube:hover button {
            opacity: 1;   
            background: rgba(255,30,30,0.7);
        }
        .youtube button::before {
            content: "";
            border-style: solid;
            border-width: 15px 0 15px 26px;
            border-color: transparent transparent transparent #fff;
        }
        .youtube img, .youtube iframe, .youtube button, .youtube button::before {
            position: absolute;
        }
        .youtube button, .youtube button::before {
            top: 50%;
            left: 50%;
            transform: translate3d(-50%, -50%, 0);
        }
        .youtube iframe {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        `);
        document.body.appendChild(st);
    }
}());

// Parallaxing backgrounds, use class="bg-parallax" and data-rate="10"
(function(){
    let par = document.getElementsByClassName("bg-parallax"), 
        l = par.length,
        posy = 0, 
        pr = 10;
    
    document.addEventListener("scroll", function() {
        for (let i = 0; i < l; i++) {
            pr = par[i].getAttribute("data-rate");
            posy =- (window.pageYOffset / pr);
            par[i].style.backgroundPosition = `50% ${posy}px`;
        }
    }, true);
}());

// Parallaxing elements, use class="element-parallax" and data-rate="12"
(function(){
    let par = document.getElementsByClassName("element-parallax"), 
        l = par.length,
        posy = 0, 
        pr = 12;
    
    document.addEventListener("scroll", function() {
        for (let i = 0; i < l; i++) {
            pr = par[i].getAttribute("data-rate");
            posy =- (window.pageYOffset / pr);
            par[i].style.transform = `translateY(${posy}px)`;
        }
    }, true);
}());

// Hamburger button and menu animation
(function(){
    const id = document.getElementById("btnMenu"),
        st = document.createElement("style");

    id.innerHTML = '';
    id.appendChild(document.createElement("span"));
    id.appendChild(document.createElement("span"));

    // Button Logic
    id.onclick = function () {
        // Button Animation        
        this.classList.toggle("active");
        // Button Action
        document.getElementById(this.getAttribute("data-menu-id")).classList.toggle("menu-show");
    };

    // Button styling
    st.textContent = (`
    #btnMenu {
        width: 2.6em;
        height: 2.6em;
        padding: 0.2em;
        overflow: hidden;
        border: 0;
        background: none;
    }
    #btnMenu span {
        display: block;
        height: 4px;
        width: 2.2em;
        background: #000;
        margin: 0.5em 0;
        border-radius: 0.8em;
        will-change: auto;
        transition: margin 0.2s ease-in-out;
    }
    #btnMenu:hover span, #btnMenu:focus span {
        margin: 0.7em 0 0.4em 0;
    }
    #btnMenu:hover span:first-of-type, #btnMenu:focus span:first-of-type {
        margin-top: 0.3em; 
    }
    #btnMenu:hover span:last-of-type, #btnMenu:focus span:last-of-type {
        margin-bottom: 0.3em; 
    }
    #btnMenu.active span {
        transition: transform 0.25s ease-in-out;
        width: 2.5em;
        margin: -3px;
    }
    #btnMenu.active span:first-of-type {
        transform: rotate(45deg);
    }
    #btnMenu.active span:last-of-type {
        transform: rotate(-45deg);
    }
    `);
    document.body.appendChild(st);
}());

// Checks the position of the window focus
document.addEventListener("scroll", function () {
    const el = document.getElementById("ScrollToTop");
	
    if (window.pageYOffset > 500) el.classList.add("scActive");
    else el.classList.remove("scActive");
},true);

// Creates floating scroll to top button
(function(){
    const sc = document.createElement("div"), 
        st = document.createElement('style');

    sc.setAttribute("id", "ScrollToTop");
    sc.setAttribute("class", "scroll-to-top-float");
    sc.setAttribute("role", "button");
    sc.setAttribute("onclick", "smoothScroll(0,100)");
    document.body.appendChild(sc);
	
	// Button styling
	st.textContent = (`
	.scroll-to-top-float {
		position: fixed;
		visibility: hidden;
		opacity: 0;
		right: 1em;
		bottom: 1em;
		width: 40px;
		height: 40px;
		border-radius: 0.2em;
		font-size: 2em;
		cursor: pointer;
		transition: all 0.25s ease-in-out 0s;
		will-change: transform;
		background: no-repeat center center / 1em;
		background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Cpath d='M6.461 29.71L2.242 25.49l18-18 18 18-4.218 4.219-13.782-13.781z' fill='white'/%3E%3C/svg%3E");
		background-color: rgba(0,0,0,0.3);
	}
	.scroll-to-top-float:hover {
		background-color: rgba(0,0,0,0.5); 
		transform: scale(1.1);
	}
	.scroll-to-top-float:active {
		background-color: rgba(0,0,0,0.7);
	}
	.scroll-to-top-float.scActive {
		visibility: visible;
		opacity: 1;
	}
	@media only print {
		.scroll-to-top-float {display: none;}
	}
	`);
	document.body.appendChild(st);
}());

// Smooth scrolling to the Top of the page
function smoothScroll(loc, duration) {
    let el, 
        diff, 
        perTick;
    
    // Check if the client is Safari
    if (document.body.scrollTop > 0) el = document.body; // Yes Safari
    else el = document.documentElement; // No Safari
    
    // Travel back to the top
	if (duration < 0) return;
	diff = loc - el.scrollTop;
    perTick = diff / duration * 2;
    setTimeout(() => {
        el.scrollTop += perTick;
        smoothScroll(loc, duration - 2);
    }, 10);
}