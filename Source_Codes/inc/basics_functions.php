<?php 
    function debugHTML($variable) {
        $data = print_r($variable);
        <<<HTML
            <pre>$data</pre>
        HTML;
    }

    function getTitle($titleWebPage) {
        if (isset($titleWebPage)) {
            return $titleWebPage . ' | ' . WEBSIDE_TITLE;
        } else {
            return 'Unknow Page Named | ' . WEBSIDE_TITLE;
        }
    }