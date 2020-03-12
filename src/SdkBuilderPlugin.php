<?php
use packager\{
    cli\Console, Event, JavaExec, Packager, Vendor
};
/**
 * Class SdkBuilderPlugin
 * @jppm-task-prefix sdk
 *
 * @jppm-task build as build
 */
class SdkBuilderPlugin {

    /**
     * @jppm-need-package
     * @jppm-description Build php sdk with java.
     * @param Event $event
     */

    public function build(Event $e){
        
        Tasks::createDir('sdk/php');
        Tasks::cleanDir('sdk/php');

    }

}