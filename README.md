# What's Changed?

Run PHPUnit tests only on files which have changed. Useful during development stages when working with codebases with huge test suites.

## How to use

0. Make sure your project is set-up with Git
1. Pull in through Composer
2. Run `````./vendor/bin/whatschanged`````
3. Magic!

## Conditions

* Only works with files ending with ````.php````
* Assumes your classes are in ````src```` and tests are mapped in the exact file structure in the ````tests```` folder.
* If a Unit Test in the ````tests```` folder is changed, that test is re-run
* Files which are monitored are those which are changed in the working tree since your last commit and those modified in the previous commit

### Examples

If ````src/Git.php```` is changed we look for a test suite in ````tests/GitTest.php````, if the test ````tests/GitTest.php```` is changed we run that test.


## Note

* I wrote this in a few hours overnight once
* This doesn't support Windows
* You should run all your tests at least once before you merge your code in. This tool is purely to aid development whilst working with a large set of tests.