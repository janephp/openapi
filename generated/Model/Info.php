<?php

namespace Joli\Jane\Swagger\Model;

class Info
{
    /**
     * @var string
     */
    protected $title;
    /**
     * @var string
     */
    protected $version;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $termsOfService;
    /**
     * @var Contact
     */
    protected $contact;
    /**
     * @var License
     */
    protected $license;
    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
    /**
     * @param string $version
     *
     * @return self
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
    /**
     * @return string
     */
    public function getTermsOfService()
    {
        return $this->termsOfService;
    }
    /**
     * @param string $termsOfService
     *
     * @return self
     */
    public function setTermsOfService($termsOfService)
    {
        $this->termsOfService = $termsOfService;

        return $this;
    }
    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }
    /**
     * @param Contact $contact
     *
     * @return self
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }
    /**
     * @return License
     */
    public function getLicense()
    {
        return $this->license;
    }
    /**
     * @param License $license
     *
     * @return self
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }
}
