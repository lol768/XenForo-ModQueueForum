<?php

class ModQueueForum_Listener_ThreadQueueHandler {

    public static function hook($class, array &$extend) {
        $extend[] = 'ModQueueForum_ModerationQueueHandler_Thread';
    }

}