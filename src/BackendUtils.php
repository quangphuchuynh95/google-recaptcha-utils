<?php

use GuzzleHttp\Client;

class BackendUtils {
    private $_secreteKey;

    function __construct(string $secreteKey) {
        $this->_secreteKey = $secreteKey;
    }

    /**
     * @throws BackendUtilsException
     */
    public function validate($token, $ip = NULL): int {
        try {
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => $this->_secreteKey,
                    'response' => $token,
                    'remoteip' => $ip
                ]
            ]);
            $responseData = json_decode($response->getBody()->getContents());
            if (!empty($responseData->score)) {
                return $responseData->score;
            }
            throw new BackendUtilsException("Unknown error");
        } catch (Exception $e) {
            throw new BackendUtilsException($e->getMessage());
        }
    }
}
