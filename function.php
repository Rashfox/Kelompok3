<?php
class CasterNode {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class CasterCircularList {
    private $head = null;

    public function add($data) {
        $newNode = new CasterNode($data);
        if (!$this->head) {
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

    public function rotate() {
        if ($this->head && $this->head->next !== $this->head) {
            $this->head = $this->head->next;
        }
    }
    public function remove($data) {
        if (!$this->head) return false;

        $current = $this->head;
        $prev = null;

        // Single node case
        if ($current->next === $this->head && $current->data === $data) {
            $this->head = null;
            return true;
        }

        do {
            if ($current->data === $data) {
                if ($prev) {
                    $prev->next = $current->next;
                    // If head is being removed, move head
                    if ($current === $this->head) {
                        $this->head = $current->next;
                    }
                } else {
                    // Removing head, find last node to update its next
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

    public function current() {
        return $this->head ? $this->head->data : null;
    }
}

class PanitiaNode {
    public $data;
    public $next;

    public function __construct($data) {
        $this->data = $data;
        $this->next = null;
    }
}

class PanitiaCircularList {
    private $head = null;
    private $tail = null;

    public function add($data) {
        $newNode = new PanitiaNode($data);
        if (!$this->head) {
            $this->head = $newNode;
            $this->tail = $newNode;
            $newNode->next = $this->head;
        } else {
            $this->tail->next = $newNode;
            $this->tail = $newNode;
            $this->tail->next = $this->head;
        }
    }

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

    public function rotate() {
        if ($this->head && $this->head->next !== $this->head) {
            $this->head = $this->head->next;
            $this->tail = $this->tail->next;
        }
    }

    public function autoRotate($times = 1) {
        for ($i = 0; $i < $times; $i++) {
            $this->rotate();
        }
    }

    public function remove($data) {
        if (!$this->head) return false;

        $current = $this->head;
        $prev = $this->tail;

        if ($current->next === $this->head && $current->data === $data) {
            $this->head = null;
            $this->tail = null;
            return true;
        }

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

    public function current() {
        return $this->head ? $this->head->data : null;
    }
}
?>