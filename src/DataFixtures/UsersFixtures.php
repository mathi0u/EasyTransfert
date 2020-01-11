<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsersFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {   
        
        $AdminUser = new Users();
        $AdminUser->setUsername("superadmin@et.et");
        $AdminUser->setRoles(["ROLE_SUPER_ADMIN"]);
        $AdminUser->setUserFisrtName("super");
        $AdminUser->setUserLastName("admin");
        $AdminUser->setUserStatut(true);
        $AdminUser->setPassword($this->encoder->encodePassword($AdminUser,"EasyTransfert"));
        
        $manager->persist($AdminUser);
        $manager->flush();

        for ($i =0; $i<10;$i++)
        { 
            $admin = new Users();
            $admin->setUsername("admin{$i}@et.et");
            $admin->setRoles(["ROLE_ADMIN"]);
            $admin->setUserFisrtName("admin{$i}");
            $admin->setUserLastName("ad{$i}");
            $admin->setUserStatut(true);
            $admin->setPassword($this->encoder->encodePassword($admin,"adminnn{$i}"));
            
            $manager->persist($admin);
            $manager->flush();
        }

        for ($i =0; $i<20;$i++)
        { 
            $cashier = new Users();
            $cashier->setUsername("cashier{$i}@et.et");
            $cashier->setRoles(["ROLE_CASHIER"]);
            $cashier->setUserFisrtName("cashier{$i}");
            $cashier->setUserLastName("ca{$i}");
            $cashier->setUserStatut(true);
            $cashier->setPassword($this->encoder->encodePassword($cashier,"cashier{$i}"));
            
            $manager->persist($cashier);
            $manager->flush();
        }

        
    }
}
