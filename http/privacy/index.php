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
<h1>Human-Readable Summary</h1>
<p class='bold'>Please note: This section is not part of the privacy policy.</p>
<p>We collect usage data from you (browser, OS, date and time, etc). If you don't want us to collect this data, then turn Do Not Track on, as outlined <a href='https://allaboutdnt.com/#adjust-settings'>here</a>.</p>

<p>We also use cookies to operate our notification system and to log you in to your account. You can tell your browser to reject cookies, as outlined <a href='https://www.howtogeek.com/63721/how-to-block-all-cookies-except-for-sites-you-use/'>here</a>.</p>

<p>Third party content on this site is governed by the third party's privacy policy, not our own. We do not share your personal data with anyone.</p>

<h1>Privacy Policy</h1>


<p>Effective date: February 23, 2019</p>


<p>OLMMCC ("us", "we", or "our") operates the https://www.olmmcc.tk/ website (hereinafter referred to as the "Service").</p>

<p>This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.</p>

<p>We use your data to provide and improve the Service. By using the Service, you agree to the collection and use of information in accordance with this policy.</p>

<h2>Information Collection And Use</h2>

<p>We collect two different types of information for various purposes to provide and improve our Service to you.</p>

<h4>Personal Data</h4>

<p>While using our Service, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you ("Personal Data"). We collect your username and email address when you sign up for an account, and store it in our database. If you do not wish to have this personal data uploaded to our servers, then please do not sign up for an account.</p>

<h4>Usage Data</h4>

<p>We may also collect information on how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your browser type, browser version, the pages of our Service that you visit, the time and date of your visit, and your operating system. This data will be anonymized and in no way be personally identified with you. If you do not wish to have this data collected, turn Do Not Track on in your browser, as outlined <a href='https://allaboutdnt.com/#adjust-settings'>here</a>.</p>

<h2>Use of Data</h2>

<p>OLMMCC uses the collected data for various purposes:</p>    
<ul>
    <li>To provide and maintain the Service</li>
    <li>To provide analysis or valuable information so that we can improve the Service</li>
    <li>To monitor the usage of the Service</li>
    <li>To detect, prevent and address technical issues</li>
</ul>
<p>We do not share your personal data with any third party, except if required to by law.</p>

<h2>Cookies</h2>

<p>OLMMCC uses cookies to authenticate you (session cookies) and to display notifications on the site.</p>
<p>We do not collect any data from cookies.  However, we use them for some parts of the service.</p>
<p>Cookies are files with small amount of data which may include an anonymous unique identifier. Cookies are sent to your browser from a website and stored on your device.</p>
<p>If you do not want cookies to be used, then you can instruct your browser to refuse all cookies, as outlined <a href='https://www.howtogeek.com/63721/how-to-block-all-cookies-except-for-sites-you-use/'>here</a>. Please note that you cannot login to the service if you do not accept cookies, and notifications will not be displayed.</p>


<h2>Transfer Of Data</h2>
<p>If you are located outside Canada and choose to provide information to us, please note that we transfer the data, including Personal Data, to Canada and process it there.</p>
<p>Your consent to this Privacy Policy followed by your submission of such information represents your agreement to that transfer.</p>
<p>OLMMCC will take all steps reasonably necessary to ensure that your data is treated securely and in accordance with this Privacy Policy.</p>


<h2>Security Of Data</h2>
<p>The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, such as TLS, we cannot guarantee its absolute security.</p>


<h2>Other Sites</h2>
<p>Our Service contains links and content on other sites that are not operated by us. If you click on a third party link or view third party content, your personal data may be collected by the third party, as governed by that site's privacy policy. We strongly advise you to review the Privacy Policy of every site you visit.</p>
<p>We have no control over and assume no responsibility for the content, privacy policies or practices of any third party sites or services.</p>


<h2>Children's Privacy</h2>
<p>Our Service does not address anyone under the age of 13.</p>
<p>We do not knowingly collect personally identifiable information from anyone under the age of 13. If you are a parent or guardian and you are aware that your children under age 13 have provided us with Personal Data, please contact us. If we become aware that we have collected Personal Data from children without verification of parental consent, we will take steps to remove that information from our servers.</p>

<h2>Changes To This Privacy Policy</h2>
<p>We may update our Privacy Policy from time to time. Changes to this Privacy Policy are effective when they are posted on this page.</p>

<h2>Contact Us</h2>
<p>If you have any questions about this Privacy Policy, please contact us by email at <a href='mailto:justus@olmmcc.tk'>justus@olmmcc.tk</a>.</p>
</div>
HTML;
wrapperEnd();
