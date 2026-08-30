/**************************
 * m20T1 JavaScript
**************************/

"use strict";

// Declare Global Variables and settings
const siteUri = Object.freeze(document.getElementById('SiteURI').getAttribute('href')),
    themeUri = `${siteUri}wp-content/themes/m20T1/`;

// Create a translusent color variable based on the primary color in theme.json
(() => {
    const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--wp--preset--color--primary').trim();
    document.documentElement.style.setProperty('--primary-color-translucent', primaryColor + 'aa');
})();

// Improve the behavior of input types
(() => {
    const inputNum = document.getElementsByTagName("input"), l = inputNum.length;
	
    for (let i = 0; i < l; i++) {
        let inputAttrib = inputNum[i].getAttribute("type");
        
        // Custom charset for input[type="number"] and input[type="tel"]        
        if (inputAttrib === "number" || inputAttrib === "tel") {
            // Accept only numbers and relative chars
            inputNum[i].onkeypress = () => event.charCode >= 40 && event.charCode <= 57;
        }
        // Custom charset for input[type="email"] and input[type="url"]
        if (inputAttrib === "email" || inputAttrib === "url") {
            // Accept everything but spaces
            inputNum[i].onkeypress = () => event.charCode >= 33 && event.charCode <= 122;
        }
        // Change the value of the output[for] element based on the range element
        if (inputAttrib === "range") {
            inputNum[i].oninput = function() {
                let out = this.nextElementSibling;
                if (out.getElementsByTagName("output") && out.getAttribute("for") == this.getAttribute("id")) {
                    out.value = this.value;          
                }
            }
        }
        // Enforce a "maxlength" on all input elements
        inputNum[i].onkeyup = function() {
            if (this.value.length > this.maxLength && this.maxLength > 0) {
                this.value = this.value.slice(0,this.maxLength);
            }
        }
    }
})();

// Keyboard on Keyup Events
document.addEventListener("keyup", (e) => {
	e = e || window.event;
    if (e.keyCode === 27) { // Esc Key
        closeModals('dialog-html');
    }
    if (e.keyCode === 13) { // Enter Key
        closeModals('dialog-alert');
    }
},false);

// Dark mode button switch
(() => {
	let buttonText, theme;
	const currentTheme = localStorage.getItem("theme"),
        btnSwitch = document.getElementById("btnLightSwitch");
	
	// Get locally saved moode
	if (currentTheme == 'dark') document.body.classList.toggle('dark-mode');
	else if (currentTheme == 'light') document.body.classList.toggle('light-mode');
	
	// Set initial button title
	buttonText = (document.body.classList.contains('dark-mode')) ? 'light' : 'dark';
	btnSwitch.setAttribute("title", `Switch to ${buttonText} mode`);

	// Generate button switch logic
	btnSwitch.onclick = () => {
        // Check if user has browser pre-set to dark mode and set accordingly
        /*
        const isDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
		if (isDarkMode.matches) {
			document.body.classList.toggle('light-mode');
			document.body.classList.toggle('dark-mode');
			theme = document.body.classList.contains("light-mode") ? 'light' : 'dark';
		} else {
        */
			document.body.classList.toggle('dark-mode');
			theme = document.body.classList.contains('dark-mode') ? 'dark' : 'light';
		//}

		// Set button title
		buttonText = (document.body.classList.contains('dark-mode')) ? 'light' : 'dark';
		btnSwitch.setAttribute("title", `Switch to ${buttonText} mode`);

        if (buttonText == 'dark') {
            btnSwitch.innerHTML = "<div class='wp-block-icon'><svg style='width:40px;' aria-hidden='true' focusable='false'  xmlns='http://www.w3.org/2000/svg' width='1024' height='1024' viewBox='0 0 1024 1024'><path d='M349 242c0 242 165 438 370 438 51 0 99-12 143-34a378 378 0 11-507-480c-4 25-6 50-6 76z'/></svg></div>";
        } else {
            btnSwitch.innerHTML = "<div class='wp-block-icon'><svg style='width:40px;' aria-hidden='true' focusable='false'  xmlns='http://www.w3.org/2000/svg' width='1024' height='1024' viewBox='0 0 1024 1024'><path d='M257 528a240 240 0 10480 0 240 240 0 00-480 0zm240-408l-67 135h135zm288 119l-143 47 96 96zm-433 47l-143-47 47 143zM223 459L88 527l135 67zm546 138l135-68-135-67zM497 936l67-135H429zm145-166l143 47-47-143zm-433 47l143-47-96-96z'/></svg></div>";
        }
		
		// Store last used state
        localStorage.setItem("theme", theme);
	}	
})();

