<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => __DIR__.'/../../../../../vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64',
        'options' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => '/usr/local/bin/wkhtmltoimage',
        'options' => array(),
    ),


);
