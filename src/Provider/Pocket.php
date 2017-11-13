<?php

namespace League\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\PocketResourceOwner;
// use League\OAuth2\Client\Provider\Exception\DiscordIdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Pocket extends \League\OAuth2\Client\Provider\AbstractProvider
{
    use BearerAuthorizationTrait;

    protected $baseUrl = 'https://getpocket.com/v3';

    /**
     * Get the URL (with base) for the authorization endpoint
     *
     * @return string Full URL
     */
    public function getBaseAuthorizationUrl()
    {
        return $this->baseUrl.'/oauth2/authorize';
    }

    /**
     * Get the URL (with base) for the token endpoint
     *
     * @param array $params Extra parameters
     * @return string Full URL
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->baseUrl.'/oauth2/request';
    }

    /**
     * Get the URL for fetching the resource owner (current user)
     *
     * @param AccessToken $token AccessToken instance
     * @return string Full URL
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->baseUrl.'/users/@me';
    }

    /**
     * Check the response from the OAuth flow for errors
     *
     * @param ResponseInterface $response Response instance
     * @param array $data Extra data
     * @return null|DiscordIdentityProviderException Null if valid, exception on failure
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        error_log(print_r($data, true));

        // if (isset($data['error'])) {
        //     throw DiscordIdentityProviderException::oauthException($response, $data);
        // }
    }

    /**
     * Create a new instance of the DiscordResourceOwner based on the response
     *
     * @param array $response Response object
     * @param AccessToken $token Token object instance
     * @return DiscordResourceOwner instance
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new PocketResourceOwner($response);
    }

}
