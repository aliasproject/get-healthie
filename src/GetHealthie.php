<?php namespace AliasProject\GetHealthie;

use Exception;

class GetHealthie
{
  const ENDPOINT = 'https://app.gethealthie.com/webhooks/create_client_with_payment_and_document';
  private $provider_id;


  public function __construct(string $provider_id)
  {
      $this->provider_id = $provider_id;
  }

  /**
   * Create Client
   *
   * @param string $first_name
   * @param string $last_name
   * @param string $dob
   * @param string $phone
   * @param string $email
   * @param string $offering_id
   * @param float $amount
   * @param string $pdf
   * @return array
   */
  public function createClient(string $first_name, string $last_name, string $dob, string $phone, string $email, string $offering_id, float $amount, string $pdf = '')
  {
    $data = [
      'first_name' => $first_name,
      'last_name' => $last_name,
      'dob' => date('Y-m-d', strtotime($dob)),
      'phone_number' => $phone,
      'email' => $email,
      'offering_id' => $offering_id,
      'payment_amount' => number_format((float)$amount, 2, '.', ''),
      'datetime' => time(),
      'base64_pdf_string' => $pdf,
      'provider_id' => $this->provider_id
    ];

    return $this->makeRequest($data, ['Content-Type: application/json', 'Accept: */*'], true);
  }

  /**
   * Make HTTP Request
   *
   * @param string $data
   * @param array $headers
   * @param bool $post
   * @return string
   */
  private function makeRequest(array $data = [], array $headers=[], bool $post=false)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, self::ENDPOINT);
    curl_setopt($ch, CURLOPT_POST, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($post) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
  }
}
