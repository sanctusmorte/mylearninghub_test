<?php

namespace App\Services\Enrollment\DTO;

class EnrollmentGetListDTO
{
    private ?string $courseTitle;
    private ?string $userEmail;
    private ?string $userName;
    private ?string $status;
    private ?int $limit;
    private ?int $page;
    private ?string $sortColumn;
    private ?string $sortDir;

    public function __construct
    (
        ?string $courseTitle,
        ?string $userEmail,
        ?string $userName,
        ?string $status,
        ?int $limit,
        ?int $page,
        ?string $sortColumn,
        ?string $sortDir,
    ) {
        $this->courseTitle = $courseTitle;
        $this->userEmail = $userEmail;
        $this->userName = $userName;
        $this->status = $status;
        $this->limit = $limit;
        $this->page = $page;
        $this->sortColumn = $sortColumn;
        $this->sortDir = $sortDir;
    }

    public function getCourseTitle(): ?string
    {
        return $this->courseTitle;
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

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getSortColumn(): ?string
    {
        return $this->sortColumn;
    }

    public function getSortDir(): ?string
    {
        return $this->sortDir;
    }
}