// Embedded YouTube video iframe automatic lazy loading
(() => {
    const youtube = document.getElementsByClassName("embed-youtube"),
        st = document.createElement("style"), 
        l = youtube.length;

    for (let i = 0; i < l; i++) {
        const image = new Image();

        image.src = `https://img.youtube.com/vi/${youtube[i].dataset.embed}/sddefault.jpg`; // alt: sddefault, hqdefault, maxresdefault
        image.alt = "Load YouTube video";
        image.decoding = "defer";
        image.fetchpriority = "low";
        image.loading = "lazy";
        image.addEventListener("load", function(){youtube[i].appendChild(image)}(i));

        youtube[i].addEventListener("click", function() {
            const iframe = document.createElement("iframe");
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allow", "accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture;web-share");
            iframe.setAttribute("allowfullscreen", "");
            iframe.setAttribute("referrerpolicy", "strict-origin-when-cross-origin");
            iframe.setAttribute("loading", "lazy");
            iframe.setAttribute("role", "presentation");
            iframe.setAttribute("src", `https://www.youtube.com/embed/${this.dataset.embed}?&autoplay=1&feature=oembed`);
            this.innerHTML = "";
            this.appendChild(iframe);
        });
    }

    // Append stylesheet if "youtube" exists
    if (l) {
        st.textContent = (`
        .wp-youtube {
            width: 100%;
        }
        .embed-youtube {
            width: 100%;
            position: relative;
            padding-top: 56.25%;
            overflow: hidden;
            transition: outline .5s;
            cursor: pointer;
            &:hover {
                outline: 4px solid #f00;
            }
        }
        .embed-youtube img {
            width: 100%;
            top: -17%;
        }
        .embed-youtube .play-button {
            width: 6em;
            height: 4em;
            background: #2228;
            box-shadow: 0 0 8px 0 #000c;
            z-index: 1;
            border-radius: .8em;
            transition: background .5s;
            &::before {
                content: "";
                border-style: solid;
                border-width: 15px 0 15px 26px;
                border-color: transparent transparent transparent #fff;
            }
        }
        .embed-youtube:hover .play-button {
            opacity: 1;   
            background: #f00c;
        }
        .embed-youtube img, .embed-youtube iframe, .embed-youtube .play-button, .embed-youtube .play-button::before {
            position: absolute;
        }
        .embed-youtube .play-button, .embed-youtube .play-button::before {
            top: 50%;
            left: 50%;
            translate: -50% -50% 0;
        }
        .embed-youtube iframe {
            background-color: #222;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        `);
        document.body.appendChild(st);
    }
})();

// Parallaxing hero header background
(() => {
    const par = document.getElementsByClassName("hero-parallax");
    document.addEventListener("scroll", function() {
        let posy = (-window.scrollY / 25) + 50;
        par[0].style.backgroundPosition = `50% ${posy.toFixed(1)}%`;
    },true);

    const parR = document.getElementsByClassName("hero-reflection");
    document.addEventListener("scroll", function() {
        let posy = (-window.scrollY / 25) - 52;
        parR[0].style.backgroundPosition = `50% ${posy.toFixed(1)}%`;
    },true);
})();

// Improve WordPress parallaxing backgrounds, any element with class="has-parallax"
(() => {
    const par = document.getElementsByClassName("has-parallax"), l = par.length;
    document.addEventListener("scroll", function() {
        for (let i = 0; i < l; i++) {
            let posy = (-window.scrollY + getElOffsetY(par[i])) / 50;
            par[i].style.backgroundRepeat = 'repeat';
            par[i].style.backgroundAttachment = 'scroll';
            par[i].style.backgroundPosition = `50% ${posy.toFixed(1)}%`;
        }
    },true);
})();

