<?php
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('About', 'about');
echo <<<HTML
        <div id="main-text">
            <H1>About the Children's Choir</H1>
            <p>The Children's Choir was created in 2017 upon the request of Fr. Robert Masternak, SDS, who wanted to see children participate more in music ministry for the Children's Mass. The Children's Choir is a group of children from OLMM parish who enjoy participating in the life of the parish by performing music during the Mass. The choir meets twice a month to practice and performs on the first Sunday of each month at the Children's Mass.</p>
        </div>

HTML;
wrapperEnd();