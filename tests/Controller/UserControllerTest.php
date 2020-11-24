<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class UserControllerTest extends WebTestCase
{
    
    public function testShowUser()
    {   
        $user = static::createClient();
        
        $user->request('GET', '/api/admin/users');

        $this->assertEquals(200, $user->getResponse()->getStatusCode());
    }
}