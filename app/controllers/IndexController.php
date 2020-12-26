<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo '<h1>Hello!</h1>';
    }
    
    public function sendAction()
    {
        $this->view->disable();

        $user = new Users();

        if ($user) {
            echo '<h1>Отправил данные в монгу</h1>';
        }
        else {
            echo '<h1>не удалось соединиться с монгой</h1>';
        }

        if ($user->save() === false) {
            echo "Не могу добавить пользователя: \n";
        
            $messages = $user->getMessages();
        
            foreach ($messages as $message) {
                echo $message, "\n";
            }
        } else {
            echo 'Добавил нового пользователя!';
        }

    }
}