<?php 
declare(strict_types=1);

class User{
    public int $id;
    public string $userName;
    public string $password;
    public string $firstName;
    public string $lastName;
    public string $email;
    public ?int $userType;
    public ?float $rating;
    public string $address;
    public string $phoneNumber;
    
    public function __construct(int $id, string $userName, string $password, string $firstName, string $lastName, string $email, ?int $userType, ?float $rating, string $address, string $phoneNumber){
        $this->id = $id;
        $this->userName = $userName;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->userType = $userType;
        $this->rating = $rating;
        $this->address = $address;
        $this->phoneNumber = $phoneNumber;
    }
    
    static function getUsers(PDO $db, int $count){
        $stmt = $db->prepare('SELECT UserId, UserName AS users FROM Users LIMIT ?');
        $stmt->execute(array($count));
        
        $users = array();
        while($user= $stmt->fetch()){
            $users[]=new User(
                
                $user['UserId'],
                $user['UserName']);
            }
            return $users;
        }
        
        static function getUser(PDO $db, int $id){
            $stmt = $db->prepare('SELECT UserId, UserName, UserPassword, FirstName, LastName, Email, UserType, User_rating, User_address, PhoneNumber
            FROM Users
            WHERE UserId = ?');
            $stmt->execute(array($id));
            
            $user=$stmt->fetch();
            return new User(
                $user['UserId'],
                $user['UserName'],
                $user['UserPassword'],
                $user['FirstName'],
                $user['LastName'],
                $user['Email'],
                $user['UserType'],
                $user['User_rating'],
                $user['User_address'],
                $user['PhoneNumber']
            );
        }

        static function getUserByEmail(PDO $db, string $email, string $password){
            $stmt = $db->prepare('SELECT * FROM Users
            WHERE Email = ?');
            $stmt->execute(array($email));

            $user=$stmt->fetch();
            if($user!==false && /*$password==$user['UserPassword']*/password_verify($password, $user['UserPassword'])){
                return new User(
                    $user['UserId'],
                    $user['UserName'],
                    $user['UserPassword'],
                    $user['FirstName'],
                    $user['LastName'],
                    $user['Email'],
                    $user['UserType'],
                    $user['User_rating'],
                    $user['User_address'],
                    $user['PhoneNumber']
                );
            } else return null;
        }

        public function getName(): string{
            return $this->firstName . ' ' . $this->lastName;
        }

        function getPhoto(int $id): string{
            $photo="/resources/images/users/$id.jpg";
            if(file_exists(dirname(__DIR__).$photo)){
                /*$_SESSION['photo']=$photo;*/
                return $photo;
            }
            else return "/resources/images/users/pessoa.jpg";
        }

        function save($db) {
            $stmt = $db->prepare('
              UPDATE Users SET UserName = ?, UserPassword= ?, FirstName=?, LastName=?, Email=?, User_address=?, PhoneNumber=?
              WHERE UserId= ?
            ');
      
            $stmt->execute(array($this->userName, $this->password, $this->firstName, $this->lastName, $this->email, $this->address, $this->phoneNumber,
                                  $this->id));
            
            if($stmt->rowCount() == 0) {
                return 1;
            }
            else {
                return 0;
            }
          }
        

          function getUserRating(){
            $db=getDatabaseConnection();
            $stmt = $db->prepare('SELECT AVG(Rating) AS totalRating FROM Purchase JOIN Products ON Products.ProductId=Purchase.ProductId WHERE Seller_id = ?');
            $stmt->execute(array($this->id));
        
            $a = $stmt->fetch();
            return number_format((float)$a['totalRating'],2,'.','');
        }
    }
    ?>