<?php
declare(strict_types=1);

namespace Stk2k\PhitFlyer\Object;


class MeBankAccount
{
    /** @var integer  */
    private $id;
    
    /** @var boolean  */
    private $is_verified;
    
    /** @var string  */
    private $bank_name;
    
    /** @var string  */
    private $branch_name;
    
    /** @var string  */
    private $account_type;
    
    /** @var string  */
    private $account_number;
    
    /** @var string  */
    private $account_name;
    
    /**
     * construct
     *
     * @param int $id
     * @param bool $is_verified
     * @param string $bank_name
     * @param string $branch_name
     * @param string $account_type
     * @param string $account_number
     * @param string $account_name
     */
    public function __construct(int $id, bool $is_verified, string $bank_name, string $branch_name, string $account_type,
                                string $account_number, string $account_name){
        $this->id = $id;
        $this->is_verified = $is_verified;
        $this->bank_name = $bank_name;
        $this->branch_name = $branch_name;
        $this->account_type = $account_type;
        $this->account_number = $account_number;
        $this->account_name = $account_name;
    }
    
    /**
     * construct from stdObject
     *
     * @param array $data
     *
     * @return MeBankAccount
     */
    public static function fromArray(array $data) : MeBankAccount
    {
        return new self(
            $data['id'] ?? null,
            $data['is_verified'] ?? null,
            $data['bank_name'] ?? null,
            $data['branch_name'] ?? null,
            $data['account_type'] ?? null,
            $data['account_number'] ?? null,
            $data['account_name'] ?? null
        );
    }
    
    /**
     * get id
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }
    
    /**
     * is verified
     *
     * @return bool
     */
    public function getIsVerified() : bool
    {
        return $this->is_verified;
    }
    
    /**
     * get bank name
     *
     * @return string
     * @noinspection PhpUnused
     */
    public function getBankName() : string
    {
        return $this->bank_name;
    }
    
    /**
     * get branch name
     *
     * @return string
     * @noinspection PhpUnused
     */
    public function getBranchName() : string
    {
        return $this->branch_name;
    }
    
    /**
     * get account type
     *
     * @return string
     */
    public function getAccountType() : string
    {
        return $this->account_type;
    }
    
    /**
     * get account number
     *
     * @return string
     */
    public function getAccountNumber() : string
    {
        return $this->account_number;
    }
    
    /**
     * get account name
     *
     * @return string
     */
    public function getAccountName() : string
    {
        return $this->account_name;
    }
    
}