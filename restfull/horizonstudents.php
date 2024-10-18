<?php
header("Content-Type: application/json; charset=UTF-8");
include_once 'config.php';

class HorizonStudents {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function read() {
        $query = "SELECT * FROM horizonstudents";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data) {
        $query = "INSERT INTO horizonstudents (index_no, first_name, last_name, city, district, province, email_address, mobile_number) VALUES (:index_no, :first_name, :last_name, :city, :district, :province, :email_address, :mobile_number)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':index_no', $data->index_no);
        $stmt->bindParam(':first_name', $data->first_name);
        $stmt->bindParam(':last_name', $data->last_name);
        $stmt->bindParam(':city', $data->city);
        $stmt->bindParam(':district', $data->district);
        $stmt->bindParam(':province', $data->province);
        $stmt->bindParam(':email_address', $data->email_address);
        $stmt->bindParam(':mobile_number', $data->mobile_number);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE horizonstudents SET index_no = :index_no, first_name = :first_name, last_name = :last_name, city = :city, district = :district, province = :province, email_address = :email_address, mobile_number = :mobile_number WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':index_no', $data->index_no);
        $stmt->bindParam(':first_name', $data->first_name);
        $stmt->bindParam(':last_name', $data->last_name);
        $stmt->bindParam(':city', $data->city);
        $stmt->bindParam(':district', $data->district);
        $stmt->bindParam(':province', $data->province);
        $stmt->bindParam(':email_address', $data->email_address);
        $stmt->bindParam(':mobile_number', $data->mobile_number);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM horizonstudents WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

// Create an instance of the HorizonStudents class
$students = new HorizonStudents();

// Determine the request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle different request methods
switch ($method) {
    case 'GET':
        $stmt = $students->read();
        $studentsArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($studentsArray);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        if ($students->create($data)) {
            echo json_encode(["message" => "Student added successfully."]);
        } else {
            echo json_encode(["message" => "Unable to add student."]);
        }
        break;

    case 'PUT':
            // Get the ID from the input data
        $data = json_decode(file_get_contents("php://input"));
            
            // Ensure that the ID is present in the body data
        if (!isset($data->id)) {
            echo json_encode(["message" => "ID is required for updating."]);
            break;
        }
        
            // Call the update function
        if ($students->update($data->id, $data)) {
            echo json_encode(["message" => "Student updated successfully."]);
        } else {
            echo json_encode(["message" => "Unable to update student."]);
        }
            break;
        

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($students->delete($id)) {
               echo json_encode(["message" => "Student deleted successfully."]);
            } else {
               echo json_encode(["message" => "Unable to delete student."]);
            }
        } else {
            echo json_encode(["message" => "ID is required for deletion."]);
        }
        break;
            

    default:
        echo json_encode(["message" => "Method not allowed."]);
        break;
}
