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
use php\util\Regex;

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
     */

    public function build()
    {
        $directory = new File('./src-jvm/main/java/');
        $javaClasses = fs::scan($directory, ['extensions' => ['java'], 'excludeDirs' => true]);

        $sdkDir = 'sdk/php/' . fs::name(fs::parent(end($javaClasses)));

        Tasks::createDir($sdkDir);
        Tasks::cleanDir($sdkDir);

        foreach ($javaClasses as $value) {
            $sourse = fs::get($value, 'UTF-8', 'r');
            
            //Имя php класса полученное из Java класса
            $namePhpClass = Regex::of('@Name\(\"(.*?)\"\)')->with($sourse);

            if ($namePhpClass->find()) {
                Console::log($namePhpClass->first()[1]);
            }
        }
    }
}
