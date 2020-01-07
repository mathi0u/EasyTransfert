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
    }
}
