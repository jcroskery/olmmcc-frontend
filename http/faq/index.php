<?php
include_once '../helpers/wrapper.php';
wrapperBegin('FAQ', 'faq');
echo <<<HTML
<div id="main-text">
    <h1>FAQ</h1>
    <ul>
        <li class='q'>Q: When are choir practices?</li>
        <li class='a'>A: Choir practices occur twice each month on Thursdays at 6:30 PM in the church. An email is sent out with the exact dates at the beginning of the month.</li>
        <li class='q'>Q: What is the age requirement?</li>
        <li class='a'>A: Your child must be in grade 3 or above.</li>
        <li class='q'>Q: What are the duties of choir members?</li>
        <li class='a'>A: Choir members come to the two practices each month for an hour and they perform on the first Sunday of each month for the Children's Mass.</li>
        <li class='q'>Q: What if I can't make it to a practice?</li>
        <li class='a'>A: Email Justus at <a href="mailto:justus@olmmcc.tk">justus@olmmcc.tk</a>.</li>
        <li class='q'> Q: Is any previous singing experience required?</li>
        <li class='a'>A: No, we accept any level of singer.</li>
        <li class='q'>Q: How do I join?</li>
        <li class='a'>A: Email Justus or show up at one of our practices!</li>
    </ul>
    <p>More questions? Email Justus at <a href="mailto:justus@olmmcc.tk">justus@olmmcc.tk</a>.</p>
</div>

HTML;
wrapperEnd();