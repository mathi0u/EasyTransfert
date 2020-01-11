<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ApiResource(
 *      attributes=
 *      {
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Desole, vous n'avez pas les droits requis pour executer cette action ...!"
 *      
 *      },
 *      collectionOperations=
 *      {
 *          "get"=
 *          {
 *              "path"="/get/users"
 * 
 *          },"post"=
 *          {
 *              "path"="/add/user"
 *          }
 *      },
 *     itemOperations=
 *     {
 *          "get"=
 *          {   
 *              "path"="/get/user/{id}",
 *              "requirements"={"id"="\d+"}   
 *          }
 *          ,"delete"=
 *          {
 *              "path"="/delete/user/{id}",
 *              "requirements"={"id"="\d+"}
 *          }
 *          ,"put"=
 *          {
 *              "path"="/edit/user/{id}",
 *              "requirements"={"id"="\d+"}
 *          }
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ApiFilter(BooleanFilter::class, properties={"isActive":true})
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Email(message = "Veuillez inserez un email valide SVP...!")
     *
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     *
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @NotBlank(message="Veuillez inserez votre mot de passe SVP...!")
     * @Length(min=8, minMessage="Le mot de passe doit comporter au moin 8 carateres SVP...!")
     */
    private $password;

    
    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank(message="Veuillez inserez votre prenom SVP...!")
     * @Length(min=2, minMessage="Le prenom doit comporter au moins 2 carateres SVP...!")
     *
     */
    private $userFisrtName;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank(message="Veuillez inserez votre nom SVP...!")
     * @Length(min=2, minMessage="Le nom doit comporter au moins 2 carateres SVP...!")
     *
     */
    private $userLastName;

    /**
     * @ORM\Column(type="boolean", length=255)
     *
     */
    private $userStatut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Roles")
     * 
     *
     */
    private $role;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $UserRole = $this->roles;
        // guarantee every user at least has ROLE_USER
        $UserRole[] = 'ROLE_USER';

        return array_unique($UserRole);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getUserFisrtName(): ?string
    {
        return $this->userFisrtName;
    }

    public function setUserFisrtName(string $userFisrtName): self
    {
        $this->userFisrtName = $userFisrtName;

        return $this;
    }

    public function getUserLastName(): ?string
    {
        return $this->userLastName;
    }

    public function setUserLastName(string $userLastName): self
    {
        $this->userLastName = $userLastName;

        return $this;
    }

    public function getUserStatut(): ?string
    {
        return $this->userStatut;
    }

    public function setUserStatut(string $userStatut): self
    {
        $this->userStatut = $userStatut;

        return $this;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(Roles $role): self
    {
        $this->role = $role;

        return $this;
    }

}
