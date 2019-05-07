<?php

namespace App\Helpers\CDN;

class Identity extends \Bavix\CupKit\Identity
{

    /**
     * @return bool
     */
    protected function loadTokens(): bool
    {
        return parent::loadTokens();
    }

    /**
     * @param array $response
     */
    protected function updateTokens(array $response): void
    {
        parent::updateTokens($response);
    }

}
