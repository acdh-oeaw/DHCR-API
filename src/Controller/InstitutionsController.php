<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Institutions Controller
 *
 * @property \App\Model\Table\InstitutionsTable $Institutions
 *
 * @method \App\Model\Entity\Institution[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InstitutionsController extends AppController
{
    public $modelClass = 'DhcrCore.Institutions';

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	public function index() {
		$this->Institutions->evaluateQuery($this->request->getQuery());
		$institutions = $this->Institutions->getInstitutions();
		$this->set('institutions', $institutions);
	}

    /**
     * View method
     *
     * @param string|null $id Institution id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function view($id = null) {
		$institution = $this->Institutions->getInstitution($id);
		$this->set('institution', $institution);
	}


}
