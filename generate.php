#!/usr/bin/php
<?php

class Topic {
    public $speaker;
    public $title;
    public $language;
    public $description;

    public function __construct($speaker, $title, $language, $description)
    {
        $this->speaker = $speaker;
        $this->title = $title;
        $this->language = $language;
        $this->description = $description;
    }
}


/**
 * Load topics from CSV file.
 *
 * File format:
 * speaker,phone,title,stage,language,description
 * 
 * @param string $file CSV file
 *
 * @return array<Topic>
 */
function load_topics($file)
{
    $topics = [];
    $file = fopen($file, "r");
    while (!feof($file)) {
        $row = fgetcsv($file);
        $topics[] = new Topic($row[0], $row[2], $row[4], $row[5]);
    }
    fclose($file);

    return $topics;
}

function generate(array $topics)
{
    include __DIR__ . '/template.phtml';
}

if (count($argv) < 2) {
    echo "Usage: {$argv[0]} <file>" . PHP_EOL;
    exit(1);
}

$topics = load_topics(__DIR__ . "/${argv[1]}");
generate($topics);

# vim: tabstop=4 shiftwidth=4
