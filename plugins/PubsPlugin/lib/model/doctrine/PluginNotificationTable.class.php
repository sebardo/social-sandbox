<?php

/**
 * PluginNotificationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginNotificationTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object PluginNotificationTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('PluginNotification');
    }

    public static function insertNotification($user=null, $dest=null, $model=null, $id=null, $related_model=null, $date=null) {
        $noti = Doctrine::getTable('notification')->getNoti($model, $id, $user, $dest, $related_model);
        if (!$noti){
            $not = new Notification();
            $not->setUserId($user);
            $not->setDestUserId($dest);
            $not->setRecordModel($model);
            $not->setRecordId($id);
            $not->setRelatedModel($related_model);
            $not->setCreatedAt($date);
            //guardo el objeto
            $not->save();
        }
    }
    
    public static function getNoti($model=null, $id=null, $user=null, $dest=null, $related_model=null) {
        $q = Doctrine_Query::create()
                ->from('notification n')
                ->where('n.user_id = ?', $user)
                ->andWhere('n.dest_user_id = ?', $dest)
                ->andWhere('n.record_model = ?', $model)
                ->andWhere('n.related_model = ?', $related_model)
                ->andWhere('n.record_id = ?', $id);
        return $q->fetchOne();
    }
    
    public static function activate($id=null) {
        Doctrine_Query::create()
                ->update('notification n')
                ->set('n.is_active', '?', true)
                ->where('n.id = ?', $id)
                ->execute();
    }

}