<?php

/**
 * Moderation queue handler for threads.
 * @see XenForo_ModerationQueueHandler_Thread
 */
class ModQueueForum_ModerationQueueHandler_Thread extends XFCP_ModQueueForum_ModerationQueueHandler_Thread {
    /**
     * @see XenForo_ModerationQueueHandler_Thread::getVisibleModerationQueueEntriesForUser
     */
    public function getVisibleModerationQueueEntriesForUser(array $contentIds, array $viewingUser) {
        // Unfortunately the parent class already has the info we need but doesn't expose it
        // this means we ultimately need to get the same data again (or damage compatibility by
        // replacing this function altogether). Compromise is to use our own model to get only
        // the data we need without hitting performance by duplicating everything.

        $model = $this->getModel();
        $entries = $model->getForumNamesFromThreadIds(array_values($contentIds));

        $output = parent::getVisibleModerationQueueEntriesForUser($contentIds, $viewingUser);
        foreach ($contentIds as $id) {
            $output[$id]['forumData'] = $entries[$id];
        }


        return $output;
    }

    /**
     * @return ModQueueForum_Model_ThreadForumNames
     */
    public function getModel() {
        return XenForo_Model::create('ModQueueForum_Model_ThreadForumNames');
    }
}