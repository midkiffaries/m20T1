<?php // Global Contact Form ?>
<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<h3>Send me a message</h3>
<div class="email-block">
    <form id="ContactForm" autocomplete="on" onsubmit="event.preventDefault()">
		<fieldset id="contact_fieldset">
			<p><label for="contact_name">Name <span class="contact_error"></span></label> <input type="text" name="name" id="contact_name" placeholder="Your Name" maxlength="100" inputmode="name" autocomplete="name" autocapitalize="words" autofocus required></p>
			<p><label for="contact_email">Email <span class="contact_error"></span></label> <input type="email" name="email" id="contact_email" placeholder="name@email.com" maxlength="100" inputmode="email" autocomplete="email" autocapitalize="none" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required></p>
			<p><label for="contact_message">Message <span class="contact_error"></span></label> <textarea name="message" id="contact_message" placeholder="This is what I have to say..." required></textarea></p>
			<p><input type="submit" value="Send Email" onclick="SubmitContactForm()" class="button-basic"></p>
		</fieldset>
		<p id="MessageInfo" class="contact_server"><b id="ServerMessage"></b></p>
    </form>
</div>