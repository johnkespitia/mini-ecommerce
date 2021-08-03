<?php



/**
 * Statistics
 */
class Statistics
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $validpercent = '0.000000';

    /**
     * @var int
     */
    private $refund = '0';

    /**
     * @var int
     */
    private $refundCheck = '0';

    /**
     * @var int
     */
    private $profit = '0';

    /**
     * @var int
     */
    private $payout = '0';

    /**
     * @var int
     */
    private $credit = '0';

    /**
     * @var int
     */
    private $balance = '0';

    /**
     * @var int
     */
    private $paypercent = '0';

    /**
     * @var int
     */
    private $loaded = '0';

    /**
     * @var int
     */
    private $turnover = '0';

    /**
     * @var int
     */
    private $incorrect = '0';

    /**
     * @var int
     */
    private $invalid = '0';

    /**
     * @var int
     */
    private $sold = '0';

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var \DateTime|null
     */
    private $date;

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
     * Set validpercent.
     *
     * @param string $validpercent
     *
     * @return Statistics
     */
    public function setValidpercent($validpercent)
    {
        $this->validpercent = $validpercent;

        return $this;
    }

    /**
     * Get validpercent.
     *
     * @return string
     */
    public function getValidpercent()
    {
        return $this->validpercent;
    }

    /**
     * Set refund.
     *
     * @param int $refund
     *
     * @return Statistics
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;

        return $this;
    }

    /**
     * Get refund.
     *
     * @return int
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * Set refundCheck.
     *
     * @param int $refundCheck
     *
     * @return Statistics
     */
    public function setRefundCheck($refundCheck)
    {
        $this->refundCheck = $refundCheck;

        return $this;
    }

    /**
     * Get refundCheck.
     *
     * @return int
     */
    public function getRefundCheck()
    {
        return $this->refundCheck;
    }

    /**
     * Set profit.
     *
     * @param int $profit
     *
     * @return Statistics
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * Get profit.
     *
     * @return int
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Set payout.
     *
     * @param int $payout
     *
     * @return Statistics
     */
    public function setPayout($payout)
    {
        $this->payout = $payout;

        return $this;
    }

    /**
     * Get payout.
     *
     * @return int
     */
    public function getPayout()
    {
        return $this->payout;
    }

    /**
     * Set credit.
     *
     * @param int $credit
     *
     * @return Statistics
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get credit.
     *
     * @return int
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set balance.
     *
     * @param int $balance
     *
     * @return Statistics
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance.
     *
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set paypercent.
     *
     * @param int $paypercent
     *
     * @return Statistics
     */
    public function setPaypercent($paypercent)
    {
        $this->paypercent = $paypercent;

        return $this;
    }

    /**
     * Get paypercent.
     *
     * @return int
     */
    public function getPaypercent()
    {
        return $this->paypercent;
    }

    /**
     * Set loaded.
     *
     * @param int $loaded
     *
     * @return Statistics
     */
    public function setLoaded($loaded)
    {
        $this->loaded = $loaded;

        return $this;
    }

    /**
     * Get loaded.
     *
     * @return int
     */
    public function getLoaded()
    {
        return $this->loaded;
    }

    /**
     * Set turnover.
     *
     * @param int $turnover
     *
     * @return Statistics
     */
    public function setTurnover($turnover)
    {
        $this->turnover = $turnover;

        return $this;
    }

    /**
     * Get turnover.
     *
     * @return int
     */
    public function getTurnover()
    {
        return $this->turnover;
    }

    /**
     * Set incorrect.
     *
     * @param int $incorrect
     *
     * @return Statistics
     */
    public function setIncorrect($incorrect)
    {
        $this->incorrect = $incorrect;

        return $this;
    }

    /**
     * Get incorrect.
     *
     * @return int
     */
    public function getIncorrect()
    {
        return $this->incorrect;
    }

    /**
     * Set invalid.
     *
     * @param int $invalid
     *
     * @return Statistics
     */
    public function setInvalid($invalid)
    {
        $this->invalid = $invalid;

        return $this;
    }

    /**
     * Get invalid.
     *
     * @return int
     */
    public function getInvalid()
    {
        return $this->invalid;
    }

    /**
     * Set sold.
     *
     * @param int $sold
     *
     * @return Statistics
     */
    public function setSold($sold)
    {
        $this->sold = $sold;

        return $this;
    }

    /**
     * Get sold.
     *
     * @return int
     */
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Statistics
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date.
     *
     * @param \DateTime|null $date
     *
     * @return Statistics
     */
    public function setDate($date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user.
     *
     * @param \Users|null $user
     *
     * @return Statistics
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
