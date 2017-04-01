<?php

/**
 * @package     ZF_CMS_JOR
 *
 * @author      Jor Sanders
 */

/**
 * api.
 *
 * @by Jor Sanders
 */
class CMS_Api
{

    /**
     * validate the api key.
     *
     * @return  boolean  .
     *
     * @by      Jor Sanders
     */
    protected function _validateKey($apiKey)
    {
        // this is for testing only
        if ($apiKey == 'test') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * search.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function search($apiKey, $keywords)
    {
        if (!$this->_validateKey($apiKey)) {
            return array('error' => 'invalid api key', 'status' => false);
        }

        // fetch the index and run the search
        $query = Zend_Search_Lucene_Search_QueryParser::parse($keywords);
        $index = Zend_Search_Lucene::open(APPLICATION_PATH . '/indexes');
        $hits = $index->find($query);

        // build the response array
        if (is_array($hits) && count($hits) > 0) {
            $response['hits'] = count($hits);
            foreach ($hits as $page) {
                $pageObj = new CMS_Content_Item_Page($page->page_id);
                $response['results']['page_' . $page->page_id] = $pageObj->toArray();
            }
        } else {
            $response['hits'] = 0;
        }
    }

    /**
     * create page.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function createPage($apiKey, $name, $headline, $description, $content)
    {
        if (!$this->_validateKey($apiKey)) {
            return array('error' => 'invalid api key', 'status' => false);
        }

        // create a new page item
        $itemPage = new CMS_Content_Item_Page();
        $itemPage->name = $name;
        $itemPage->headline = $headline;
        $itemPage->description = $description;
        $itemPage->content = $content;

        // save the content item
        $itemPage->save();

        // return the page as an array, which Zend_Rest will convert into the XML response
        return $itemPage->toArray();
    }

    /**
     * update page.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function updatePage($apiKey, $id, $name, $headline, $description, $content)
    {
        if (!$this->_validateKey($apiKey)) {
            return array('error' => 'invalid api key', 'status' => false);
        }

        // open the page
        $itemPage = new CMS_Content_Item_Page($id);

        // update it
        $itemPage->name = $name;
        $itemPage->headline = $headline;
        $itemPage->description = $description;
        $itemPage->content = $content;

        // save the content item
        $itemPage->save();

        // return the page as an array, which Zend_Rest will convert into the XML response
        return $itemPage->toArray();
    }

    /**
     * delete page.
     *
     * @return    .
     *
     * @by      Jor Sanders
     */
    public function deletePage($apiKey, $id)
    {
        if (!$this->_validateKey($apiKey)) {
            return array('error' => 'invalid api key', 'status' => false);
        }

        // open the page
        $itemPage = new CMS_Content_Item_Page($id);
        if ($itemPage) {
            $itemPage->delete();
            return true;
        } else {
            return false;
        }
    }

}
