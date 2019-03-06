<?php
/*
Copyright (C) 2019  Justus Croskery
To contact me, email me at justus@olmmcc.tk.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/.
*/
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('Privacy Policy');
echo <<<HTML
<div id='main-text'>
<h1>Privacy Policy</h1>
<p>OLMMCC ("us", "we", or "our") operates the https://www.olmmcc.tk/ website (the "Service").</p>

<p>This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data. By using this Service, you agree to the collection and use of information in accordance with this privacy policy.</p>

<h2>Information Collection And Use</h2>

<p>We may collect different types of information when you use our Service. OLMMCC uses the collected data to provide, maintain, improve and monitor the Service. We do not share your data with any third party, except if required to by law:</p>

<h4>Personal Data</h4>

<p>When signing up for and modifying your account, we collect your name and email address, and store it in our database. If you do not wish to have this personal data uploaded to our servers, then please do not sign up for an account. Your IP address may also be considered Personal Information, so see the Usage Data section for information on its collection.</p>

<h4>Cookie Data</h4>

<p>When you use our Service, we set a Session Cookie in your browser. This cookie lets us know if you are logged in or not, and it also lets us know your account details. We do not track you with these cookies. For more details on cookies, see the Cookies section of our Privacy Policy.</p>

<h4>Usage Data</h4>

<p>We may also collect information on how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your browser type, browser version, the pages of our Service that you visit, the time and date of your visit, your IP address, and your operating system. To stop usage data from being collected, turn Do Not Track on in your browser, as outlined <a href='https://allaboutdnt.com/#adjust-settings'>here</a>.</p>

<h2>Cookies</h2>
<p>Cookies are files with small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device.</p>
<p>OLMMCC uses cookies to authenticate you (session cookies) and to display notifications on the site. We do not track you using cookies.</p>
<p>If you do not want cookies to be used, then you can instruct your browser to refuse cookies, as outlined <a href='https://www.howtogeek.com/63721/how-to-block-all-cookies-except-for-sites-you-use/'>here</a>. Please note that you cannot login to the service if you do not accept cookies, and notifications will not be displayed.</p>


<h2>Transfer Of Data</h2>
<p>If you are located outside Canada and choose to provide information to us, please note that we transfer the data, including Personal Data, to Canada and process it there.</p>
<p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
<p>OLMMCC will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy.</p>


<h2>Security Of Data</h2>
<p>The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>


<h2>Other Sites</h2>
<p>Our Service contains links and content on other sites that are not operated by us. If you click on a third party link or view third party content, your personal data may be collected by the third party, as governed by that site's privacy policy. We strongly advise you to review the Privacy Policy of every site you visit.</p>
<p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>

<h2>Changes To This Privacy Policy</h2>
<p>We may update our Privacy Policy from time to time. Changes to this Privacy Policy are effective when they are posted on this page.</p>

<h2>Contact Us</h2>
<p>If you have any questions about this Privacy Policy, please contact us by email at <a href='mailto:justus@olmmcc.tk'>justus@olmmcc.tk</a>.</p>
</div>
HTML;
wrapperEnd();
