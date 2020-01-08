<?php

namespace App\DataPersister;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersDataPersister implements DataPersisterInterface
{
    private $encoder;
    private $manager;

    public function __construct(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
      $this->encoder = $encoder; 
      $this->manager = $manager;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Users;
    }

    public function persist($data, array $context = [])
    { 
      if ($data->getPassword()) 
      {
        $data->setPassword(
            $this->encoder->encodePassword($data, $data->getPassword())
        );
        $data->eraseCredentials();
      }
      $this->manager->persist($data);
      $this->manager->flush();
    }

    public function remove($data, array $context = [])
    {
      $this->manager->remove($data);
      $this->manager->flush();
    }
}