<?php

namespace App\Command;

use App\Mercure\PublishToMercure;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SendTargetedMessageCommand extends Command
{
    protected static $defaultName = 'app:send-targeted-message';

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
            ->addArgument('message', InputArgument::REQUIRED, 'The message.')
            ->addArgument('target', InputArgument::REQUIRED, 'The target of the message.')
            ->setDescription('Send message to mercure')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $targets = explode(',', $input->getArgument('target'));

        $result = $this->publishToMercure->publishMessage($input->getArgument('message'), $targets);

        $output->writeln($result);

        return 0;
    }
}
