<?php

// CLASSE SHOP
class Shop
{
  protected $name;

  protected $website;

  protected $registeredOffice;

  public function __construct(string $name, string $website, string $registeredOffice) {
    $this->name = $name;
    $this->website = $website;
    $this->registeredOffice = $registeredOffice;
  }

  public function getName() {
    return $this->name;
  }

  public function getWebsite() {
    return $this->website;
  }

  public function getOffice() {
    return $this->registeredOffice;
  }
}

// CLASSE UTENTE
class User
{
  private $id;

  protected $name;

  protected $surname;

  protected $birth;

  protected $email;

  protected $deliveryDays = 7;

  protected $cards = [];

  protected $purchasedProducts = [];

  public function __construct(int $id, string $name, string $surname, string $birth, string $email) {
    $this->id = $id;
    $this->name = $name;
    $this->surname = $surname;
    $this->birth = $birth;
    $this->email = $email;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getSurname() {
    return $this->surname;
  }

  public function getBirth() {
    return $this->birth;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getCards() {
    return $this->cards;
  }

  public function getPurchasedProducts() {
    return $this->purchasedProducts;
  }

  public function addCard($card) {
    if ($card instanceof CreditCard) {
      $this->cards[] = $card;
    } else {
      throw new Exception('Invalid card inserted.<br>');
    }
  }

  public function buyProduct($product) {
    if ($product instanceof Product) {
      $this->purchasedProducts[] = $product;
    } else {
      throw new Exception('Entered product is not valid.<br>');
    }
  }

  public function setEmail($email) {
    $this->email = $email;
  }
}

// CLASSE UTENTE PREMIUM
class PremiumUser extends User
{
  protected $deliveryDays = 3;

  protected $monthlySubscription;

  public function setSubscription($subscriptionPrice) {
    $this->monthlySubscription = $subscriptionPrice;
  }

  public function getMonthlySubscription() {
    return $this->monthlySubscription;
  }
}

// CLASSE CARTA DI CREDITO
class CreditCard
{
  protected $cardNumber;

  protected $holder;

  protected $securityCode;

  protected $expirationDate;

  public function __construct(int $cardNumber, string $holder, int $securityCode, string $expirationDate) {
    $this->cardNumber = $cardNumber;
    $this->holder = $holder;
    $this->securityCode = $securityCode;
    $this->expirationDate = $expirationDate;
  }

  public function getCardNumber() {
    return $this->cardNumber;
  }

  public function getHolder() {
    return $this->holder;
  }

  public function getSecurityCode() {
    return $this->securityCode;
  }

  public function getExpirationDate() {
    return $this->expirationDate;
  }
}

// CLASSE PRODOTTO
class Product
{
  private $id;

  protected $title;

  protected $author;

  protected $price;

  public function __construct(int $id, string $title, string $author, float $price) {
    $this->id = $id;
    $this->title = $title;
    $this->author = $author;
    $this->price = $price;
  }

  public function getId() {
    return $this->id;
  }

  public function getTitle() {
    return $this->title;
  }
  public function getAuthor() {
    return $this->author;
  }

  public function getPrice() {
    return $this->price;
  }
}

// CLASSE LIBRO ESTESA A PRODOTTO
class Book extends Product
{
  protected $pagesNum;

  public function setPagesNum($num) {
    $this->pagesNum = $num;
  }

  public function getPagesNum() {
    return $this->pagesNum;
  }
}

// STAMPA A SCHERMO

// SEZIONE SHOP
$shop = new Shop('Saldi24', 'www.saldi24.com', 'C.so Galileo Ferraris 33, Torino');

echo "<b>Object Shop: </b>";
echo "<br><br>";

var_dump($shop);

echo "<br><br>";
echo '<em>Company: </em> ' . $shop->getName() . '<br>';
echo '<em>WebSite: </em> ' . $shop->getWebsite() . '<br>';
echo '<em>RegisteredOffice: </em> ' . $shop->getOffice();

echo "<br><br>";

// SEZIONE UTENTE
$user = new User(2, 'Davide', 'Bibbò', '25/11/1993', 'bibbodavide@gmail.com');

echo "<b>Object User: </b>";
echo "<br><br>";

var_dump($user);

echo "<br><br>";

echo '<em>Name: </em> ' . $user->getName() . '<br>';
echo '<em>Surname: </em> ' . $user->getSurname() . '<br>';
echo '<em>BirthDate: </em> ' . $user->getBirth() . '<br>';
echo '<em>Email: </em> ' . $user->getEmail() . '<br>';

echo "<br>";

// SEZIONE LIBRO
$book= new Book(10, 'L\'Ombra Del Vento', 'Carlos Ruiz Zafón', 10.50);
$book->setPagesNum(420);

echo "<b>Object Book: </b>";
echo "<br><br>";

var_dump($book);

echo "<br><br>";

echo '<em>Author: </em> ' . $book->getAuthor() . '<br>';
echo '<em>Title: </em> ' . $book->getTitle() . '<br>';
echo '<em>Price: </em> ' . $book->getPrice() . '<br>';
echo '<em>Pages: </em> ' . $book->getPagesNum();

echo "<br><br>";

// SEZIONE CARTA DI CREDITO
$userCard = new CreditCard(53331710, 'Davide Bibbò', 811, '11/02/2025');

echo "<b>Object Credit Card: </b>";
echo "<br><br>";

var_dump($userCard);

echo "<br><br>";

echo '<em>CardNumber: </em> ' . $userCard->getCardNumber() . '<br>';
echo '<em>Holder: </em> ' . $userCard->getHolder() . '<br>';
echo '<em>ExpirationDate: </em> ' . $userCard->getExpirationDate();

echo "<br><br>";

// SEZIONE AGGIUNTA CARTA DI CREDITO E ACQUISTO LIBRO

// gestione eccezione (Bonus)
try {
  $user->addCard($userCard);
} catch (Exception $e) {
  echo $e->getMessage();
}

try {
  $user->buyProduct($book);
} catch (Exception $e) {
  echo $e->getMessage();
}

echo "<br>";

// DATI CON ACQUISTO LIBRO

echo "<b>After purchase : </b>";
echo "<br><br>";

echo '<em>Name: </em> ' . $user->getName() . '<br>';
echo '<em>Surname: </em> ' . $user->getSurname() . '<br>';
echo '<em>BirthDate: </em> ' . $user->getBirth() . '<br>';
echo '<em>Email: </em> ' . $user->getEmail() . '<br>';

if (count($user->getPurchasedProducts()) > 0) {
  echo '<br>';
  echo '<em>Purchased products:  </em> ';
  echo '<br>';
  print_r($user->getPurchasedProducts());
  echo '<br>';
} else {
  echo '<br>';
  echo 'No purchase. <br>';
}
if (count($user->getCards()) > 0) {
  echo '<br>';
  echo '<em>Card: </em> ';
  echo '<br>';
  print_r($user->getCards());
} else {
  echo '<br>';
  echo 'No credit card.';
}
