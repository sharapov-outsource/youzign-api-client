<?php
/**
 * Created by PhpStorm.
 * User: Sharapov A. <alexander@sharapov.biz>
 * Date: 17.03.2016
 * Time: 15:15
 */

namespace YouzignAPI;

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
   * Errors list
   *
   * @var array
   */
  private $_errors = array();

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
   * @return void
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
      throw new \Exception('Empty credentials');
    }

    $params['key'] = $this->getPublicKey();
    $params['token'] = $this->getToken();

    $responseJson = $this->getClient()->request('POST', $this->_api . $query, array(
        'form_params' => $params
    ));

    if ($responseJson->getStatusCode() == '200') {
      return $this->_parseResult($responseJson);
    } else {
      throw new \Exception('Youzign Api is unavailable');
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
   * @return void
   */
  public function setPublicKey($publicKey)
  {
    $this->_publicKey = $publicKey;
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
   * @return void
   */
  public function setToken($token)
  {
    $this->_token = $token;
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
   * Parse guzzle http response
   * @param \GuzzleHttp\Psr7\Response $response
   * @return bool|mixed
   */
  private function _parseResult(\GuzzleHttp\Psr7\Response $response)
  {
    $responseBody = $response->getBody();
    if (property_exists($responseBody, 'error')) {
      $this->_setError($responseBody->error);
      return false;
    }
    return json_decode($responseBody);
  }

  /**
   * Set error text
   * @param $errorText
   */
  private function _setError($errorText)
  {
    $this->_errors[] = $errorText;
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
    return $this->_doRequest('designs', array('page' => $page, 'perPage' => $perPage));
  }

  /**
   * Get error list
   * @return array
   */
  public function getErrors()
  {
    return $this->_errors;
  }
}
