<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Email(message = "Veuillez inserez un email valide SVP...!")
     */
    private $userEmail;

    /**
     * @ORM\Column(type="json")
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
     */
    private $userFisrtName;

    /**
     * @ORM\Column(type="string", length=255)
     * @NotBlank(message="Veuillez inserez votre nom SVP...!")
     * @Length(min=2, minMessage="Le nom doit comporter au moins 2 carateres SVP...!")
     */
    private $userLastName;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $userStatut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->userEmail;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
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
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
}
