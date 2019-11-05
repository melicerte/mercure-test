<?php

namespace App\Command;

use App\Mercure\PublishToMercure;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SendTimeMessageCommand extends Command
{
    protected static $defaultName = 'app:send-time-message';

    /**
     * @var PublishToMercure
     */
    private $publishToMercure;

    public function __construct(PublishToMercure $publishToMercure)
    {
        parent::__construct();
        $this->publishToMercure = $publishToMercure;
    }

    protected function configure()
    {
        $this
            ->setDescription('Send time command to mercure')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $result = $this->publishToMercure->publishTime();

        $output->writeln($result);

        return 0;
    }
}
