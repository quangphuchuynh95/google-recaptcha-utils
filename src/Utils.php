<?php

class Utils {
    /**
     * @var FrontendUtils
     */
    public $frontend;

    /**
     * @var BackendUtils
     */
    public $backend;

    function __construct(string $siteKey, string $secreteKey) {
        $this->frontend = new FrontendUtils($siteKey);
        $this->backend = new BackendUtils($secreteKey);
    }
}
