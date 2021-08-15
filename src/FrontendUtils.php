<?php

class FrontendUtils {
    private $_cbIndex = 0;
    private $_sitekey;

    function __construct(string $siteKey) {
        $this->_sitekey = $siteKey;
    }

    public function submitButton(array $attributes = []): string {
        $id = $this->_cbIndex++;
        $callbackName = 'cb_' . $id;
        $attributes['data-callback'] = $callbackName;
        $attributes['data-action'] = 'submit';
        $attributes['data-sitekey'] = $this->_sitekey;
        $text = 'submit';
        if (isset($attributes['text'])) {
            $text = $attributes['text'];
            unset($attributes['text']);
        }
        if (empty($attributes['class'])) {
            $attributes['class'] = '';
        }
        $attributes['class'] .= " g-recaptcha id-$id";
        $attributesText = [];
        foreach ($attributes as $key => $value) {
            $attributesTexts[] = "$key=\"$value\"";
        }
        $attributesText = implode(' ', $attributesText);
        $script = "
            <script>
               function onSubmit(token) {
                 document.querySelector('button.g-recaptcha.id-$id').closest('form').submit();
               }
            </script>
        ";
        return "<button $attributesText>$text</button>";
    }
}
