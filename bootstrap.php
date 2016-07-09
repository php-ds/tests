<?php

// Show whether the extension is loaded or not at the top of the report.
printf("%s\n", str_repeat('-', 79));
printf("ds extension loaded: %s\n", extension_loaded('ds') ? 'YES' : 'NO');
printf("%s\n", str_repeat('-', 79));
