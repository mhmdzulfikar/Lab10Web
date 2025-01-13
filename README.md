<h2>Lebweb10</h2>

![image](https://github.com/user-attachments/assets/18e8130e-37b9-4ce0-a480-443db44db8fa)

---

![image](https://github.com/user-attachments/assets/77a79808-6336-4b6a-89b7-3b4b256814ed)

---

![image](https://github.com/user-attachments/assets/8c983cd8-26e9-40c2-a8eb-48e2f687ec25)


---

### File: `mobil.php`
```php
<?php
/**
 * Program sederhana pendefinisian class dan pemanggilan class.
 */
class Mobil {
    private $warna;
    private $merk;
    private $harga;

    public function __construct() {
        $this->warna = "Biru";
        $this->merk = "BMW";
        $this->harga = "10000000";
    }

    public function gantiWarna($warnaBaru) {
        $this->warna = $warnaBaru;
    }

    public function tampilWarna() {
        echo "Warna mobilnya: " . $this->warna;
    }
}

// Membuat objek mobil
$a = new Mobil();
$b = new Mobil();

// Memanggil objek
echo "<b>Mobil pertama</b><br>";
$a->tampilWarna();
echo "<br>Mobil pertama ganti warna<br>";
$a->gantiWarna("Merah");
$a->tampilWarna();

// Memanggil objek
echo "<br><b>Mobil kedua</b><br>";
$b->gantiWarna("Hijau");
$b->tampilWarna();
?>
```

---

### File: `form.php`
```php
<?php
/**
 * Nama Class: Form
 * Deskripsi: Class untuk membuat form inputan text sederhana.
 */
class Form {
    private $fields = array();
    private $action;
    private $submit = "Submit Form";
    private $jumField = 0;

    public function __construct($action, $submit) {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function displayForm() {
        echo "<form action='" . $this->action . "' method='POST'>";
        echo '<table width="100%" border="0">';
        foreach ($this->fields as $field) {
            echo "<tr><td align='right'>" . $field['label'] . "</td>";
            echo "<td><input type='text' name='" . $field['name'] . "'></td></tr>";
        }
        echo "<tr><td colspan='2'>";
        echo "<input type='submit' value='" . $this->submit . "'></td></tr>";
        echo "</table>";
        echo "</form>";
    }

    public function addField($name, $label) {
        $this->fields[] = ['name' => $name, 'label' => $label];
    }
}
?>
```

---

### File: `form_input.php`
```php
<?php
/**
 * Program memanfaatkan class Form untuk membuat form input sederhana.
 */
include "form.php";

echo "<html><head><title>Mahasiswa</title></head><body>";
$form = new Form("", "Input Form");
$form->addField("txtnim", "NIM");
$form->addField("txtnama", "Nama");
$form->addField("txtalamat", "Alamat");
echo "<h3>Silahkan isi form berikut ini:</h3>";
$form->displayForm();
echo "</body></html>";
?>
```

---

### File: `database.php`
```php
<?php
class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() {
        $this->getConfig();
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function getConfig() {
        include_once("config.php");
        global $config;
        $this->host = $config['host'];
        $this->user = $config['username'];
        $this->password = $config['password'];
        $this->db_name = $config['db_name'];
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if ($result === false) {
            die("SQL Error: " . $this->conn->error);
        }
        return $result;
    }

    public function get($table, $where = null) {
        $condition = $where ? " WHERE $where" : "";
        $sql = "SELECT * FROM $table$condition";
        return $this->query($sql)->fetch_assoc();
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = implode(", ", array_map(fn($val) => "'{$this->conn->real_escape_string($val)}'", $data));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->query($sql);
    }

    public function update($table, $data, $where) {
        $updates = implode(", ", array_map(fn($key, $val) => "$key='{$this->conn->real_escape_string($val)}'", array_keys($data), $data));
        $sql = "UPDATE $table SET $updates WHERE $where";
        return $this->query($sql);
    }

    public function delete($table, $filter) {
        $sql = "DELETE FROM $table WHERE $filter";
        return $this->query($sql);
    }
}
?>
```

---

### Database Table:
```sql
CREATE TABLE mahasiswa (
    nim VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT
);
```

---

### File: `config.php`
```php
<?php
$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db_name' => 'latihan'
];
?>
```

---

### File: `test.php
```php
<?php
include "database.php";

$db = new Database();

// Test insert
$data = ['nim' => '12345', 'nama' => 'John Doe', 'alamat' => 'Jl. Merdeka'];
$db->insert('mahasiswa', $data);

// Test select
$result = $db->get('mahasiswa', "nim='12345'");
print_r($result);
?>
```
