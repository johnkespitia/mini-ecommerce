<?php



/**
 * Users
 */
class Users
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username = '0';

    /**
     * @var string
     */
    private $password = '';

    /**
     * @var \Rols
     */
    private $rol;


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
     * Set username.
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set rol.
     *
     * @param \Rols|null $rol
     *
     * @return Users
     */
    public function setRol(\Rols $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol.
     *
     * @return \Rols|null
     */
    public function getRol()
    {
        return $this->rol;
    }
}