// Get an element's Y position on the page
function getElOffsetY(el) {
    return el.getBoundingClientRect().top + window.scrollY;
}

// Hamburger button and menu animation
(() => {
    const id = document.getElementById("btnMenu"),
        st = document.createElement("style");

    id.innerHTML = '';
    id.appendChild(document.createElement("span"));
    id.appendChild(document.createElement("span"));

    // Button Logic
    id.onclick = function() {
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
        padding: .2em;
        overflow: hidden;
        border: 0;
        background: none;
    }
    #btnMenu span {
        display: block;
        height: 4px;
        width: 2.2em;
        background: #000;
        margin: .5em 0;
        border-radius: .8em;
        transition: margin .2s ease-in-out;
    }
    #btnMenu:hover span, 
    #btnMenu:focus span {
        margin: .7em 0 .4em 0;
        &:first-of-type {
            margin-top: .3em;
        }
        &:last-of-type {
            margin-bottom: .3em;
        }
    }
    #btnMenu.active span {
        transition: rotate .25s ease-in-out;
        width: 2.5em;
        margin: -3px;
        &:first-of-type {
            rotate:45deg;
        }
        &:last-of-type {
            rotate:-45deg;
        }
    }
    `);
    document.body.appendChild(st);
})();

// Checks the position of the window focus
document.addEventListener("scroll", function() {
    const el = document.getElementById("ScrollToTop");
    window.pageYOffset > 500 ? el.classList.add("scActive") : el.classList.remove("scActive");
},true);

// Creates floating scroll to top button
(() => {
    const sc = document.createElement("div"), 
        st = document.createElement('style');

    sc.setAttribute("id", "ScrollToTop");
    sc.setAttribute("class", "scroll-to-top-float");
    sc.setAttribute("role", "button");
    //sc.setAttribute("onclick", "smoothScroll(0,100)");
    sc.setAttribute("onclick", "scrollToTop()");
    document.body.appendChild(sc);
	
	// Button styling
	st.textContent = (`
	.scroll-to-top-float {
        z-index: 201;
		position: fixed;
		visibility: hidden;
		opacity: 0;
		right: 1.1em;
		bottom: 1.6em;
		width: 40px;
		height: 40px;
        border: 1px solid #fff;
		border-radius: .2em;
		font-size: 1.5em;
		cursor: pointer;
		transition: all .25s ease-in-out 0s;
		background: no-repeat center center / 1em;
		background-image: url("data:image/svg+xml;charset=utf-8,<svg xmlns='http://www.w3.org/2000/svg' width='40' height='40'><path d='M6.461 29.71L2.242 25.49l18-18 18 18-4.218 4.219-13.782-13.781z' fill='white'/></svg>");
		background-color: #0005;
        backdrop-filter: blur(2px);
        &:hover {
            background-color: #0008; 
            scale: 1.1;
        }
        &:active {
            background-color: #0009;
        }
        &.scActive {
            visibility: visible;
            opacity: 1;
        }
        @media (max-width: 812px) {
            display: none;
        }
        @media only print {
            display: none;
        }
	}
	`);
	document.body.appendChild(st);
})();

// Smooth scrolling back to the top of the page
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/**************************
 * Modals and Dialogs Logic
**************************/

// Load an external JS document and display it in a modal window
function HtmlModal(c, v) {
	const style = document.createElement('style'),
        dialog = document.createElement('dialog'),
        headerDiv = document.createElement('header'),
		innerDiv = document.createElement('div'),
        tempID = document.getElementById(v),
        tempClone = tempID.content.cloneNode(true);

	// Dialog frame
	dialog.setAttribute('class', `dialog-html dialog-${c}`);
	dialog.setAttribute('role', 'dialog');
	dialog.setAttribute('open', 'open');

	// Dialog close button
	headerDiv.setAttribute('class', 'dialog-header');
	headerDiv.innerHTML = `<button class="dialog-close-button" onclick="closeModals('dialog-${c}')" aria-label="Close this modal"></button>`;

	// Dialog body
	innerDiv.setAttribute('class', 'dialog-content');
    innerDiv.setAttribute('role', 'document');
    innerDiv.appendChild(tempClone);

	// Dialog style
	style.textContent = (`
	.disable-scroll {
		overflow: hidden;
		height: auto;
	}
	.dialog-html {
		width: 100vw;
		height: 100vh;
        overflow: hidden;
		background-color: #eeee;
		border: none;
		opacity: 0;
		transition: opacity .2s ease-in-out;
        backdrop-filter: blur(3px);
	}
    .dialog-html h3 {
        margin: 0;
    }
	.dialog-header {
		max-width: 70vw;
		padding: 1.1em;
		margin: 0 auto 0 auto;
        position: relative;
        @media (max-width:812px) {
            max-width: 99%;
            margin: 0 auto;
        }
	}
	.dialog-content {
		max-width: 70vw;
		min-height: 9em;
		max-height: 85vh;
		margin: 1vh auto 0 auto;
		padding: 1em;
        border-radius: 8px;
		background-color: #fdfdfd;
		box-shadow: 0 10px 14px -7px #000b, 5px 5px 16px 5px #0000;
        scale: 0.8;
        translate: 0 -100px;
		transition: all .25s ease-in-out;
        overflow-y: auto;
        @media (max-width:812px) {
            max-width: 99%;
            margin: 1vh auto;
            max-height: 85vh
        }
	}
	.dialog-close-button {
		position: absolute;
		width: 1.3em;
		height: 1.3em;
		padding: 1.4em;
		right: 0;
		top: 0;
		border: none;
		filter: drop-shadow(1px 1px 2px #0004);
		background: transparent no-repeat center center / 1.5em;
		background-image: url("data:image/svg+xml;charset=utf-8,<svg xmlns='http://www.w3.org/2000/svg' width='30' height='30'><path d='M30 24l-9-9 9-9-6-6-9 9-9-9-6 6 9 9-9 9 6 6 9-9 9 9z'/></svg>");
        &:hover {
            background-color: transparent;
            filter: invert() drop-shadow(0 0 10px #0004);
        }
        &:focus:hover {
            filter: none;
        }
        &:active {
            opacity: .5;
        }
    }
	.dialog-open {
		opacity: 1;
        & > div {
            scale: 1;
            translate: 0;
        }
	}
	.dialog-close {
        transition: opacity .15s ease-out 0s;
        opacity: 0;
	}
	`);

    // Append Elements
	dialog.appendChild(headerDiv);
	dialog.appendChild(innerDiv);
	dialog.appendChild(style);
	document.body.appendChild(dialog);

	// Display dialog with transition
	setTimeout(() => { dialog.classList.add("dialog-open") }, 150);
}

// Close all open dialog nodes specific "c = ClassName"
function closeModals(c) {
    const dialog = document.getElementsByClassName(c),
        l = dialog.length;
    if (l) {
        for (let i = 0; i < l; i++) {
            document.body.classList.remove("disable-scroll");
            dialog[i].classList.add("dialog-close");
            dialog[i].addEventListener('transitionend', () => dialog[i].style.display = 'none');
        }
    }
}

// Converts an integer to roman numerals
function toRoman(num) {
    const numerals = {M:1000,CM:900,D:500,CD:400,C:100,XC:90,L:50,XL:40,X:10,IX:9,V:5,IV:4,I:1};
    let result = '';
    num = parseInt(num);
    for (const key in numerals) {
        while (num >= numerals[key]) {
            result += key;
            num -= numerals[key];
        }
    }
    return result;
}

// Detect the client time of day
const timeOfDayGreeting = function() {
    const hour = new Date().getHours();
    if (hour >= 5 && hour < 12) {
        return "morning";
    } else if (hour >= 12 && hour < 17) {
        return "afternoon";
    } else if (hour >= 17 && hour < 21) {
        return "evening";
    } else {
        return "night";
    }
}
// Add a class to the body element based on the time of day
document.body.classList.add(`time-${timeOfDayGreeting()}`);

// Fade-in and shifting effect for elements when they enter the viewport on scrolling
document.addEventListener("DOMContentLoaded", function () {
    const fadeElements = document.querySelectorAll(".fade-in");
    const observerOptions = {
        root: null,
        rootMargin: "0px 0px -50px 0px",
        threshold: 0.15
    };
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    fadeElements.forEach(element => observer.observe(element));
});