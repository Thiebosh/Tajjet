<?php ob_start(); 

            $first = true;
            foreach ($pageFill['errMsgs'] as $msg) {
                if ($first) {
                    $first = false;
                }
                else {
                    echo '<br>';
                }

                echo htmlspecialchars($msg);
            }

$pageFill['sectionContent'] = ob_get_clean();

require("template.php");