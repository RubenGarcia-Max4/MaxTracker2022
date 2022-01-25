<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version2 extends RokCommon_Doctrine_Migration_Base
{

    protected $run = false;

    public function up()
    {
        if ($this->run) {

            // Files to Files_Index
            $rokgallery_files_index_id_idx = array(
                'local' => 'id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_files_index', RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files_index_id_idx'), $rokgallery_files_index_id_idx);

            // Files to FileLoves
            $file_loves_file_id_files_id = array(
                'local' => 'file_id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_file_loves', RokCommon_Doctrine::getPlatformInstance()->setTableName('file_loves_file_id_files_id'), $file_loves_file_id_files_id);

            // File to File Tags
            $file_tags_file_id_files_id = array(
                'local' => 'file_id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_file_tags', RokCommon_Doctrine::getPlatformInstance()->setTableName('file_tags_file_id_files_id'), $file_tags_file_id_files_id);


            // File to File Views
            $file_views_file_id__files_id = array(
                'local' => 'file_id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_file_views', RokCommon_Doctrine::getPlatformInstance()->setTableName('file_views_file_id__files_id'), $file_views_file_id__files_id);

            // File to Slices
            $slices_file_id_files_id = array(
                'local' => 'file_id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_slices', RokCommon_Doctrine::getPlatformInstance()->setTableName('slices_file_id_files_id'), $slices_file_id_files_id);

            // Galleries to Slices
            $slices_gallery_id_galleries_id = array(
                'local' => 'gallery_id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_galleries'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_slices', RokCommon_Doctrine::getPlatformInstance()->setTableName('slices_gallery_id_galleries_id'), $slices_gallery_id_galleries_id);


            // Slices to Slices index
            $rokgallery_slices_index_id_idx = array(
                'local' => 'id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_slices'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_slices_index', RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_slices_index_id_idx'), $rokgallery_slices_index_id_idx);

            // Slices to slice tags
            $slice_tags_slice_id_slices_id = array(
                'local' => 'slice_id',
                'foreign' => 'id',
                'foreignTable' => RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_slices'),
                'onDelete' => 'CASCADE',
                'onUpdate' => 'CASCADE'
            );
            $this->createForeignKey('rokgallery_slice_tags', RokCommon_Doctrine::getPlatformInstance()->setTableName('slice_tags_slice_id_slices_id'), $slice_tags_slice_id_slices_id);
        }
    }

    public function down()
    {
    }

    public function preUp()
    {
        if (!$this->isInnoDBEngine(RokCommon_Doctrine::getPlatformInstance()->getSchema(), RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files'))) {
            $this->run = true;

            //Clean up bad data

            //RokGallery_Model_FileTags
            $q = Doctrine_Query::create()
                ->delete('RokGallery_Model_FileTags ft')
                ->andWhere('ft.file_id NOT IN (SELECT f.id from RokGallery_Model_File f)');
            $q->execute();
            $q->free();

            //RokGallery_Model_FileViews
            $q = Doctrine_Query::create()
                ->delete('RokGallery_Model_FileViews fv')
                ->andWhere('fv.file_id NOT IN (SELECT f.id from RokGallery_Model_File f)');
            $q->execute();
            $q->free();

            //RokGallery_Model_FileLoves
            $q = Doctrine_Query::create()
                ->delete('RokGallery_Model_FileLoves fl')
                ->andWhere('fl.file_id NOT IN (SELECT f.id from RokGallery_Model_File f)');
            $q->execute();
            $q->free();

            //rokgallery_files_index
            $conn = Doctrine_Manager::connection();
            $dbh = $conn->getDbh();
            $stmt = $dbh->prepare('delete from ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files_index')
                    . ' where id NOT IN (SELECT f.id from ' . RokGallery_Model_FileTable::getInstance()->getTableName() . ' f)');
            $stmt->execute();


            //RokGallery_Model_Slice
            $q = Doctrine_Query::create()
                ->delete('RokGallery_Model_Slice s')
                ->andWhere('s.file_id NOT IN (SELECT f.id from RokGallery_Model_File f)');
            $q->execute();
            $q->free();

            //RokGallery_Model_SliceTags
            $q = Doctrine_Query::create()
                ->delete('RokGallery_Model_SliceTags st')
                ->andWhere('st.slice_id NOT IN (SELECT s.id from RokGallery_Model_Slice s)');
            $q->execute();
            $q->free();

            //rokgallery_slices_index
            $stmt = $dbh->prepare('delete from ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_slices_index')
                    . ' where id NOT IN (SELECT s.id from ' . RokGallery_Model_SliceTable::getInstance()->getTableName() . ' s)');
            $stmt->execute();

            //RokGallery_Model_Gallery
            $q = Doctrine_Query::create()
                ->update('RokGallery_Model_Slice')
                ->set('gallery_id', 'NULL')
                ->andWhere('gallery_id NOT IN (SELECT g.id from RokGallery_Model_Gallery g)');
            $q->execute();
            $q->free();

            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_file_loves') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_file_views') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_file_tags') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_files_index') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_filters') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_galleries') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_jobs') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_profiles') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_schema_version') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_slice_tags') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_slices') . ' ENGINE=INNODB');
            $dbh->exec('alter table ' . RokCommon_Doctrine::getPlatformInstance()->setTableName('rokgallery_slices_index') . ' ENGINE=INNODB');

        }
    }


    /**
     * @param $schema
     * @param $table
     * @return bool true if the table is an innodb table
     * @throws Doctrine_Migration_Exception
     */
    protected function isInnoDBEngine($schema, $table)
    {
        $conn = Doctrine_Manager::connection();
        $dbh = $conn->getDbh();
        $drive_name = $dbh->getAttribute(constant("PDO::ATTR_DRIVER_NAME"));
        if (strtolower($drive_name) != 'mysql') {
            throw new Doctrine_Migration_Exception(Doctrine_Core::ERR_UNSUPPORTED);
        }
        $stmt = $dbh->prepare('select ENGINE from  INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = :schema and TABLE_NAME = :name');
        $stmt->bindParam(':schema', $schema);
        $stmt->bindParam(':name', $table);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                $engine = $stmt->fetchColumn(0);
            }
            else {
                throw new Doctrine_Migration_Exception(Doctrine_Core::ERR_NOSUCHTABLE);
            }
        }
        if (strtolower($engine) == 'innodb') {
            return true;
        }
        return false;
    }

}