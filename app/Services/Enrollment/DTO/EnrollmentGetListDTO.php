<?php

namespace App\Services\Enrollment\DTO;

class EnrollmentGetListDTO
{
    private ?string $title;
    private ?string $userEmail;
    private ?string $userName;
    private ?string $status;
    private ?int $limit;
    private ?int $offset;

    public function __construct
    (
        ?string $title,
        ?string $userEmail,
        ?string $userName,
        ?string $status,
        ?int $limit,
        ?int $offset,
    ) {
        $this->title = $title;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->status = $status;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function getOffset(): ?int
    {
        return $this->offset;
    }
}
