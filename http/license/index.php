<?php
include_once '../helpers/wrapper.php';
$license = file_get_contents('/srv/LICENSE');
wrapperBegin('License Agreement', '');
echo <<<HTML
<div id="main-text">
<h1>License</h1>
<pre>
$license
</pre>
</div>
HTML;

wrapperEnd();