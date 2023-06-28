<?php
class ControllerModuleAnimals extends Controller {
    public function index() {
        //чи залогінений
        if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}
        //чи включений модуль
        $this->load->model('setting/setting');
        $module_animals_status = $this->model_setting_setting->getSetting('animals');
        if ($module_animals_status['animals_status']==0) {
            return;
        }

        $this->load->model('extension/animals');
        $this->load->language('module/animals');
        
        $data['users_animals'] = $this->model_extension_animals->getUserAnimals($this->customer->getId());
        $animals = $this->model_extension_animals->getAllAnimals();
        $data['animals'] = [];
        $data['breeds'] = [];
        foreach ($animals->rows as $id_animal=>$name_animal){
            $data['animals'] += [$name_animal['id']=>$name_animal];
            
            $breeds = $this->model_extension_animals->getBreedsByIdAnimals($name_animal['id']);
            foreach ($breeds->rows as $breed){
                $data['breeds'][] = [
                    'id'=>$breed["id"], 
                    'animal_id'=>$breed["animal_id"], 
                    'breed'=>$breed["breed"], 
                    'sex'=>$breed["sex"]
                ];
            }
        }
        $data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
        $data['action'] = $this->url->link('module/animals/addPet', 'token=' . $this->session->data['token'], true);
        $data['delete'] = $this->url->link('module/animals/deletePet', 'token=' . $this->session->data['token'], true);
        $this->response->setOutput($this->load->view('default/template/module/animals.tpl', $data));
    }
    
    // Додавання animal
    public function addPet() {
        $this->load->model('extension/animals');
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
                $customer_id = $this->customer->getId();
                $animal_id = $this->request->post['pet_type'];
                $name_animals = $this->model_extension_animals->getNameAnimalsById($animal_id);
                $breed = $this->request->post['breed'];
                $name_breed = $this->model_extension_animals->getBreedsById($breed);
                $gender = $this->request->post['gender'];
                $age = $this->request->post['age'];
                $addUserAnimal = $this->model_extension_animals->addUserAnimals($customer_id, $name_animals['name'], $name_breed['breed'], $gender, $age);
                echo $addUserAnimal;
        }
    }
    
    // Видалення animal
    public function deletePet() {
        $this->load->model('extension/animals');
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $user_animal_id = $this->request->post['delete_user_animal_id'];
            $this->model_extension_animals->deleteUserAnimals($user_animal_id);
        }
    }
}
?>