<?php
class ControllerModuleAnimals extends Controller {
    private $error = array();
    
    public function index() {
        
        $this->load->language('module/animals');
        $this->load->model('setting/setting');
        $this->load->model('extension/animals');
        //змінюєм статус і перевіряєм чи заповненні таблиці
        if (isset($this->request->post['animalsStatus'])) {
            $status = $this->request->post['animalsStatus']; // Отримання значення статусу з форми
            $this->model_setting_setting->editSettingValue('animals', 'animals_status', $status);
        }
        $module_animals_status = $this->model_setting_setting->getSetting('animals');
        
        $action = $this->url->link('module/animals', '', true);
        $data['heading_title'] = $this->language->get('heading_title');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['button_save'] = $this->language->get('button_save');
        $data['action'] = $action;
        $data['module_animals_status'] = $module_animals_status["animals_status"];
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        // Відображення шаблону модуля
        $this->response->setOutput($this->load->view('module/animals.tpl', $data));
    }
    
    public function install() {
        // Завантаження моделі модуля
        $this->load->model('setting/setting');
        $this->load->model('extension/animals');

        $this->model_extension_animals->maybeCreateDBTableUsersAnimals();
        $this->model_extension_animals->maybeCreateDBTableAnimals();
        $this->model_extension_animals->maybeCreateDBTableAnimalsBreed();
        // Встановлення значень за замовчуванням для модуля
        $default_settings = array(
            'animals_status' => 0, // Включений статус за замовчуванням
        );
        $this->model_setting_setting->editSetting('animals', $default_settings);
    }
    
    public function uninstall() {
        // Завантаження моделі модуля
        $this->load->model('setting/setting');
        
        // Видалення налаштувань модуля
        $this->model_setting_setting->deleteSetting('animals');
    }
}
?>