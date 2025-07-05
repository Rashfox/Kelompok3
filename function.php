<?php
// Class untuk caster
//Node untuk menyimpan data caster
class CasterNode {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

// Struktur data circular linked list untuk caster
class CasterCircularList {
    private $head = null;

    // Menambah node baru ke list
    public function add($data) {
        $newNode = new CasterNode($data);
        if (!$this->head) {
            // Jika list kosong, buat head menuju ke node baru dan next ke dirinya sendiri
            $this->head = $newNode;
            $newNode->next = $this->head;
        } else {
            $temp = $this->head;
            while ($temp->next !== $this->head) {
                $temp = $temp->next;
            }
            $temp->next = $newNode;
            $newNode->next = $this->head;
        }
    }

    // Mengembalikan array berisi semua data caster
    public function display() {
        $result = [];
        if (!$this->head) return $result; // Jika list kosong
        $temp = $this->head;
        do {
            $result[] = $temp->data; // Tambahkan data ke array
            $temp = $temp->next;
        } while ($temp !== $this->head);
        return $result;
    }

    // Memutar list dengan memanjukan head ke node berikutnya
    public function rotate() {
        if ($this->head && $this->head->next !== $this->head) {
            $this->head = $this->head->next;
        }
    }

    // Menghapus node berdasarkan data
    public function remove($data) {
        if (!$this->head) return false;

        $current = $this->head;
        $prev = null;

        // Kasus hanya 1 node
        if ($current->next === $this->head && $current->data === $data) {
            $this->head = null;
            return true;
        }

        // Loop untuk mencari node yang akan dihapus
        do {
            if ($current->data === $data) {
                if ($prev) {
                    $prev->next = $current->next;
                    // Jika yang dihapus adalah head
                    if ($current === $this->head) {
                        $this->head = $current->next; 
                    }
                } else {
                    // Menghapus head maka cari node terakhir untuk memperbaharui
                    $last = $this->head;
                    while ($last->next !== $this->head) {
                        $last = $last->next;
                    }
                    $this->head = $current->next;
                    $last->next = $this->head;
                }
                return true;
            }
            $prev = $current;
            $current = $current->next;
        } while ($current !== $this->head);

        return false;
    }

    // Mengambil data caster yang saat ini di posisi head
    public function current() {
        return $this->head ? $this->head->data : null;
    }
}

// Class untuk panitia
// Node untuk menyimpan data panitia 
class PanitiaNode {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

// Struktur data circular linked list untuk panitia
class PanitiaCircularList {
    private $head = null;
    private $tail = null;

    // Menambahkan node baru ke list
    public function add($data) {
        $newNode = new PanitiaNode($data);
        if (!$this->head) {
            // Jika list kosong
            $this->head = $newNode;
            $this->tail = $newNode;
            $newNode->next = $this->head;
        } else {
            // Jika list tidak kosong, tambah ke akhir
            $this->tail->next = $newNode;
            $this->tail = $newNode;
            $this->tail->next = $this->head;
        }
    }

     // Mengembalikan seluruh data panitia dalam bentuk array
    public function display() {
        $result = [];
        if (!$this->head) return $result;
        $temp = $this->head;
        do {
            $result[] = $temp->data;
            $temp = $temp->next;
        } while ($temp !== $this->head);
        return $result;
    }

    // Memutar urutan panitia (head dan tail maju satu node)
    public function rotate() {
        if ($this->head && $this->head->next !== $this->head) {
            $this->head = $this->head->next;
            $this->tail = $this->tail->next;
        }
    }

    // Rotasi otomatis beberapa kali
    public function autoRotate($times = 1) {
        for ($i = 0; $i < $times; $i++) {
            $this->rotate();
        }
    }

    // Menghapus panitia berdasarkan data
    public function remove($data) {
        if (!$this->head) return false;

        $current = $this->head;
        $prev = $this->tail;

        // Kasus hanya 1 node
        if ($current->next === $this->head && $current->data === $data) {
            $this->head = null;
            $this->tail = null;
            return true;
        }

        // Loop untuk mencari node yang akan dihapus
        do {
            if ($current->data === $data) {
                if ($current === $this->head) {
                    $this->head = $current->next;
                    $this->tail->next = $this->head;
                } elseif ($current === $this->tail) {
                    $this->tail = $prev;
                    $this->tail->next = $this->head;
                } else {
                    $prev->next = $current->next;
                }
                return true;
            }
            $prev = $current;
            $current = $current->next;
        } while ($current !== $this->head);

        return false;
    }

    // Mengambil data panitia yang saat ini di posisi head
    public function current() {
        return $this->head ? $this->head->data : null;
    }
}
?>