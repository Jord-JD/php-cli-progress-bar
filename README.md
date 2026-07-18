# ⏱ PHP CLI Progress Bar

Progress bar for command line PHP scripts.

<img alt="Example of PHP CLI Progress Bar" src="assets/images/php-cli-progress-bar-example.gif" />

## Installation

To install, just run the following Composer command.

```
composer require jord-jd/php-cli-progress-bar
```

## Usage

The following code snippet shows a basic usage example.

```php
$max = 250;

$progressBar = new JordJD\CliProgressBar\ProgressBar;
$progressBar->setMaxProgress($max);

for ($i=0; $i < $max; $i++) { 
    usleep(200000); // Instead of usleep, process a part of your long running task here.
    $progressBar->advance()->display();
}

$progressBar->complete();
```

Calling `setMaxProgress()` before the first advancement starts the elapsed-time and ETC measurements. If you prepare a progress bar early, call `$progressBar->start()` immediately before processing to reset those measurements explicitly.
