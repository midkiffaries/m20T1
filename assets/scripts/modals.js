/**************************
 * Modals JavaScript
**************************/

// Search modal content
const SearchModal = (`
<h3>Search</h3>
<div class="search-block search-modal">
    <form method="get" class="search-form" role="search" action="${siteUri}">
        <input type="search" class="search-input" name="s" value="" placeholder="Search blog posts, pages, etc." autocapitalize="none" autocorrect="off" accesskey="s" maxlength="255" pattern="[^'\x22]+" aria-label="Search Input" autofocus required><input type="submit" value="&nbsp;" class="button-square search-submit" aria-label="Submit Search">
    </form>
</div>
<style>
.dialog-search .dialog-content {
	border-radius: 1px;
	background: none;
	box-shadow: none;
	padding: 0;
}
.dialog-content h3 {
    margin: 0;
}
.dialog-content .search-input {
	width: calc(100% - 2em);
	font-size: 1.4em;
}
.dialog-content .search-submit {
	width: 2em;
	font-size: 1.4em;
	border-color: transparent;
}
</style>
`);

// Display Alert Modal Box -- text: displayed text | bgColor: background-color
function AlertModal(text, bgColor) {
    const dialog = document.createElement("dialog"), 
        st = document.createElement("style");

    // Main dialog box
    dialog.setAttribute("open", "open");
    dialog.setAttribute("class", "dialog-alert");
    dialog.setAttribute("role", "alertdialog");
    dialog.setAttribute("onclick", `closeModals('dialog-alert')`);
    dialog.appendChild(document.createTextNode(text));

    // Append style
    st.textContent = (`
    .dialog-alert {
        border: none;
        width: 100%;
        height: 2.8em;
        padding: 0.8em;
        text-align: center;
        font-size: 1.4em;
        opacity: 0;
        transition: opacity 0.15s ease-in-out 0s;
        background-color: ${bgColor};
    }
    .dialog-open {
        opacity: 1;
    }   
    .dialog-close {
        transition: opacity 0.15s ease-out 0s;
        opacity: 0;
    }    
    `);
    dialog.appendChild(st);

    // Append to page body
    document.body.appendChild(dialog);

    // Display dialog
    setTimeout(() => { dialog.classList.toggle("dialog-open") }, 100);
    setTimeout(() => { 
        dialog.classList.toggle("dialog-open"); 
        closeModals('dialog-alert') 
    }, 6000);
}

