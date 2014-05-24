<?php

class ModQueueForum_Model_ThreadForumNames extends Xenforo_Model {

    /**
     * @param array $threadIds An array of thread ids.
     * @return array Array of forum names/ids.
     */
    public function getForumNamesFromThreadIds(array $threadIds) {
        $sql = "SELECT thread_id, xf_node.title, xf_node.node_id FROM xf_thread JOIN xf_node ON xf_thread.node_id=xf_node.node_id WHERE xf_thread.thread_id IN (" . $this->_getDb()->quote($threadIds) . ")";
        $results = $this->_getDb()->fetchAll($sql);
        $finalData = [];
        foreach ($results as $result) {
            $finalData[$result['thread_id']] = array("title" => $result['title'], "id" => $result['node_id']);
        }
        return $finalData;
    }
}