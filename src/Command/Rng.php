<?php
namespace Application\Command;

use Application\Service\FisherYatesShuffle;
use Application\Service\GamblingTecRNG;
use Zend\Console\Adapter\AdapterInterface;
use Zend\Console\Prompt\Line;
use Zend\Console\Prompt;
use ZF\Console\Route;

class Rng
{
    protected $config;
    protected $gamblingTecRNG;

    public function __construct(array $config)
    {
        $this->config = $config;
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
                '2' => 'Fisher/Yates card shuffle',
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

            if ($answer == '2') {
                $console->clearScreen();
                $this->fisherYatesShuffle($console);
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
            $headsOrTails = gamblingTecRNG::getBoolean();

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

    private function fisherYatesShuffle(AdapterInterface $console)
    {
        $loop = true;

        /**
         * Some trivia, cards are valued in the following order:
         * Clubs, Diamonds, Hearts, Spades, with the two of Clubs being the weakest card and the Ace of Spades being the strongest.
         * Why? Because it is alphabetic!
         */
        $cardPack = [
            0 => '2C', 1 => '3C', 2 => '4C', 3 => '5C', 4 => '6C', 5 => '7C', 6 => '8C', 7 => '9C', 8 => '10C', 9 => 'JC', 10 => 'QC', 11 => 'KC', 12 => 'AC',
            13 => '2D', 14 => '3D', 15 => '4D', 16 => '5D', 17 => '6D', 18 => '7D', 19 => '8D', 20 => '9D', 21 => '10D', 22 => 'JD', 23 => 'QD', 24 => 'KD', 25 => 'AD',
            26 => '2H', 27 => '3H', 28 => '4H', 29 => '5H', 30 => '6H', 31 => '7H', 32 => '8H', 33 => '9H', 34 => '10H', 35 => 'JH', 36 => 'QH', 37 => 'KH', 38 => 'AH',
            39 => '2S', 40 => '3S', 41 => '4S', 42 => '5S', 43 => '6S', 44 => '7S', 45 => '8S', 46 => '9S', 47 => '10S', 48 => 'JS', 49 => 'QS', 50 => 'KS', 51 => 'AS',

        ];

        while ($loop == true) {
            $figlet = new \Zend\Text\Figlet\Figlet();

            $cards = [];

            echo $figlet->render('Card Shuffle');

            $console->writeLine('Opening new pack of cards!');

            for ($i = 0; $i < 52; $i++) {
                $cards[] = $i;
            }

            $console->writeLine('Current card order:');

            for ($i = 0; $i < 52; $i++) {
                $console->write($cardPack[$cards[$i]].' ');
            }

            $console->writeLine('');

            $console->writeLine('Shuffling cards...');
            for ($i = 0; $i < 14; $i++) {
                $console->write('#');
                usleep(100000);
            }
            $cards = FisherYatesShuffle::shuffle($cards);


            $console->writeLine('');

            $console->writeLine('Cards have been shuffled: ');

            for ($i = 0; $i < 51; $i++) {
                $console->write($cardPack[$cards[$i]]." ");
                usleep(100000);
            }

            $console->writeLine('');

            $loop = Prompt\Confirm::prompt('Shuffle again? [y/n]');

            $console->clearScreen();
        }

        return;
    }

}
