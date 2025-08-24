<?php
class BankAccount {
    private $accountNumber;
    private $accountHolderName;
    private $balance;
    private $accountType;
    private $transactionHistory;

    public function __construct($accountNumber, $accountHolderName, $initialBalance, $accountType) {
        $this->accountNumber = $accountNumber;
        $this->accountHolderName = $accountHolderName;
        $this->balance = $initialBalance;
        $this->accountType = $accountType;
        $this->transactionHistory = [];
        echo "Account Created: {$this->accountNumber} - {$this->accountHolderName}\n<br>";
        echo "Initial Balance: \${$this->balance}\n<br>";
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            echo "Deposit of \${$amount} failed. Invalid amount.\n<br>";
            $this->addTransaction("Deposit", $amount, false);
            return false;
        }
        $this->balance += $amount;
        echo "Deposit of \${$amount} successful. New balance: \${$this->balance}\n<br>";
        $this->addTransaction("Deposit", $amount, true);
        return true;
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            echo "Withdrawal of \${$amount} failed. Invalid amount.\n<br>";
            $this->addTransaction("Withdrawal", $amount, false);
            return false;
        }
        if ($amount > $this->balance) {
            echo "Withdrawal of \${$amount} failed. Insufficient funds.\n<br>";
            $this->addTransaction("Withdrawal", $amount, false);
            return false;
        }
        $this->balance -= $amount;
        echo "Withdrawal of \${$amount} successful. New balance: \${$this->balance}\n<br>";
        $this->addTransaction("Withdrawal", $amount, true);
        return true;
    }

    public function checkBalance() {
        echo "Current Balance: \${$this->balance}\n";
        return $this->balance;
    }

    public function getAccountInfo() {
        echo "\n=== Account Information ===\n<br>";
        echo "Account Number: {$this->accountNumber}\n<br>";
        echo "Account Holder: {$this->accountHolderName}\n<br>";
        echo "Account Type: {$this->accountType}\n<br>";
        echo "Current Balance: \${$this->balance}\n<br>";
    }

    public function getTransactionHistory() {
        echo "\n=== Transaction History ===\n<br>";
        $i = 1;
        foreach ($this->transactionHistory as $tx) {
            $status = $tx['success'] ? "" : " (Failed)";
            echo "{$i}. {$tx['type']}: {$tx['amount']} (Balance: {$tx['balance_after']}){$status}\n<br>";
            $i++;
        }
    }

    private function addTransaction($type, $amount, $success) {
        $this->transactionHistory[] = [
            "type" => $type,
            "amount" => $amount,
            "balance_after" => $this->balance,
            "success" => $success
        ];
    }
}


echo "=== Personal Banking System ===\n<br>";

$account1 = new BankAccount("ACC001", "Alice Johnson", 1500.75, "Savings");
$account2 = new BankAccount("ACC002", "Bob Wilson", 800.00, "Checking");


$account1->deposit(200.50);
$account1->withdraw(100.00);
$account1->withdraw(3000.00);

$account1->getAccountInfo();
$account1->getTransactionHistory();

echo "\n-----------------------------\n<br>";

$account2->deposit(150.00);
$account2->withdraw(50.00);
$account2->deposit(-20.00); 

$account2->getAccountInfo();
$account2->getTransactionHistory();

?>
