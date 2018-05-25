<?php


class QueryBuilder
 {

  protected $pdo;

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function getCredentials($table)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table}");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
  }

  public function requestOrders($table)
  {
  //  $statement = $this->pdo->prepare("INSERT INTO 'amazon_orders' (amazonorderid, purchasedate, orderstatus, fulfillmentchannel, saleschannel, buyeremail, buyername, ordertype, latestshipdate, isbusinessorder, isprime, ispremiumorder) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement = $this->pdo->prepare("INSERT INTO {$table} (amazonorderid) VALUES (?)");
    $statement->execute(array("test", "test2"));
  }

 public function selectAll($table)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table}");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
  }

  public function selectOrderDetails($table, $amazonorderid)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE amazonorderid = '{$amazonorderid}'");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
  }

  public function selectAllUnshippedDesc($table)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE orderstatus = 'Unshipped' ORDER BY purchasedate DESC");
    $statement->execute();
    $count = $statement->rowCount();
    return $statement->fetchAll(PDO::FETCH_CLASS);
  }

  public function selectAllPendingDesc($table)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE orderstatus = 'Pending' ORDER BY purchasedate DESC");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
  }

  public function selectAllShippedDesc($table)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE orderstatus = 'Shipped' ORDER BY purchasedate DESC");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
  }

  public function selectAllCanceledDesc($table)
  {
    $statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE orderstatus = 'Canceled' ORDER BY purchasedate DESC");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
  }

}
