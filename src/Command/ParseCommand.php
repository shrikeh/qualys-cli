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
                'hosts1',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'hosts2',
                InputArgument::REQUIRED
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hosts1 = $this->parseArgument('hosts1', $input);
        $hosts2 = $this->parseArgument('hosts2', $input);

        $diff=array_diff($hosts1, $hosts2);
        $common=array_intersect($hosts1, $hosts2);

        $this->outputArray($common, $output, 'hosts in both lists');
        $this->outputArray($diff, $output, 'hosts not in both lists');

   }

    private function outputArray($array, OutputInterface $output, $message)
    {
        $output->writeln($message.': '.join(', ',$array));
    }

    private function parseArgument($name, InputInterface $input)
    {
        return $this->trim(explode(',', $input->getArgument($name)));
    }

    private function trim($array)
    {
        return array_map('trim', $array);
    }
}
