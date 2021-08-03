<?php



/**
 * Base
 */
class Base
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name = '0';

    /**
     * @var int
     */
    private $internalId = '0';

    /**
     * @var string
     */
    private $format;

    /**
     * @var string
     */
    private $delimiter = '0';

    /**
     * @var bool|null
     */
    private $isTest;

    /**
     * @var string|null
     */
    private $originalText;

    /**
     * @var \Users
     */
    private $seller;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Base
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set internalId.
     *
     * @param int $internalId
     *
     * @return Base
     */
    public function setInternalId($internalId)
    {
        $this->internalId = $internalId;

        return $this;
    }

    /**
     * Get internalId.
     *
     * @return int
     */
    public function getInternalId()
    {
        return $this->internalId;
    }

    /**
     * Set format.
     *
     * @param string $format
     *
     * @return Base
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format.
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set delimiter.
     *
     * @param string $delimiter
     *
     * @return Base
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    /**
     * Get delimiter.
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * Set isTest.
     *
     * @param bool|null $isTest
     *
     * @return Base
     */
    public function setIsTest($isTest = null)
    {
        $this->isTest = $isTest;

        return $this;
    }

    /**
     * Get isTest.
     *
     * @return bool|null
     */
    public function getIsTest()
    {
        return $this->isTest;
    }

    /**
     * Set originalText.
     *
     * @param string|null $originalText
     *
     * @return Base
     */
    public function setOriginalText($originalText = null)
    {
        $this->originalText = $originalText;

        return $this;
    }

    /**
     * Get originalText.
     *
     * @return string|null
     */
    public function getOriginalText()
    {
        return $this->originalText;
    }

    /**
     * Set seller.
     *
     * @param \Users|null $seller
     *
     * @return Base
     */
    public function setSeller(\Users $seller = null)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get seller.
     *
     * @return \Users|null
     */
    public function getSeller()
    {
        return $this->seller;
    }
}
