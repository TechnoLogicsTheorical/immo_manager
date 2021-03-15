<?php 
    function debugHTML($variable) {
        $data = print_r($variable);
        <<<HTML
            <pre>$data</pre>
        HTML;
    }
?>