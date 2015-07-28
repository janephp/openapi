<?php
namespace Joli\Jane\Swagger\Model;

class Swagger
{
    /**
     * @var string
     */
    protected $swagger;

    /**
     * @var \Joli\Jane\Swagger\Model\Info
     */
    protected $info;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var string[]
     */
    protected $schemes;

    /**
     * @var string[]
     */
    protected $consumes;

    /**
     * @var string[]
     */
    protected $produces;

    /**
     * @var mixed[]|\Joli\Jane\Swagger\Model\PathItem[]
     */
    protected $paths;

    /**
     * @var \Joli\Jane\Swagger\Model\Schema[]
     */
    protected $definitions;

    /**
     * @var \Joli\Jane\Swagger\Model\BodyParameter[]|array[]
     */
    protected $parameters;

    /**
     * @var \Joli\Jane\Swagger\Model\Response[]
     */
    protected $responses;

    /**
     * @var string[][][]
     */
    protected $security;

    /**
     * @var \Joli\Jane\Swagger\Model\BasicAuthenticationSecurity[]|\Joli\Jane\Swagger\Model\ApiKeySecurity[]|\Joli\Jane\Swagger\Model\Oauth2ImplicitSecurity[]|\Joli\Jane\Swagger\Model\Oauth2PasswordSecurity[]|\Joli\Jane\Swagger\Model\Oauth2ApplicationSecurity[]|\Joli\Jane\Swagger\Model\Oauth2AccessCodeSecurity[]
     */
    protected $securityDefinitions;

    /**
     * @var \Joli\Jane\Swagger\Model\Tag[]
     */
    protected $tags;

    /**
     * @var \Joli\Jane\Swagger\Model\ExternalDocs
     */
    protected $externalDocs;

    /**
     * @return string
     */
    public function getSwagger()
    {
        return $this->swagger;
    }

    /**
     * @param string $swagger
     */
    public function setSwagger($swagger)
    {
        $this->swagger = $swagger;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param Info $info
     */
    public function setInfo(Info $info)
    {
        $this->info = $info;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string[]
     */
    public function getSchemes()
    {
        return $this->schemes;
    }

    /**
     * @param string[] $schemes
     */
    public function setSchemes($schemes)
    {
        $this->schemes = $schemes;
    }

    /**
     * @return string[]
     */
    public function getConsumes()
    {
        return $this->consumes;
    }

    /**
     * @param string[] $consumes
     */
    public function setConsumes($consumes)
    {
        $this->consumes = $consumes;
    }

    /**
     * @return string[]
     */
    public function getProduces()
    {
        return $this->produces;
    }

    /**
     * @param string[] $produces
     */
    public function setProduces($produces)
    {
        $this->produces = $produces;
    }

    /**
     * @return mixed[]|\Joli\Jane\Swagger\Model\PathItem[]
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * @param PathItem[] $paths
     */
    public function setPaths($paths)
    {
        $this->paths = $paths;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Schema[]
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     * @param Schema[] $definitions
     */
    public function setDefinitions($definitions)
    {
        $this->definitions = $definitions;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\BodyParameter[]|array[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param BodyParameter[]|array[] $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Response[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param Response[] $responses
     */
    public function setResponses($responses)
    {
        $this->responses = $responses;
    }

    /**
     * @return string[][][]
     */
    public function getSecurity()
    {
        return $this->security;
    }

    /**
     * @param string[][][] $security
     */
    public function setSecurity($security)
    {
        $this->security = $security;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\BasicAuthenticationSecurity[]|\Joli\Jane\Swagger\Model\ApiKeySecurity[]|\Joli\Jane\Swagger\Model\Oauth2ImplicitSecurity[]|\Joli\Jane\Swagger\Model\Oauth2PasswordSecurity[]|\Joli\Jane\Swagger\Model\Oauth2ApplicationSecurity[]|\Joli\Jane\Swagger\Model\Oauth2AccessCodeSecurity[]
     */
    public function getSecurityDefinitions()
    {
        return $this->securityDefinitions;
    }

    /**
     * @param Oauth2AccessCodeSecurity[] $securityDefinitions
     */
    public function setSecurityDefinitions($securityDefinitions)
    {
        $this->securityDefinitions = $securityDefinitions;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return \Joli\Jane\Swagger\Model\ExternalDocs
     */
    public function getExternalDocs()
    {
        return $this->externalDocs;
    }

    /**
     * @param ExternalDocs $externalDocs
     */
    public function setExternalDocs(ExternalDocs $externalDocs)
    {
        $this->externalDocs = $externalDocs;
    }
}
