<?php ob_start(); 
    //open html balises here
    echo htmlspecialchars($pageFill['errMsg']);
    //close html balises here
$pageFill['sectionContent'] = ob_get_clean();
$pageFill['pageName'] = 'error';

require("template.php");