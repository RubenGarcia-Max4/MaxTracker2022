<?php

/**
 * RokGallery_Model_Base_SliceTags
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $slice_id
 * @property string $tag
 * @property RokGallery_Model_Slice $Slice
 * 
 * @package    RokGallery
 * @subpackage models
 * @author     RocketTheme LLC <support@rockettheme.com>
 * @version    SVN: $Id: SliceTags.php 10871 2013-05-30 04:06:26Z btowles $
 */
abstract class RokGallery_Model_Base_SliceTags extends RokCommon_Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('rokgallery_slice_tags');
        $this->hasColumn('slice_id', 'integer', 4, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => true,
             'length' => '4',
             ));
        $this->hasColumn('tag', 'string', 50, array(
             'type' => 'string',
             'primary' => true,
             'length' => '50',
             ));


        $this->index('rokgallery_slice_tags_slice_id', array(
             'fields' => 
             array(
              0 => 'slice_id',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('RokGallery_Model_Slice as Slice', array(
             'local' => 'slice_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
    }
}