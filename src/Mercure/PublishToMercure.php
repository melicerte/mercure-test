<?php


namespace App\Mercure;


use Ramsey\Uuid\Uuid;
use Symfony\Component\Mercure\Publisher;
use Symfony\Component\Mercure\Update;

class PublishToMercure
{
    /**
     * @var Publisher
     */
    private $publisher;

    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
    }

    public function publishTime(): string
    {
        $update = new Update('http://localhost/time', json_encode(['message' => date('Y-m-d H:i:s')]));

        return ($this->publisher)($update);
    }

    public function publishMessage(string $message, array $targets)
    {
        $update = new Update(
            'http://localhost/my-funky-resource',
            json_encode(['message' => $message]),
            $targets
        );

        return ($this->publisher)($update);
    }
}