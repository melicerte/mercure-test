<?php

namespace App\Command;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UpdateBookCommand extends Command
{
    protected static $defaultName = 'app:update-book';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Update a book')
            ->addArgument('id', InputArgument::OPTIONAL, 'ID of the book')
            ->addArgument('status', InputArgument::OPTIONAL, 'New status of the book')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $id = $input->getArgument('id');
        $status = $input->getArgument('status');

        $book = $this->entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw new \Exception(
                'No book found for id '.$id
            );
        }

        $book->setStatus($status);
        $this->entityManager->flush();

        $io->success('Book '.$id.' updated with status "'.$status);

        return 0;
    }
}
