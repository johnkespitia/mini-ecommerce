<?php



/**
 * Payments
 */
class Payments
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $intrenalId;

    /**
     * @var int
     */
    private $amount = '0';

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $fee = '0.000000';

    /**
     * @var string
     */
    private $btcAddress = '0';

    /**
     * @var \Users
     */
    private $user;


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
     * Set intrenalId.
     *
     * @param string $intrenalId
     *
     * @return Payments
     */
    public function setIntrenalId($intrenalId)
    {
        $this->intrenalId = $intrenalId;

        return $this;
    }

    /**
     * Get intrenalId.
     *
     * @return string
     */
    public function getIntrenalId()
    {
        return $this->intrenalId;
    }

    /**
     * Set amount.
     *
     * @param int $amount
     *
     * @return Payments
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Payments
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set fee.
     *
     * @param string $fee
     *
     * @return Payments
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

        return $this;
    }

    /**
     * Get fee.
     *
     * @return string
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set btcAddress.
     *
     * @param string $btcAddress
     *
     * @return Payments
     */
    public function setBtcAddress($btcAddress)
    {
        $this->btcAddress = $btcAddress;

        return $this;
    }

    /**
     * Get btcAddress.
     *
     * @return string
     */
    public function getBtcAddress()
    {
        return $this->btcAddress;
    }

    /**
     * Set user.
     *
     * @param \Users|null $user
     *
     * @return Payments
     */
    public function setUser(\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Users|null
     */
    public function getUser()
    {
        return $this->user;
    }
}
