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
                '3' => 'Clubs, Diamonds, Hearts, Spades game',
                '4' => 'Test scaled data for min, max values, and save to the data folder (ideal to test lottery type numbers)',
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

            if ($answer == '3') {
                $console->clearScreen();
                $this->suitsYouSir($console);
            }

            if ($answer == '4') {
                $console->clearScreen();
                $this->scaleMinMax($console);
            }

            if ($answer == 'q') {
                $console->clearScreen();
                $loop = false;
            }
            $console->writeLine();
        }
    }

    /**
     * Generic pack of cards
     * @return array
     */
    private function getCardPack()
    {
        return [
            0 => '2C', 1 => '3C', 2 => '4C', 3 => '5C', 4 => '6C', 5 => '7C', 6 => '8C', 7 => '9C', 8 => '10C', 9 => 'JC', 10 => 'QC', 11 => 'KC', 12 => 'AC',
            13 => '2D', 14 => '3D', 15 => '4D', 16 => '5D', 17 => '6D', 18 => '7D', 19 => '8D', 20 => '9D', 21 => '10D', 22 => 'JD', 23 => 'QD', 24 => 'KD', 25 => 'AD',
            26 => '2H', 27 => '3H', 28 => '4H', 29 => '5H', 30 => '6H', 31 => '7H', 32 => '8H', 33 => '9H', 34 => '10H', 35 => 'JH', 36 => 'QH', 37 => 'KH', 38 => 'AH',
            39 => '2S', 40 => '3S', 41 => '4S', 42 => '5S', 43 => '6S', 44 => '7S', 45 => '8S', 46 => '9S', 47 => '10S', 48 => 'JS', 49 => 'QS', 50 => 'KS', 51 => 'AS',
        ];
    }

    /**
     * Simple heads or tails game using the getBoolean method
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

        $cardPack = $this->getCardPack();

        /**
         * Some trivia, cards are valued in the following order:
         * Clubs, Diamonds, Hearts, Spades, with the two of Clubs being the weakest card and the Ace of Spades being the strongest.
         * Why? Because it is alphabetic!
         */

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

    /**
     * A simple game where you guess the outcome of the card suit
     * @param AdapterInterface $console
     */
    private function suitsYouSir(AdapterInterface $console)
    {
        $loop = true;

        while ($loop == true) {
            $figlet = new \Zend\Text\Figlet\Figlet();
            echo $figlet->render('Suits you?');

            $selectedSuit = '';
            while (!in_array($selectedSuit, ['c', 'd', 'h', 's'])) {
                $selectedSuit = Line::prompt('Select a suit c [Clubs], d [Diamonds], h [Hearts], s [Spades]: ');
            }
            /**
             * In this case we shuffle the deck then get a random card from the deck. We could simplify this by
             * simply taking the first cards suit in the shuffled deck.
             */
            $shuffledDeck = FisherYatesShuffle::shuffle($this->getCardPack());
            $randomCard = GamblingTecRNG::getInteger(0, 51);
            $card = $shuffledDeck[$randomCard];
            $randomSuit = (strlen($card) == 2) ? $card[1] : $card[2];
            $cardName = ['c' => 'Clubs', 'd' => 'Diamonds', 'h' => 'Hearts', 's' => 'Spades'];

            $console->writeLine('Shuffling in progress: ');
            for ($i = 0; $i < 14; $i++) {
                $console->write('#');
                usleep(200000);
            }

            $selectedSuit = strtolower($selectedSuit);
            $randomSuit = strtolower($randomSuit);

            $console->writeLine('');
            $console->writeLine('Selected: '.$card);
            $console->write('You selected '.$cardName[$selectedSuit].', '.$cardName[$randomSuit].' was randomly selected, ');

            if (strtoupper($randomSuit) == strtoupper($selectedSuit)) {
                $console->writeLine('so you won!');
            } else {
                $console->writeLine('so you lost');
            }

            $console->writeLine('');

            $loop = Prompt\Confirm::prompt('Play again [y/n]');

            $console->clearScreen();
        }

        return;
    }

    /**
     * Scaled min/max data
     * @param AdapterInterface $console
     */
    private function scaleMinMax(AdapterInterface $console)
    {
        $loop = true;
        while ($loop == true) {
            $figlet = new \Zend\Text\Figlet\Figlet();
            echo $figlet->render('Scaled data!');
            $min = Line::prompt(
                'Select a min value: (eg 1 - 9): ',
                false,
                6
            );
            $max = Line::prompt(
                'Select a max value: (eg 10 - 100): ',
                false,
                6
            );
            if ($min > $max) {
                $console->writeLine("Sorry, min can not be greater than max", \Zend\Console\ColorInterface::RED);
                return;
            }
            $generateNumbers = Line::prompt(
                'How many random numbers would you like to generate? (eg 1 - 10,000,000): ',
                false,
                8
            );
            if ($generateNumbers < 1) {
                $generateNumbers = 1;
            }
            $iterations = Line::prompt(
                'How many times would you like to run this test? (1 - 4): ',
                false,
                8
            );
            if ($iterations > 4) {
                $console->writeLine("We only allow up to 4 iterations.", \Zend\Console\ColorInterface::RED);
                return;
            }
            /**
             * NB The MiB values are just estimates for reference purposes only.
             */
            $fileSize = ($generateNumbers < 347000) ? "< 1MiB" : "~".number_format((float)$generateNumbers/347000, 2, '.', '')."MiB";
            $filename = $this->config['fileLocation'].$this->config['filenameScale'].\Date('y-m-d-h-i-s') . '-' . $iterations;
            for($n=1;$n<=$iterations;$n++) {
                $console->writeLine($n." Selecting $generateNumbers iterations from the pool ($min / $max)");
                $console->writeLine($n." Writing integers to file ($fileSize)",\Zend\Console\ColorInterface::RED);
                for($i=0;$i<$generateNumbers;$i++) {
                    $result = GamblingTecRNG::getInteger($min, $max);
                    file_put_contents($filename.$n.'.txt', $result.PHP_EOL, FILE_APPEND);
                }
                $console->writeLine("Integers written and stored in file: $filename$n.txt", \Zend\Console\ColorInterface::BLUE);
            }
            $console->writeLine('Ok we are done!',\Zend\Console\ColorInterface::BLUE);

            $loop = Prompt\Confirm::prompt('Run again? [y/n]');
            $console->clearScreen();
        }

        return;
    }
}
