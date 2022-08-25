<?php

file_put_contents($obj.'/era', eraPass($yearToday));
chmod($obj.'/era', 0777);
file_put_contents($sub.'/era', eraPass($yearToday));
chmod($sub.'/era', 0777);
