<?php
declare(strict_types=1);

namespace Patterns\behavioral;

require_once '../../../vendor/autoload.php';

// Metoda szablonowa to behawioralny wzorzec projektowy według którego
// definiuje się szkielet algorytmu w klasie bazowej i
// pozwala klasom pochodnym nadpisać poszczególne jego etapy bez zmiany ogólnej struktury.


// Kiedy stosowac :
// 1.  Stosuj wzorzec Metoda szablonowa gdy chcesz pozwolić klientom na rozszerzanie niektórych tylko etapów algorytmu,
// ale nie całego, ani też jego struktury.
// 2. Wzorzec ten jest przydatny gdy masz wiele klas zawierających niemal identyczne algorytmy różniące się jedynie szczegółami.
//  W takiej sytuacji bowiem konieczność modyfikacji algorytmu skutkuje koniecznością modyfikacji wszystkich klas.
// 3.

// Zalety:
// 1. Można pozwolić klientom nadpisać tylko niektóre partie dużego algorytmu czyniąc go odporniejszym na szkody wskutek
// zmian poszczególnych jego części.
// 2. Można przenieść powtarzający się kod do klasy bazowej.

// Wady:
// 1. Dla niektórych klientów przygotowany szkielet algorytmu może stanowić ograniczenie.
// 2. Może prowadzić do naruszenia Zasady podstawienia Liskov wskutek stłumienia domyślnych implementacji etapów w podklasach.
// 3. Metody szablonowe zwykle trudniej utrzymywać w miarę jak przybywa etapów.


abstract class SocialNetwork
{
    protected string $userName;
    protected string $password;

    public function __construct(string $userName, string $password)
    {
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * The actual template method calls abstract steps in a specific order. A
     * subclass may implement all of the steps, allowing this method to actually
     * post something to a social network.
     */
    final public function post(string $message): bool
    {
        $result = false;
        if ($this->logIn($this->userName, $this->password)) {
            $result = $this->sendData($message);
            echo '[data were sended]' . PHP_EOL;
            $this->logOut();
        }

        return $result;
    }

    abstract public function logIn(string $userName, string $password): bool;

    abstract public function sendData(string $message): bool;

    abstract public function logOut(): void;
}

class Facebook extends SocialNetwork
{
    public function logIn(string $userName, string $password): bool
    {
        echo "Checking user's credentials..." . PHP_EOL;
        echo "Name: " . $this->userName . PHP_EOL;
        echo "Password: " . str_repeat("*", strlen($this->password)) . PHP_EOL;

        echo "Facebook: '" . $this->userName . "' has logged in successfully." . PHP_EOL;

        return true;
    }

    public function sendData(string $message): bool
    {
        echo 'Facebook : ' . $this->userName . ' has posted ' . $message . PHP_EOL;

        return true;
    }

    public function logOut(): void
    {
        echo 'Facebook : ' . $this->userName . ' has logged out ' . PHP_EOL;
    }
}

class Twitter extends SocialNetwork
{
    public function logIn(string $userName, string $password): bool
    {
        echo "Checking user's credentials..." . PHP_EOL;
        echo "Name: " . $this->userName . PHP_EOL;
        echo "Password: " . str_repeat("*", strlen($this->password)) . PHP_EOL;

        echo "Twitter: '" . $this->userName . "' has logged in successfully." . PHP_EOL;

        return true;
    }

    public function sendData(string $message): bool
    {
        echo 'Twitter : ' . $this->userName . ' has posted ' . $message . PHP_EOL;

        return true;
    }

    public function logOut(): void
    {
        echo 'Twitter : ' . $this->userName . ' has logged out ' . PHP_EOL;
    }
}

class DataPoster
{
    private string $username;
    private string $password;

    public function doDataPosting(): void
    {
        echo 'Username : ' . PHP_EOL;
        $this->username = readline();
        echo 'Password : ' . PHP_EOL;
        $this->password = readline();

        echo "Choose the social network to post the message:" . PHP_EOL .
            "1 - Facebook" . PHP_EOL .
            "2 - Twitter" . PHP_EOL;
        $choice = (string)readline('Enter your choice : ');

        // Now, let's create a proper social network object and send the message.

        if ($choice === "1") {
            $network = new Facebook($this->username, $this->password);
        } elseif ($choice === "2") {
            $network = new Twitter($this->username, $this->password);
        } else {
            die("Sorry, I'm not sure what you mean by that.\n");
        }
        echo 'Write your message: ' . PHP_EOL;
        $message = readline();
        $network->post($message);
    }

}


$dataPoster = new DataPoster();
$dataPoster->doDataPosting();

