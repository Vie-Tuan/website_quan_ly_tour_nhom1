<?php
class tour 
{
    private $conn;
    private $id;
    private $tour_id;
    private $customer_name;
    private $customer_email;
    private $customer_phone;
    private $num_people;
    private $booking_date;
    private $status;
    private $notes;

    public function __construct($data = [])
    {
        $this->conn = getDB();
        if (is_array($data)) {
            $this->id = $data['id'] ?? null;
            $this->tour_id = $data['tour_id'] ?? null;
            $this->customer_name = $data['customer_name'] ?? '';
            $this->customer_email = $data['customer_email'] ?? '';
            $this->customer_phone = $data['customer_phone'] ?? '';
            $this->num_people = $data['num_people'] ?? 1;
            $this->booking_date = $data['booking_date'] ?? date('Y-m-d');
            $this->status = $data['status'] ?? 'Cho_xac_nhan';
            $this->notes = $data['notes'] ?? '';
        }
    }
    public function all($tour_id = null)
    {
        if ($tour_id){
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE tour_id = ? ORDER BY booking_data DESC");
        $stmt->execute([$tour_id]);
        } else { 
        $stmt = $this->conn->prepare("SELECT * FROM bookings ORDER BY booking_date DESC");
        $stmt->execute();
}
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO tours (tour_id, customer_name, customer_email, customer_phone, num_people, booking_date, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['tour_id'] ?? null,
            $data['description'] ?? "",
            $data['customer_email'] ?? 0,
            $data['customer_phone'] ?? "",
            $data['num_people'] ?? 0,
            $data['booking_date'] ?? null,
            $data['status'] ?? 'cho_xac_nhan',
            $data['notes'] ?? ''
        ]);
    }
    public function updete($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE bookings SET customer_name=?, customer_email=?, customer_phone=?, num_people=?, booking_date=?, status=? WHERE id=?");
        return $stmt->execute([
            $data['customer_name'] ?? '',
            $data['customer_email'] ?? '',
            $data['customer_phone'] ?? "",
            $data['num_people'] ?? 1,
            $data['booking_date'] ?? date('Y-m-d'),
            $data['status'] ?? 'cho_xac_nhan',
            $data['notes'] ?? ''
            $id
        ]);
    }
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM bookings WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}