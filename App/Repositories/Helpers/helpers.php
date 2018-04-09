<?php


function getUser()
{
    try
    {

        /**
         * I would not do'it like this, rather i will have a Session Handling
         *  class that will return the user or an exception if the user is not logged in
         * For the sakes of the example let's assume the SessionHandler class in place and it will check if the user is logged in
         * and it will throw an ex if not.
         *
         * we can use the getUser function as a helper so we don't have to call all the time the instance :)
         */
//        if (!$loggedIn) return null;
//        else return $session->getUser();

        return SessionHandler::getInstance()->getUser();
    }
    catch (Exception $ex)
    {
        throw $ex;
    }
}