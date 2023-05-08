<?php
namespace Model;

use JetBrains\PhpStorm\Pure;

class Users {
    public array $users;
    private string $path;

    public function __construct()
    {
        //$this->setPath($_SERVER['DOCUMENT_ROOT'] . '/data/users.json');
        //$this->users = require $_SERVER['DOCUMENT_ROOT'] . '/data/users.php';
        $this->init();
    }

    private function init() {
        $this->setPath($_SERVER['DOCUMENT_ROOT'] . '/data/users.json');
        $data = ($this->getDataFromJsonFile()) ?? [];
        $this->setUsers($data);
    }

    public function addUser(array $user):void {
        $users = $this->getUsers();
        $users[] = $user;
        $this->setUsers($users);
        $this->saveDataToJsonFile($this->getUsers());
    }

    public function saveDataToJsonFile($data):void {
        file_put_contents($this->getPath(), json_encode($data));
    }

    public function getDataFromJsonFile():array|null {
        //var_dump(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/data/users.json', true);
        return json_decode(file_get_contents($this->getPath(), true));
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->users ;
    }

    /**
     * @param array $users
     */
    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @param string $email
     * @return array|null
     */
    public function findUserByEmail(string $email): bool {
        $result = null;
        $users = $this->getUsers();
        //var_dump($users);
        foreach ($users as $user) {

            if ($user->email === $email) return true;

        }
        return false;
    }
}