// Display Confirmation Modal Box -- text: displayed text | action: Yes button's action/function
function ConfirmModal(text, action) {
    const style = document.createElement("style"),
        dialog = document.createElement("dialog"),
        div = document.createElement("div"),
        p = document.createElement("p"),
        buttonYes = document.createElement("button"),
        buttonNo = document.createElement("button");

    // Dialog attributes
    dialog.setAttribute("open", "open");        
    dialog.setAttribute("class", "dialog-confirm");
    dialog.setAttribute("role", "alertdialog");
    dialog.appendChild(div);

    // Text
    div.appendChild(p);
    p.appendChild(document.createTextNode(text));

    // Button Yes
    div.appendChild(buttonYes);
    buttonYes.appendChild(document.createTextNode("Yes"));
    buttonYes.setAttribute("onclick", "closeModals('dialog-confirm');" + action);
    buttonYes.setAttribute("type", "button");
    buttonYes.setAttribute("autofocus", "autofocus");

    // Button No
    div.appendChild(buttonNo);
    buttonNo.appendChild(document.createTextNode("No"));
    buttonNo.setAttribute("onclick", "closeModals('dialog-confirm')");
    buttonNo.setAttribute("type", "button");
    
    // Append style
    style.textContent = (`
    .dialog-confirm {
        border: none;
        width: 100vw;
        height: 100%;
        background-color: rgba(255,255,255,0.6);
        opacity: 0;
        transition: opacity 0.16s ease-in-out 0s;
        -webkit-backdrop-filter: grayscale(40%);
        backdrop-filter: grayscale(40%);
    }
    .dialog-confirm div {
        max-width: 50vw;
        margin: 30vh auto 0 auto;
        padding: 1em;    
        transform: translate(0, -100%);
        background-color: #fff;
        box-shadow: 0 14px 14px -7px rgba(0,0,0,0.8), 5px 5px 18px 5px rgba(0,0,0,0);
        border: 1px solid #eee;
        text-align: right;
        overscroll-behavior-y: contain;
    }
    .dialog-confirm p {
        margin-top: 2px;
        font-size: 1.2em;
        text-align: left;
    }
    .dialog-confirm p::before {
        content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32'%3E%3Cpath d='M20.9 14.8q1.5-1.5 1.5-3.6 0-2.6-1.9-4.5T16 4.8q-2.6 0-4.5 1.9t-1.9 4.5h3.2q0-1.3 1-2.3 1-1 2.2-1 1.3 0 2.3 1 1 1 1 2.3 0 1.3-1 2.2l-2 2q-1.9 2.1-1.9 4.6v.8h3.2q0-2.5 1.9-4.5zm-3.3 12.4V24h-3.2v3.2zM16 0q6.6 0 11.3 4.7Q32 9.4 32 16q0 6.6-4.7 11.3Q22.6 32 16 32q-6.6 0-11.3-4.7Q0 22.6 0 16 0 9.4 4.7 4.7 9.4 0 16 0z'/%3E%3C/svg%3E");
        padding: 0 0.6em 1em 0;
        display: block;
        float: left;
    }
    .dialog-confirm button {
        margin-right: 0.9em;
        min-width: 5em;
    }   
    .dialog-open {
        opacity: 1;
    }
    .dialog-open div {
        transform: scale(1);
    }
    .dialog-close {
        transition: opacity 0.15s ease-out 0s;
        opacity: 0;
    }
    @media (max-width: 812px) {
        .dialog-confirm div {
            max-width: 99%;
        }
    }
    `);
    dialog.appendChild(style); 
    
    // Append to page body
    document.body.appendChild(dialog);

    // Display dialog with transition
	setTimeout(() => { dialog.classList.add("dialog-open") }, 140);
}

