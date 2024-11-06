<?php
namespace AliKhaleghi\AdminPanel\Controllers\Admin;

use AliKhaleghi\AdminPanel\Controllers\MusicController;
use AliKhaleghi\AdminPanel\Entities\Artist;
use AliKhaleghi\AdminPanel\Entities\Plugin;
use AliKhaleghi\AdminPanel\Models\PluginModel;
use CodeIgniter\Controller;

use CodeIgniter\API\ResponseTrait;

class PluginController extends Controller
{
	use ResponseTrait; 

    public function __construct() { } 

    public function list() {
        
        $model = model(PluginModel::class);

		// Limit Results
		if((int)$this->request->getGet("limit") || (int)$this->request->getGet("itemsPerPage")) {
		
			if((int)$this->request->getGet("limit"))        $limit = (int)$this->request->getGet("limit");
			if((int)$this->request->getGet("itemsPerPage")) $limit = (int)$this->request->getGet("itemsPerPage");
		}
		else
			$limit   = 10;
			

		if($limit == '-1') $limit = 999999;

		$model->where("id != 0", NULL, NULL);

        $countAll = $model->countAllResults(false); 

		$model->where("id !=0");

		$list    = $model->paginate($limit);

		foreach ($list as $key => $item)
		{
			$list[$key] = $item;
		}

		return $this->respond([
			'status' => 'Ok',
			'data'   => [
				'total'         => $model->pager->getPageCount(),
				'total_rows'    => $countAll,
				'items'         => $list,
				'pager'         => $model->pager
			]
		], 200);
    }

    /**
     * Create Plugin
     */
    public function create() {
        

		$rules = [
			'name'	=> [
                'label' => lang('Plugin.name'),
                'rules' => [
                    'required'
                ]
            ],
			'slug'	=> [
                'label' => lang('Plugin.slug'),
                'rules' => 'required|is_unique[AdminPanel_plugins.slug]'
            ],
		];
        

		if (! $this->validate($rules))
		{
            $response = [
                'OK'     => false,
                'errors' => $this->validator->getErrors(), 
            ];
            return $this->fail($response , 409);
		}

        $model = model(PluginModel::class);
    
        $data = [ 
            'name'          => $this->request->getVar('name') ?: '',
            'description'   => $this->request->getVar('description') ?: '',
            'slug'          => $this->request->getVar('slug') ?: '',
            'files'         => json_encode(['cover' => NULL, 'playable' => []]),
            'released_at'   => date("Y-m-d H:i:s"),
        ];

        // Create a new Plugin entity
        $plugin = new Plugin($data);
        $plugin->fill($data);

        // Save the Plugin inside database
        $model->insert($plugin);
        
        // New Plugin ID
        $recordID = $model->getInsertID();
        
        // New Plugin Data
        $newRecord = $model->find($recordID);

		return $this->respond([
			'status' => 'Ok',
			'item'   => $newRecord
		], 200);
    }

    /**
     * Update Plugin
     */
    public function update() {

		$rules = [
			'id'	=> [
                'label' => lang('Plugin.id'),
                'rules' => [
                    'is_not_unique[AdminPanel_plugins.id,id]'
                ]
            ],
			'name'	=> [
                'label' => lang('Plugin.name'),
                'rules' => [
                    'required'
                ]
            ],
		];
        
		if (! $this->validate($rules))
		{
            $response = [
                'OK'     => false,
                'errors' => $this->validator->getErrors(), 
            ];
            return $this->fail($response , 409);
		}

        $model = model(PluginModel::class);
        $ID = $this->request->getVar('id');

        $record = $model->find($ID);
        
        $record = $record->toArray();
    
        $record['name']          = $this->request->getVar('name') ?: '';
        $record['description']   = $this->request->getVar('description') ?: '';

        if($this->request->getVar('update-slug') == 'yes') $record['slug']  = $this->request->getVar('slug') ?: '';

        $record['files']         = json_encode(['cover' => NULL, 'playable' => []]);
        
        // $record['released_at']   = date("Y-m-d H:i:s");

        try {
            // Save the Artist inside database
            $model->save($record);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $record = $model->find($ID);
        
		return $this->respond([
			'status' => 'Ok',
			'item'   => $record
		], 200);
    }

    public function delete() {
        
		$rules = [
			'id'	=> [
                'label' => lang('Artist.id'),
                'rules' => [
                    'is_not_unique[music_artists.id,id]'
                ]
            ],
        ];

		if (! $this->validate($rules))
		{
            $response = [
                'OK'     => false,
                'errors' => $this->validator->getErrors(), 
            ];
            return $this->fail($response , 409);
		}

        $id = $this->request->getVar('id');

        $model = model(PluginModel::class);

        $model->where('id', $id)->delete();
        
		return $this->respond([
			'status' => 'Ok',
			'message'   => lang("Artist.deleted")
		], 200);
    }
}
