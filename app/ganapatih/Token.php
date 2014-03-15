<?php namespace Ganapatih;

use Session;

class Token
{

    private $registered = array();
    private $sessionKey = '__token_api.lists';

    public function push($value)
    {
        $check = $this->isRegistered($value);
        $all   = $this->all();

        /*
         * only set if data not registered (new)
         */
        if (!$check || empty($all)) {
            Session::push($this->sessionKey, $value);
        }

        //remove duplicate values
        $this->cleanDuplicate();
    }

    public function isRegistered($value)
    {
        $all = Session::get($this->sessionKey, array());
        if (!empty($all) && is_array($all)) {
            foreach ($all as $val) {
                if ($val == $value) {
                    return true;
                }
            }
        }

        return false;
    }

    public function delete($value)
    {
        $all = Session::get($this->sessionKey, array());
        if (!empty($all) && is_array($all)) {

            /*
             * search and format new array
             */
            $new = array();
            foreach ($all as $key => $val) {
                if ($val != $value) {
                    $new[] = $val;
                }
            }

            //reset & clean up session data
            $this->cleanUp($new);

        }
    }

    public function all()
    {
        return Session::get($this->sessionKey);
    }

    public function cleanDuplicate()
    {
        /*
         * get all registered session data
         */
        $all = $this->all();
        if (!empty($all)) {
            $new = array_unique($all);
            $this->cleanUp($new);
        }
    }

    public function cleanUp($new = array())
    {
        /*
         * reset all data
         * replace with new if given
         */
        Session::forget($this->sessionKey);
        Session::put($this->sessionKey, $new);
    }

}
