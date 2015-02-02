<?php

namespace Inviqa\Qualys\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('qualys:parse')
            ->addArgument(
                'attemptedHosts',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'successfulHosts',
                InputArgument::REQUIRED
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $attemptedHosts = explode(',' $input->getArgument('attemptedHosts'));
        $successfulHosts = explode(',', $input->getArgument('successfulHosts'));

        var_dump(array_diff($attemptedHosts, $successfulHosts));
    }
}
