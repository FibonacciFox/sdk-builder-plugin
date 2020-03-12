<?php

use packager\{
    cli\Console,
    Event,
    JavaExec,
    Packager,
    Vendor
};

use php\io\File;
use php\lib\fs;

/**
 * Class SdkBuilderPlugin
 * @jppm-task-prefix sdk
 *
 * @jppm-task build as build
 */
class SdkBuilderPlugin
{

    /**
     * @jppm-need-package
     * @jppm-description Build php sdk with java.
     * @param Event $event
     */

    public function build(Event $e)
    {
        $directory = new File('./src-jvm/main/java/');
        //Массив Java Классов
        $javaClasses = fs::scan($directory, ['extensions' => ['java'], 'excludeDirs' => true]);
        
        $mainDir = fs::parent(end($javaClasses));

        Tasks::createDir('sdk/php/' . fs::name($mainDir));
        Tasks::cleanDir('sdk/php' . fs::name($mainDir));
    }
}
