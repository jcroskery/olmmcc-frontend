<?php
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('OLMM Children\'s choir', 'home');
echo <<<HTML
        <div id="main-text">
            <H1>Home</H1>
            <p id="mainParagraph">Hello, and welcome! To read about the choir, visit the About tab. To see the current songs, go to the Songs tab. The choir's schedule is visible in the Calendar tab. You can read the Frequently Asked Questions in the FAQ tab. If you notice a problem in the site or you have questions, go to the Contact tab.
            </p>
        </div>
HTML;
wrapperEnd();