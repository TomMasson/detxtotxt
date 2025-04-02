# DetxToTxt

DETX to TXT converter to simplify the use of DETX files. DETX files are used in Capella, a free-for-use software that allows you to generate videos with a dubbing track. DETX are in XML format.

# Run as web page

After cloning the project, make sure you have a PHP installed on your marchine.
Brew allows to install it easely.
Then run `php -S localhost:8000`

# Run as script

You can also run the converter as a script. You just need to run `php scripts/detxToTxt.php $fileToConvert`. You can test the converter by not giving a file paramter to the command line ; it will use example files.
