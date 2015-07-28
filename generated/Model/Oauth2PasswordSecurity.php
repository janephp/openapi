<?php
namespace Joli\Jane\Swagger\Model;

class Oauth2PasswordSecurity
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $flow;

    /**
     * @var string[]
     */
    protected $scopes;

    /**
     * @var string
     */
    protected $tokenUrl;

    /**
     * @var string
     */
    protected $description;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getFlow()
    {
        return $this->flow;
    }

    /**
     * @param string $flow
     */
    public function setFlow($flow)
    {
        $this->flow = $flow;
    }

    /**
     * @return string[]
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param string[] $scopes
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }

    /**
     * @return string
     */
    public function getTokenUrl()
    {
        return $this->tokenUrl;
    }

    /**
     * @param string $tokenUrl
     */
    public function setTokenUrl($tokenUrl)
    {
        $this->tokenUrl = $tokenUrl;
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
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
}
