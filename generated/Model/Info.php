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
     * @var \Joli\Jane\Swagger\Contact
     */
    protected $contact;
    /**
     * @var \Joli\Jane\Swagger\License
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
    public function setTitle($title = null)
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
    public function setVersion($version = null)
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
    public function setDescription($description = null)
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
    public function setTermsOfService($termsOfService = null)
    {
        $this->termsOfService = $termsOfService;

        return $this;
    }
    /**
     * @return \Joli\Jane\Swagger\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }
    /**
     * @param \Joli\Jane\Swagger\Contact $contact
     *
     * @return self
     */
    public function setContact($contact = null)
    {
        $this->contact = $contact;

        return $this;
    }
    /**
     * @return \Joli\Jane\Swagger\License
     */
    public function getLicense()
    {
        return $this->license;
    }
    /**
     * @param \Joli\Jane\Swagger\License $license
     *
     * @return self
     */
    public function setLicense($license = null)
    {
        $this->license = $license;

        return $this;
    }
}
