<?php
namespace App\Mercure;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;

final class MyJwtProvider
{
    /**
     * @var string
     */
    private $mercureSecretKey;

    public function __construct(string $mercureSecretKey)
    {
        $this->mercureSecretKey = $mercureSecretKey;
    }

    public function __invoke(): string
    {
        // Let's imagine user names comes from a real data source like a database
        $usernames = ['melicerte', 'someguy'];

        $targets = array_map(function($value) {
            return "http://localhost/user/$value";
        }, $usernames);

        // Generate token
        $token = (new Builder())
            ->withClaim('mercure', ['publish' => $targets])
            ->getToken(new Sha256(), new Key($this->mercureSecretKey));

        return $token;
    }
}