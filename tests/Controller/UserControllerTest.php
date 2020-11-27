<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class UserControllerTest extends WebTestCase
{
    // on se connecte
    protected function createAuthenticatedClient(string $username, string $password): KernelBrowser
    {
        $client = static::createClient();
        $connexion = [
            "username" => $username,
            "password" => $password
        ];
        $client->request(
            'POST',
            '/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($connexion)
        );
        $data = \json_decode($client->getResponse()->getContent(), true);
        $client->setServerParameter('HTTP_Authorization', \sprintf('Bearer %s', $data['token']));
        
        $client->setServerParameter('CONTENT_TYPE', 'application/json');
        //dd($client);
        return $client;
    }
// on teste la liste de profils

    public function testListUsers()
    {
        $client = $this->createAuthenticatedClient("ADMIN1", "pass1234");
        $client->request('GET', '/api/admin/users');
        //dd($client->getResponse()->getStatusCode());
        $this->assertResponseStatusCodeSame(200);
      }

 
   }

      /* public function testShowUser()
    {   
        $user = static::createClient();
        
        $user->request('GET', '/api/admin/users');

        $this->assertEquals(200, $user->getResponse()->getStatusCode());
    } */
