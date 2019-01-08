<?php
include_once '../helpers/wrapper.php';
$license = file_get_contents('/srv/LICENSE');
wrapperBegin('License Agreement', '');
echo <<<HTML
<div id="main-text">
<pre style="font-size: 1.5vw;">
$license
</pre>
</div>
HTML;

wrapperEnd();