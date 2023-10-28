<?php
    if (YII_ENV_DEV)    $this->registerJsFile('@web/js/react/react_bundle_dev.js');
    else                $this->registerJsFile('@web/js/react/react_bundle.js');
?>

<div id="root"></div>
