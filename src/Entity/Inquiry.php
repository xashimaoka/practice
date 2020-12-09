<?php

namespace App\Entity;

use App\Repository\InquiryRepository;
use Symfony\Component\Validator\Constraints As Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConferenceRepository::class)
 */
class Inquiry
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     * @Assert\Length(max=30)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(max=100)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max=20)
     * @ASSERT\Regex(pattern="/^[0-9-]+$/")
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(groups={"admin"})
     */
    private $processStatus;

    /**
     * @var string
     *
     * @ORM\Column(type="text", length=255)
     * @Assert\NotBlank(groups={"admin"})
     */
    private $processMemo;


    public function __construct()
    {
        $this->processStatus = 0;
        $this->processMemo = '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getProcessStatus(): ?string
    {
        return $this->processStatus;
    }

    public function setProcessStatus(string $processStatus): self
    {
        $this->processStatus = $processStatus;

        return $this;
    }

    public function getProcessMemo(): ?string
    {
        return $this->processMemo;
    }

    public function setProcessMemo(string $processMemo): self
    {
        $this->processMemo = $processMemo;

        return $this;
    }
}
