<?php
namespace Application\Command;

use Application\Service\GamblingTecRNG;
use Zend\Console\Adapter\AdapterInterface;
use Zend\Console\Prompt;
use ZF\Console\Route;

class Rng
{
    protected $config;
    protected $gamblingTecRNG;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->gamblingTecRNG = new GamblingTecRNG();
    }

    /**
     * This organises the various tasks
     * @param Route $route
     * @param AdapterInterface $console
     */
    public function __invoke(Route $route, AdapterInterface $console)
    {
        $loop = true;

        while ($loop == true) {
            $console->clearScreen();
            $console->writeLine('Make sure your command line is using php 7.1 +', \Zend\Console\ColorInterface::RED);

            $options = array(
                '1' => 'Heads or tails example',
                'q' => 'Quit...'
            );

            $answer = Prompt\Select::prompt(
                'Select an option: ',
                $options,
                false,
                false
            );

            if ($answer == '1') {
                $console->clearScreen();
                $this->headsOrTails($console);
            }

            if ($answer == 'q') {
                $console->clearScreen();
                $loop = false;
            }
            $console->writeLine();
        }
    }

    /**
     * Simple heads or tails game
     * @param AdapterInterface $console
     */
    private function headsOrTails(AdapterInterface $console)
    {
        $loop = true;

        while ($loop == true) {
            $figlet = new \Zend\Text\Figlet\Figlet();
            echo $figlet->render('Heads or Tails');

            $heads = Prompt\Confirm::prompt('Select heads? [y/n]');
            $headsOrTails = $this->gamblingTecRNG->getBoolean();

            if ($heads) {
                $console->writeLine('You have selected heads.');
            } else {
                $console->writeLine('You have selected tails.');
            }

            $console->writeLine('Coin toss in progress: ');
            for ($i = 0; $i < 14; $i++) {
                $console->write('#');
                usleep(200000);
            }

            $console->writeLine('');

            if ($headsOrTails === $heads) {
                if ($heads) {
                    $console->writeLine('It is heads, you won!');
                } else {
                    $console->writeLine('It is tails, you won!');
                }
            } else {
                $console->writeLine('Sorry, you lost, please try again!');
            }

            $loop = Prompt\Confirm::prompt('Play again [y/n]');

            $console->clearScreen();
        }

        return;
    }

}
