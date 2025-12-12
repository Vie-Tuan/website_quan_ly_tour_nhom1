<?php
class tour 
{
    private $conn;
    private $id;
    private $name;
    private $description;
    private $price;
    private $location;
    private $num_reviews;
    private $departure_date;
    private $status;

    public function __construct()
    {
        $this->conn = getDB();
        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? "";
            $this->description = $data['description'] ?? "";
            $this->price = $data['price'] ?? 0;
            $this->location = $data['location'] ?? "";
            $this->num_reviews = $data['num_reviews'] ?? 0;
            $this->departure_date = $data['departure_date'] ?? null;
            $this->status = $data['status'] ?? 1;
        }
    }
    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM tours ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tours WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO tours (name, description, price, location, num_reviews, departure_date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'] ?? "",
            $data['description'] ?? "",
            $data['price'] ?? 0,
            $data['location'] ?? "",
            $data['num_reviews'] ?? 0,
            $data['departure_date'] ?? null,
            $data['status'] ?? 1
        ]);
    }
    public function updete($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE tours SET name=?, description=?, price=?, location=?, num_reviews=?, departure_date=?, status=? WHERE id=?");
        return $stmt->execute([
            $data['name'] ?? "",
            $data['description'] ?? "",
            $data['price'] ?? 0,
            $data['location'] ?? "",
            $data['num_reviews'] ?? 0,
            $data['departure_date'] ?? null,
            $data['status'] ?? 1,
        ]);
    }
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM tours WHERE id = ?");
        return $stmt->execute([$id]);
    }
}