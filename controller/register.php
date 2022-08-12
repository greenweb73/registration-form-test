<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$logger = new Logger('main');

$register = new Register(new Model\Users(), $_POST, $logger);

echo json_encode($register->hundler());

class Register {
    private $logger;
    private $response;

    public function __construct(Model\Users $users, $data, \Psr\Log\LoggerInterface $logger)
    {
        $this->users = $users;
        $this->data = $data;
        $this->logger = $logger;
        $this->logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/logs/registers.log'));
        $this->response = [];
    }

    public function hundler() {
        if ($this->checkPasswMatch()) {
            $this->logger->info('Error! User password is not missmatch');
            return $this->getResponse();
        } elseif ($this->checkUserAviable()) {
            $this->logger->info('Error! User with email: ' . $this->data['email'] . ' is already registered');
            return $this->getResponse();
        } else {
            $this->logger->info('User with email: ' . $this->data['email'] . ' has been successfully registered');
            $this->response['success'] = 'ok';
            return $this->getResponse();
        }
    }

    public function getResponse() {
        return $this->response;
    }

    public function checkPasswMatch() {
        if ($this->data['passw'] !== $this->data['cpassw']) {
            $this->response['success'] = 'no';
            $this->response['error']['passws_not_match'] = true;
            return true;
        }
        return false;
    }

    public function checkUserAviable() {
        if($this->users->findUserByEmail($this->data['email'])) {
            $this->response['success'] = 'no';
            $this->response['error']['user_aviable'] = true;
            return true;
        }
        return false;
    }
}
