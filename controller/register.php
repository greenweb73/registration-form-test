<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$logger = new Logger('main');

$register = new Register(new Model\Users(), $_POST, $logger);

echo json_encode($register->hundler());

class Register {
    private \Psr\Log\LoggerInterface $logger;
    private array $response;
    private array $data;
    private \Model\Users $users;

    public function __construct(Model\Users $users, $data, \Psr\Log\LoggerInterface $logger)
    {
        $this->users = $users;
        $this->data = $data;
        $this->logger = $logger;
        $this->logger->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . '/logs/registers.log'));
    }

    public function hundler():array {
        if(!$this->isEmailValidation($this->data['email'])) {
            $this->response['success'] = 'no';
            $this->response['error']['email_is_no_correct'] = true;
            $this->logger->info('Error! User email is not valid');
        } elseif (!$this->isCheckPasswMatch()) {
            $this->response['success'] = 'no';
            $this->response['error']['passws_not_match'] = true;
            $this->logger->info('Error! User password is not mismatch');
        } elseif ($this->isCheckUserAviable()) {
            $this->response['success'] = 'no';
            $this->response['error']['user_available'] = true;
            $this->logger->info('Error! User with email: ' . $this->data['email'] . ' is already registered');
        } else {
            $this->users->addUser($this->data);
            $this->logger->info('User with email: ' . $this->data['email'] . ' has been successfully registered');
            $this->response['success'] = 'ok';
        }
        return $this->response;
    }

    public function isCheckPasswMatch():bool {
        if ($this->data['passw'] === $this->data['cpassw']) return true;
        return false;
    }

    public function isCheckUserAviable():bool {
        if($this->users->findUserByEmail($this->data['email'])) return true;
        return false;
    }

    public function isEmailValidation($email):bool {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        return false;
    }
}
