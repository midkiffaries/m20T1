/**************************
 * Modals JavaScript
**************************/

// Search modal content
const SearchModal = (`
<h3>Search</h3>
<section class="search-block search-modal">
    <form id="SearchForm" method="get" role="search" action="${OriginURL}">
        <input type="search" name="s" id="Search-Modal" value="" placeholder="Search..." autocapitalize="none" autocorrect="off" accesskey="s" maxlength="255" pattern="[^'\x22]+" aria-label="Search" autofocus required><input type="submit" value="&nbsp;" aria-label="Submit Search">
    </form>
</section>
<style>
.dialog-content h3 {
    margin: 0;
}
.dialog-content [type="search"] {
	width: calc(100% - 2em);
	font-size: 1.4em;
}
.dialog-content [type="submit"] {
	width: 2em;
	font-size: 1.4em;
}
</style>
`);

// Contact modal content
const ContactModal = (`
<h3>Contact</h3>
<section class="email-block">
    <form id="ContactForm" autocomplete="on" onsubmit="event.preventDefault()">
		<fieldset id="contact_fieldset">
			<p><label for="UserName">Name</label> <input type="text" name="name" id="contact_name" placeholder="Bob Smith" maxlength="100" inputmode="name" autocomplete="name" autocapitalize="words" autofocus required onfocus="checkInput()"><span class="contact_error"></span></p>
			<p><label for="UserEmail">Email</label> <input type="email" name="email" id="contact_email" placeholder="name@email.com" maxlength="100" inputmode="email" autocomplete="email" autocapitalize="none" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" onkeypress="emailCheck(this.id)" required><span class="contact_error"></span></p>
			<p><label for="UserMessage">Message</label> <textarea name="message" id="contact_message" placeholder="This is what I have to say..." required></textarea><span class="contact_error"></span></p>
			<p><input type="submit" value="Send Email" onclick="phpSendEmail()"></p>
		</fieldset>
    </form>
	<div class="contact_server"><p id="ServerMessage" class="contact_msg"></p></div>
</section>
<style>
.dialog-content h3 {
    margin: 0;
}
.dialog-content fieldset {
	border: none;
	padding: 0;
	margin: 0;
}
.dialog-content label {
	display: block;
}
.dialog-content [type="text"],
.dialog-content [type="email"],
.dialog-content textarea {
	width: 100%;
}
.dialog-content textarea {
	height: 10em;
	max-height: 20em;
}
.dialog-content [type="submit"] {
	font-size: 1.2em;
}
.dialog-content .contact_error::after {
	opacity: 0;
	display: inline-block;
	margin-left: 0.3rem;
	vertical-align: middle;
    content: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24'%3E%3Cpath d='M13.2 13.2V6h-2.4v7.2zm0 4.8v-2.4h-2.4V18zM12 0q5 0 8.5 3.5T24 12q0 5-3.5 8.5T12 24q-5 0-8.5-3.5T0 12q0-5 3.5-8.5T12 0z' fill='red'/%3E%3C/svg%3E");
	transition: opacity 0.3s ease-in-out 0s;
}
</style>
`);

// Setup the form field variables
/*
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
*/
// Change the element class onfocus
//Email.nameID.addEventListener("focus", function(e){this.classList.remove("message-error");});	
//Email.emailID.addEventListener("focus", function(e){this.classList.remove("message-error");});	
//Email.messageID.addEventListener("focus", function(e){this.classList.remove("message-error");});

// Check field
const checkField = v => {
	if (!v.value) {
		v.classList.add("message-error");
	} else {
		v.classList.remove("message-error");	
	}
}

// Sanitize user input
const sanitizeInput = v => {
	if (v) {
        return v.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').trim();
	} else {
		return null;
	}
}

// Validate user inputed email address
const validateEmail = v => {
    const mailhash = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (v.match(mailhash)) {
        return true;
    } else {
        return false;
    }
}

// Contact Form - Process email and send it
function phpSendEmail() {
    var xmlhttp = new XMLHttpRequest(), v;

	// Check if fields are filled in
	checkField(Email.nameID);
	checkField(Email.emailID);
	checkField(Email.messageID);
	
	// Check if all the fields are filled in
	if (Email.name() && validateEmail(Email.email()) && Email.message()) {
		v = "name=" + Email.name() + 
			"&email=" + Email.email() + 
			"&message=" + Email.message();
		
		// Connect to server
		xmlhttp.onreadystatechange = function() {
			var errorMsg;
            if (this.readyState === 4 && this.status === 200) {
				if (this.responseText == 1) { 
					// Successful
					errorMsg = "Your message has been sent. I will try and get back to you as soon as possible.";
					document.getElementById("ServerMessage").classList.remove('contact_msg');
					document.getElementById("contact_fieldset").disabled = true;
				} else { 
					// Error: Server
					errorMsg = "Server error. There seems to be a problem sending this message.";
				}
				// Display Server Message
				document.getElementById("ServerMessage").textContent = errorMsg;
            }
        }
	} else {
		// Error: Not all fields filled in
		document.getElementById("ServerMessage").textContent = "Oooopps, you need to fill in all the fields to send this message.";
	}
	
	xmlhttp.open("get", "mailman.php?" + v, true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(null);
}

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