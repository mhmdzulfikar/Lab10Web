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
Class & Object: Digunakan untuk merepresentasikan entitas mobil. Encapsulation: Atribut seperti warna, merek, dan harga dibuat privat agar tidak dapat diakses langsung. Constructor: Berfungsi untuk memberikan nilai awal secara otomatis saat objek dibuat. Method: Digunakan untuk memodifikasi dan menampilkan data.


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
tidak muncul file apapun karena filenya belum terisi
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
Kode tersebut merupakan implementasi dari class Form yang berfungsi untuk membuat formulir input sederhana. Program ini menggunakan class Form yang telah didefinisikan sebelumnya dalam file form.php.
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
File database masih kosong karena belum ada data di dalamnya, sehingga perlu membuat tabel terlebih dahulu, serta menyiapkan file config.php dan test.php.

---

### Database Table:
```sql
CREATE TABLE mahasiswa (
    nim VARCHAR(20) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    alamat TEXT
);
```
Setelah membuat tabel users di database latihan1, langkah selanjutnya adalah membuka VSCode dan membuat file baru dengan nama config.php.


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
berfungsi untuk menyimpan informasi konfigurasi koneksi database.
---

### File: `test.php
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
        return $this->conn->query($sql);
    }

    public function get($table, $where = null) {
        $condition = $where ? " WHERE " . $where : "";
        $sql = "SELECT * FROM " . $table . $condition;
        $result = $this->conn->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    public function insert($table, $data) {
        if (is_array($data)) {
            $columns = implode(",", array_keys($data));
            $values = implode(",", array_map(fn($val) => "'{$val}'", $data));
        }

        $sql = "INSERT INTO " . $table . " (" . $columns . ") VALUES (" . $values . ")";
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    public function update($table, $data, $where) {
        if (is_array($data)) {
            $update_values = implode(",", array_map(fn($key, $val) => "$key='{$val}'", array_keys($data), $data));
        }

        $sql = "UPDATE " . $table . " SET " . $update_values . " WHERE " . $where;
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }

    public function delete($table, $filter) {
        $sql = "DELETE FROM " . $table . " " . $filter;
        $result = $this->conn->query($sql);
        return $result ? true : false;
    }
}
?>

```
---
file database masih kosong karena belum terisi, maka membuat dulu tablenya dan config.php dan test.php

---
