<?php
/**
 * Yourzign API client
 * (c) Alexander Sharapov <alexander@sharapov.biz>
 * http://sharapov.biz/
 */

namespace Sharapov\YouzignAPI;

class YzApi
{
  private $_api = 'https://www.youzign.com/api/';

  /**
   * Public Key as generated in Youzign profile.
   *
   * @var string
   */
  private $_publicKey = '';

  /**
   * Token as generated in Youzign profile.
   *
   * @var string
   */
  private $_token = '';

  /**
   * GuzzleHttp client.
   *
   * @var \GuzzleHttp\Client
   */
  private $_client;

  /**
   * YzApi constructor.
   * @param null $publicKey
   * @param null $token
   * @return YzApi
   */
  public function __construct($publicKey = null, $token = null)
  {
    if (!empty($publicKey)) {
      $this->setPublicKey($publicKey);
    }
    if (!empty($token)) {
      $this->setToken($token);
    }
    $this->_setClient();
    return $this;
  }

  /**
   * Create guzzle http object
   * @return void
   */
  private function _setClient()
  {
    $this->_client = new \GuzzleHttp\Client(array(
        'verify' => false,
        'timeout' => 5
    ));
  }

  /**
   * Get profile of authorized user. Return FALSE if any error, otherwise object.
   * @return bool|mixed
   * @throws \Exception
   */
  public function getProfile()
  {
    return $this->_doRequest('profile');
  }

  /**
   * Do API request
   * @param $query
   * @param array $params
   * @return bool|mixed
   * @throws \Exception
   */
  private function _doRequest($query, array $params = array())
  {
    if (empty($this->_publicKey) or empty($this->_token)) {
      throw new \Exception('Empty API key or token.');
    }

    $params['key'] = $this->getPublicKey();
    $params['token'] = $this->getToken();

    try {
      $responseJson = $this->getClient()->request('POST', $this->_api . $query, array(
          'form_params' => $params
      ));
      if ($responseJson->getStatusCode() == '200') {
        return $this->_parseResult($responseJson);
      } else {
        throw new \Exception('Unknown API response.');
      }
    } catch (\GuzzleHttp\Exception\ClientException $e) {
      if ($e->getCode() == '404') {
        throw new \Exception('API is unavailable. Check DNS settings.');
      } elseif ($e->getCode() == '401') {
        throw new \Exception('Invalid API key or token.');
      } else {
        throw new \Exception($e->getMessage());
      }
    }
  }

  /**
   * Get public key
   * @return string
   */
  public function getPublicKey()
  {
    return $this->_publicKey;
  }

  /**
   * Set public ket
   * @param $publicKey
   * @return YzApi
   */
  public function setPublicKey($publicKey)
  {
    $this->_publicKey = $publicKey;
    return $this;
  }

  /**
   * Get token
   * @return string
   */
  public function getToken()
  {
    return $this->_token;
  }

  /**
   * Set token
   * @param $token
   * @return YzApi
   */
  public function setToken($token)
  {
    $this->_token = $token;
    return $this;
  }

  /**
   * Return guzzle http object
   * @return \GuzzleHttp\Client
   */
  public function getClient()
  {
    return $this->_client;
  }

  /**
   * Parse http response
   * @param \GuzzleHttp\Psr7\Response $response
   * @return mixed
   * @throws \Exception
   */
  private function _parseResult(\GuzzleHttp\Psr7\Response $response)
  {
    $responseBody = json_decode($response->getBody());
    if (property_exists((object)$responseBody, 'error')) {
      throw new \Exception($responseBody->error);
    }
    return $responseBody;
  }

  /**
   * Get list of designs. Return FALSE if any error, otherwise object.
   * @param int $page
   * @param int $perPage
   * @return bool|mixed
   * @throws \Exception
   */
  public function getDesigns($page = 1, $perPage = 20)
  {
    return $this->_doRequest('designs', array('page' => $page, 'per_page' => $perPage));
  }
}
