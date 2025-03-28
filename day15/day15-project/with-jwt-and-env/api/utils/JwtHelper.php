<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class JwtHelper
{
    private $secretKey;

    public function __construct()
    {
        $this->secretKey = $_ENV['JWT_SECRET'];
    }

    public function generateToken($data)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // jwt valid for 1 hour
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'data' => $data
        ];

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function decodeToken($token)
    {
        try {
            return JWT::decode($token, $this->secretKey, ['HS256']);
        } catch (ExpiredException $e) {
            return null; // Token has expired
        } catch (SignatureInvalidException $e) {
            return null; // Invalid token signature
        }
    }
}
