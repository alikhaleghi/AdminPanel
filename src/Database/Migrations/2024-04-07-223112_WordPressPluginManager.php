<?php

namespace AliKhaleghi\AdminPanel\Database\Migrations;

use CodeIgniter\Database\Migration;

class WordPressPluginManager extends Migration
{
	public function up()
	{ 

		// ---------------------------------------------------------------------------------------------------------------------------

		// Plugins table
		$this->forge->addField([
			'id'				=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'name'				=> ['type' => 'varchar', 'constraint' => 50],
			'slug'				=> ['type' => 'varchar', 'constraint' => 50, 'unique' => true], 
			'configuration'		=> ['type' => 'text', 'constraint' => 255],
			'description'		=> ['type' => 'text', 'constraint' => 255],
			'files'				=> ['type' => 'text', 'constraint' => 255],
            'released_at'        => ['type' => 'datetime' ],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'updated_at'        => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);

		$this->forge->createTable('AdminPanel_plugins', true);

		// ---------------------------------------------------------------------------------------------------------------------------

        /*
         * Plans
         */
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'plugin_id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'name'				=> ['type' => 'varchar', 'constraint' => 50],
			'description'		=> ['type' => 'text', 'constraint' => 255],
            'months'			=> ['type' => 'int', 'constraint' => 11], 
            'cost'				=> ['type' => 'int', 'constraint' => 11], 
        ]);

        $this->forge->addKey('id', true);
		// Relate (FK) album.artist_id to artists.id
		$this->forge->addForeignKey('plugin_id'	, 'AdminPanel_plugins', 'id', '', 'CASCADE');

        $this->forge->createTable('AdminPanel_plans', true);

		// ---------------------------------------------------------------------------------------------------------------------------

        /*
         * Subscriptions to plans
         */
        $this->forge->addField([
            'id'                => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'plan_id'			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'api_key'			=> ['type' => 'text', 'constraint' => 255],
            'created_at'        => ['type' => 'datetime', 'null' => true],
            'renewal_at'        => ['type' => 'datetime', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
		
		$this->forge->addForeignKey('user_id'	, 'users', 'id', '', 'CASCADE');
		$this->forge->addForeignKey('plan_id'	, 'AdminPanel_plans', 'id', '', 'CASCADE');

        $this->forge->createTable('AdminPanel_plans_subscribed', true);
 
	}

	//--------------------------------------------------------------------

	public function down()
	{ 
		$this->forge->dropTable('AdminPanel_plugins', true);
		$this->forge->dropTable('AdminPanel_plans', true);
		$this->forge->dropTable('AdminPanel_plans_subscribed', true); 
	}
}
