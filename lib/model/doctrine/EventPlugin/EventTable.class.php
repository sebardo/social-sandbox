<?php

/**
 * EventTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EventTable extends PluginEventTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object EventTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Event');
    }
}