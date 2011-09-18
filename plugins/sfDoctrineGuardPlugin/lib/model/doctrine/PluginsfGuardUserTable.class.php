<?php

/**
 * User table.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage model
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardUserTable.class.php 25546 2009-12-17 23:27:55Z Jonathan.Wage $
 */
abstract class PluginsfGuardUserTable extends Doctrine_Table {

    /**
     * Retrieves a sfGuardUser object by username and is_active flag.
     *
     * @param  string  $username The username
     * @param  boolean $isActive The user's status
     *
     * @return sfGuardUser
     */
    public function retrieveByUsername($username, $isActive = true) {
        $query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
                ->where('u.username = ?', $username)
                ->addWhere('u.is_active = ?', $isActive)
        ;

        return $query->fetchOne();
    }

    /**
     * Retrieves a sfGuardUser object by username or email_address and is_active flag.
     *
     * @param  string  $username The username
     * @param  boolean $isActive The user's status
     *
     * @return sfGuardUser
     */
    public function retrieveByUsernameOrEmailAddress($username, $isActive = true) {
        $query = Doctrine_Core::getTable('sfGuardUser')->createQuery('u')
                ->where('u.username = ? OR u.email_address = ?', array($username, $username))
                ->addWhere('u.is_active = ?', $isActive)
        ;

        return $query->fetchOne();
    }

    public function getUsersWith($string) {
        $query = Doctrine_Query::create()
                ->from('sfGuardUser e')
                ->where('LOWER(e.username) LIKE ?', '%' . $string . '%')
                ->orderBy('e.username ASC')
                ->execute();

        return $query;
    }
    public function getEmailWith($string) {
        $query = Doctrine_Query::create()
                ->from('sfGuardUser e')
                ->where('LOWER(e.email_address) LIKE ?', '%' . $string . '%')
                ->orderBy('e.username ASC')
                ->execute();

        return $query;
    }

    public function getAllUsers($sex = null, $minAge= null, $maxAge= null, $country= null) {
        $query = Doctrine_Query::create()
                ->from('sfGuardUser e');

        if ($sex != null) {
            if ($sex == '2')
                $query->where('e.sex = ?', '');
            else
                $query->where('e.sex = ?', $sex);
        }

        if ($minAge != null && $maxAge != null) {
            $from = null;
            $thisYear = date('Y');
            $thisMonth = date('m');
            $thisDay = date('d');

            $yearSearch = $thisYear - $minAge;
            $from = $yearSearch . '-' . $thisMonth . '-' . $thisDay;

//                    $query->where('e.birthday < ?', $dateSearch);

            $to = null;
            $thisYear = date('Y');
            $thisMonth = date('m');
            $thisDay = date('d');

            $yearSearch = $thisYear - $maxAge;
            $to = $yearSearch . '-' . $thisMonth . '-' . $thisDay;

//                    $query->where('e.birthday > ?', $dateSearch);
            $query->andWhere('e.birthday BETWEEN ? AND ?', array($to, $from));
        }

        if ($country != null) {
            $query->andWhere('e.country_id = ?', $country);
        }


        $query->orderBy('e.username ASC');
        return $query->execute();
    }

}
