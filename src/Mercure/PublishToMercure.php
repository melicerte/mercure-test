<?php


namespace App\Mercure;


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
        $update = new Update('http://localhost/time', json_encode(['time' => time()]));

        return ($this->publisher)($update);
    }
}