// Load an external JS document and display it in a modal window
function HtmlModal(c, v) {
	const style = document.createElement('style'),
        dialog = document.createElement('dialog'),
        headerDiv = document.createElement('header'),
		innerDiv = document.createElement('div');

	// Dialog frame
	dialog.setAttribute('class', `dialog-html dialog-${c}`);
	dialog.setAttribute('role', 'dialog');
	dialog.setAttribute('open', 'open');

	// Dialog close button
	headerDiv.setAttribute('class', 'dialog-header');
	headerDiv.innerHTML = `<button class="dialog-close-button" onclick="closeModals('dialog-${c}')" aria-label="Close this modal"></button>`;

	// Dialog body
	innerDiv.setAttribute('class', 'dialog-content');
	innerDiv.innerHTML = v;

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
		background-color: rgba(240,240,240,0.85);
		border: none;
		opacity: 0;
		transition: opacity 0.15s ease-in-out 0s;
        -webkit-backdrop-filter: blur(2px);
        backdrop-filter: blur(2px);
	}
	.dialog-header {
		max-width: 70vw;
		max-height: calc(85vh - 15vh);
		padding: 1.1em;
		margin: 0 auto 0 auto;
        position: relative;
	}
	.dialog-content {
		max-width: 70vw;
		min-height: 9em;
		max-height: calc(85vh - 15vh);
		margin: 1vh auto 0 auto;
		padding: 1em;
		background-color: #fdfdfd;
		box-shadow: 0px 10px 14px -7px rgba(0,0,0,0.7), 5px 5px 16px 5px rgba(0,0,0,0);
		transform: scale(0.8);
		transition: transform 0.15s ease-in-out 0s;
		overflow: hidden;
	}
	.dialog-close-button {
		position: absolute;
		width: 1.3em;
		height: 1.3em;
		padding: 1.4em;
		right: 0;
		top: 0;
		border: none;
		filter: drop-shadow(1px 1px 2px rgba(0,0,0,0.3));
		background: transparent no-repeat center center / 1.5em;
		background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30'%3E%3Cpath d='M30 24l-9-9 9-9-6-6-9 9-9-9-6 6 9 9-9 9 6 6 9-9 9 9z'/%3E%3C/svg%3E");
	}
    .dialog-close-button:hover {
        background-color: transparent;
        filter: invert() drop-shadow(0 0 10px rgba(0,0,0,0.3));
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
            margin: 0 auto;
        }
    }
	`);

    // Append Elements
	dialog.appendChild(headerDiv);
	dialog.appendChild(innerDiv);
	dialog.appendChild(style);
	document.body.appendChild(dialog);

	// Display dialog with transition
	setTimeout(() => { dialog.classList.add("dialog-open") }, 140);
}

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

// Check field
const checkField = v => {
	if (!v.value) v.classList.add("message-error");
	else v.classList.remove("message-error");
}

// Sanitize user input
const sanitizeInput = v => {
	if (v) return v.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').trim();
	else return null;
}

// Validate user inputed email address
const validateEmail = v => {
    const mailhash = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (v.match(mailhash)) return true;
    else return false;
}

// Contact Form - Process email and send it
/*
function phpSendEmail() {
    const xhttp = new XMLHttpRequest();

	// Setup the form field variables
	const Email = {
		nameID: document.getElementById("contact_name"),
		name: () => {
			return sanitizeInput(Email.nameID.value)
		},
		emailID: document.getElementById("contact_email"),
		email: () => {
			return sanitizeInput(Email.emailID.value)
		},
		messageID: document.getElementById("contact_message"),
		message: () => {
			return sanitizeInput(Email.messageID.value)
		}
	}

	// Change the element class onfocus
	Email.nameID.addEventListener("focus", function(e){this.classList.remove("message-error");});	
	Email.emailID.addEventListener("focus", function(e){this.classList.remove("message-error");});	
	Email.messageID.addEventListener("focus", function(e){this.classList.remove("message-error");});

	// Check if fields are filled in
	checkField(Email.nameID);
	checkField(Email.emailID);
	checkField(Email.messageID);

    xhttp.onload = function() {
        if (Email.name() && validateEmail(Email.email()) && Email.message()) {
            let v = "name=" + Email.name() + 
			"&email=" + Email.email() + 
			"&message=" + Email.message();

            //document.getElementById("demo").innerHTML = this.responseText;
            console.log("Email successfully sent.");
            document.getElementById("ServerMessage").innerHTML = "Your message has been sent! <br />I will try and get back to you as soon as possible.";
            document.getElementById("MessageInfo").classList.add('contact_success');
            document.getElementById("contact_fieldset").disabled = true;
        } else {
            document.getElementById("ServerMessage").innerHTML = "You need to fill in all the fields to send this message.";
        }
    }
    xhttp.open("GET", `${themeUri}assets/plugins/mailman.php?${v}`, true);
    xhttp.send();
}
*/
// Improve the behavior of certain input types
function checkInput() {
    const inputNum = document.getElementsByTagName("input"), l = inputNum.length;

	for (let i = 0; i < l; i++) {
        let inputAttrib = inputNum[i].getAttribute("type");
        // Custom charset for input[type="email"] and input[type="url"]
        if (inputAttrib === "email" || inputAttrib === "url") {
            // Accept everything but spaces
            inputNum[i].onkeypress = () => event.charCode >= 33 && event.charCode <= 122;
        }
    }	
}



// Ajax function
function loadHtmlModal(f, id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById(id).innerHTML = this.responseText;
    }
    xhttp.open("GET", `${f}`, true);
    xhttp.send();
}