<?php
if (YII_ENV_DEV)    $this->registerJsFile('@web/js/react/react_bundle_dev.js');
else                $this->registerJsFile('@web/js/react/react_bundle.js');

//I have no ida what the fuck this is for, react seems to be loading fine without it.
$this->registerJs('
    ReactDOM.render(
        React.createElement(MyReactComponent),
        document.getElementById("root")
    );
');
?>

<div id="root"></div>
