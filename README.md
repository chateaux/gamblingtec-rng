# Certified RNG utility
This utility uses GamblingTec's certified RNG wrapper to run some test command line games. Its purpose
is to assist developers in using the class as well as to provide them with some tools to test the output
from the random number generator.

Feel free to modify and update this utility to assist in making it a useful tool to the community.

## About us (Unashamed plug about our business)

GamblingTec.com offers a wide variety of gambling licensing services from incorporation's and license 
applications to managed licensing services. Additionally, the company offers a simple way for game 
developers to integrate their games into the GamblingTec platform to be offered under license 
to casino operators.

visit: https://www.gamblingtec.com for more information.

 ### Incorporation's + License applications
 
 We work in Curacao and Malta and will manage the process of applying for a license under you
 company. We assist our clients with bank accounts, credit card processing, e-wallet and
 crypto currency solutions.
 
 * Bank accounts
 * Processing
    * Credit card
    * Skrill
    * NETeller
    * Jeton wallet
    * PaySafe Card
    * Crypto
        * Bitcoin
        * DASH
        * NEM

From first application to your first sale: ~ 12 months.

### Managed casino services

Our managed casino service is where our clients setup their casinos under our existing license. We
act as the operator and the client acts as the software provider and marketer.

This is a quick way to setup a stand alone brand and piggy backing off our existing payment and banking
relationships.


From first application to first sale: ~ 3 months

### Platform license

The GamblingTec.com platform is an API driven bet/collect system that you can integrate your game into 
or your casino brand under. It has existing payment solutions (as per above) and is a rapid way to 
setup your casino or white labeling business.

From first application to first sale: ~ 2 months


## The RNG Class

We use Zend\Math\Rand in order to generate our random numbers. The class has passed die hard RNG
testing and is certified to be used under **our Curacao license**.

Installing and using the class does not automatically give you certification under license. We still need
to have the class certified for your game and you will then need to apply to the Master License
holder with the certificate we issue.
 
Zend\Math\Rand uses a cryptographically secure random number generator and we would encourage you
to read about the class here: https://docs.zendframework.com/zend-math/rand/


We posted a link about the certification process here: 
https://discourse.zendframework.com/t/i-had-zendmathrand-certified-and-it-passed-rng-testing/951

### You can find the class:

* Packagist: https://packagist.org/packages/gamblingtec/certified-rng
* Github: https://github.com/sunsevennv/certified-rng


## Installing this utility

Download the zip to your computer or use git:

* git add remote rng <url to repo>
* git fetch --all
* git merge rng/develop

Once downloaded cd into the rng folder and then use composer to install the dependencies

* composer install

Once the dependencies are installed, cd to the bin folder and type:

* php console.php rng

You will be given the following options:

  * 1) Heads or tails example
  * 2) Fisher/Yates card shuffle
  * 3) Clubs, Diamonds, Hearts, Spades game
  * 4) Test scaled data for min, max values, and save to the data folder (ideal to test lottery type numbers)
  * q) Quit...

Press "q" to exit or "1" to play the heads or tails game.

## Heads or tails example

The game uses the getBool() method to select heads or tails. 

## Fisher/Yates card shuffle example

The Fisher-Yates shuffle is an algorithm for generating a random permutation of a finite sequence. In this example we use
it to shuffle a deck of cards!

## Clubs, Diamonds, Hearts, Spades game
Player slects a suit, we then shuffle the cards, pick a random card and if the suit matches, the player wins.

## Test scaled data
A utility to test lottery related scaled data. Select the pools min and max values, how many numbers should be selected, and how many times.
The method will run this test and store the result in a file which can be used for testing purposes.

## Need to certify your games for a gambling license?
If you use this library it can be certified for remote gambling purposes, in order to do so, please make sure you do not modify the GamblingTecRNG.php file.

From time to time we modify this file which requires authorisation from the certificate authority.

# Helping out
If you like our utility and wish to contribute a service to it such as a sample game or an algorithm. Fork the repo and submit a pull request.

# Using the code in your own game

When using the code, simply call the static methods from GamblingTecRNG.php in order
to obtain your random numbers. Take a look at the sample games that use the class.

If you need assistance writing classes to generate lottery numbers and winners in
an instant game or scratch type game environment, get in touch, we can help!

* email: brendan [at] gamblingTec.com
* WhatsApp: +44 (0)7498 105896
* SA Mobile: +27 (0)60-457-8084
* Sales office: +27 (0)21-839-5509
* skype: brendanjnash
* Discord: https://discord.gg/Kjy5qkq
