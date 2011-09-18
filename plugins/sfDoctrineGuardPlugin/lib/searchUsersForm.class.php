
<?php

/**
 * PluginsfGuardUser form.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardUserForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class searchUsersForm extends sfForm {

    

    public function configure() {
        for ($i = '18'; $i <= '100'; $i++) {
            $anios[$i] = $i;
        }
        $radios = array('Man', 'Woman', 'No Matters');
        
        $this->widgetSchema['sex'] = new sfWidgetFormChoice(array(
                    'expanded' => false,
                    'choices' => $radios,
                ));

       $this->widgetSchema['from'] = new sfWidgetFormChoice(array(
                    'expanded' => false,
                    'choices' => $anios,
                ));
       
       $this->widgetSchema['to'] = new sfWidgetFormChoice(array(
                    'expanded' => false,
                    'choices' => $anios,
                ));
       
//       $this->widgetSchema['country']  = new sfWidgetFormDoctrineChoice(array(
//           'model' => 'Country', 
//           'add_empty' => 'All countrys'
//               ));
    }

}
