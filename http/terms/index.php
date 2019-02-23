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
wrapperBegin('Terms of Use');
echo <<<HTML
<div id='main-text'>
<h1>Terms and Conditions</h1>

<h2>1. Terms</h2>

<p>By accessing this Website (https://www.olmmcc.tk/) you are agreeing to be bound by these Website Terms and Conditions of Use. You also agree that you will agree with any applicable local laws.</p>

<h2>2. Use License</h2>

<p>Permission is granted to use, modify, and distribute this software, which can be downloaded from <a href='https://github.com/Somebody62/olmmcc.tk/'>GitHub</a>, under the terms of our <a href='/license/'>license</a>. This work is Copyright (C) 2019 Justus Croskery.</p>

<h2>3. Errors and Revisions</h2>

<p>The materials in this Website may not be accurate, complete, or current. The materials contained on this Website may change at any time. OLMMCC does not make any commitment to update the materials.</p>

<h2>4. Links</h2>

<p>OLMMCC is not responsible for the contents of any links, or for any third party content, on its site. The use of any third party links or content is at your own risk.</p>

<h2>5. Terms of Use Modifications</h2>

<p>OLMMCC may update the Terms of Use from time to time. Changes to these Terms of Use are effective when they are posted on this page.</p>

<h2>6. Your Privacy</h2>

<p>Please read <a href="/privacy/">our Privacy Policy</a>.</p>
</div>
HTML;
wrapperEnd();