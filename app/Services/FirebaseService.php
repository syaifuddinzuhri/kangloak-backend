<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class FirebaseService
{

    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = app('firebase.auth');
    }

    /**
     * Get list user all frompfirebase
     */
    public function listUsers()
    {
        // $auth = app('firebase.auth');
        $users = $this->firebaseAuth->listUsers($defaultMaxResults = 1000, $defaultBatchSize = 1000);

        $listUsers = [];
        foreach ($users as $user) {
            $listUsers[] = $user;
        }

        return $listUsers;
    }



    /**
     * Get spesific user from firebase
     * @param mixed $uid
     * @param mixed $email
     */
    public function getSpesificUser($uid, $email)
    {
        try {
            $auth = $this->firebaseAuth;
            $user = $auth->getUser($uid);
            $user = $auth->getUserByEmail($email);
            // $user = $auth->getUserByPhoneNumber('+49-123-456789');
            return $user;
        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
