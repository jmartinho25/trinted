<?php
    declare(strict_types = 1);

    class Product{
        public int $id;
        public string $name;
        public string $category;
        public string $brand;
        public ?string $size;
        public string $condition;
        public int $sold;
        public string $description;
        public float $price;
        public int $seller_id;
        public string $seller_name;
        public float $seller_rating;
    
        public function __construct(int $id, string $name, string $category, string $brand, ?string $size, string $condition, int $sold, string $description, float $price, int $seller_id, string $seller_name, float $seller_rating){
            $this->id = $id;
            $this->name = $name;
            $this->category = $category;
            $this->brand = $brand;
            $this->size = $size;
            $this->condition = $condition;
            $this->sold = $sold;
            $this->description = $description;
            $this->price = $price;
            $this->seller_id = $seller_id;
            $this->seller_name = $seller_name;
            $this->seller_rating = $seller_rating;
        }

        static function getProduct(PDO $db, int $id){
            $stmt=$db->prepare('SELECT ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating
            FROM Products JOIN Users ON Seller_id = Users.UserID
            WHERE ProductId=?' );
    
            $stmt->execute(array($id));
    
            $product=$stmt->fetch();
    
            return new Product(
                $product['ProductId'],
                $product['ProductName'],
                $product['Category'],
                $product['Brand'],
                $product['Size'],
                $product['Condition'],
                $product['Sold'],
                $product['Product_description'],
                $product['Price'],
                $product['Seller_id'],
                $product['FirstName'].' '.$product['LastName'],
                $product['User_rating']
            );
        }

        static function getProducts(PDO $db, int $count ){
            $stmt=$db->prepare('SELECT ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating
                FROM Products JOIN Users ON Seller_id = Users.UserID
                LIMIT ?' );
            $stmt->execute(array($count));
    
            $products= array();
            while ($product = $stmt->fetch()) {
                $products[]=new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }

        static function getProductsByCategory(PDO $db, string $category){
            $stmt = $db->prepare('SELECT ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating
            FROM Products JOIN Users ON Seller_id = Users.UserID
            WHERE Category = ?');
            $stmt->execute(array($category));
    
            $products= array();
            while ($product = $stmt->fetch()) {
                $products[]=new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }

        static function getProductsBySellerId(PDO $db, int $seller_id){
            $stmt = $db->prepare('SELECT ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating
            FROM Products JOIN Users ON Seller_id = Users.UserID
            WHERE Seller_id = ?');
            $stmt->execute(array($seller_id));
            $products= array();
            while ($product = $stmt->fetch()) {
                $products[]=new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }

        public function getPhoto(int $id) : string {
            $photo="/resources/images/products/".$id."_01.jpg";
            if(file_exists(dirname(__DIR__).$photo)){
                /*$_SESSION['photo']=$photo;*/
                return $photo;
            }
            else return "/resources/images/products/produto.jpg";
        }

        function getUserPhoto(int $id): string{
            $photo="/resources/images/users/$id.jpg";
            if(file_exists(dirname(__DIR__).$photo)){
                /*$_SESSION['photo']=$photo;*/
                return $photo;
            }
            else return "/resources/images/users/pessoa.jpg";
        }

        function save($db) {
            $stmt = $db->prepare('
              UPDATE Products SET ProductName = ?, Category= ?, Brand=?, Size=?, Condition=?, Product_description=?, Price=?
              WHERE ProductId= ?
            ');
      
            $stmt->execute(array($this->name, $this->category, $this->brand, $this->size, $this->condition, $this->description, $this->price,
                                  $this->id));
          }
        
        static function getFavProducts(PDO $db, int $id){
            $stmt=$db->prepare('SELECT Products.ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating, Users.UserId
                FROM Products JOIN Favorites ON Products.ProductId = Favorites.ProductId JOIN Users ON Favorites.UserId = Users.UserId
                WHERE Favorites.UserId=?' );
            $stmt->execute(array($id));
    
            $products= array();
            while ($product = $stmt->fetch()) {
                $products[]=new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }

        static function getCartProducts(PDO $db, int $id){
            $stmt=$db->prepare('SELECT Products.ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating, Users.UserId
                FROM Products JOIN Cart ON Products.ProductId = Cart.ProductId JOIN Users ON Cart.UserId = Users.UserId
                WHERE Cart.UserId=?' );
            $stmt->execute(array($id));
    
            $products= array();
            while ($product = $stmt->fetch()) {
                $products[]=new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }
        
        static function getSoldProducts(PDO $db, int $id){
            $stmt=$db->prepare('SELECT Products.ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating, Users.UserId
                FROM Products JOIN Purchase ON Products.ProductId = Purchase.ProductId JOIN Users ON Purchase.UserId = Users.UserId
                WHERE Purchase.UserId=? AND Sold=?');
            $stmt->execute(array($id,1));
    
            $products= array();
            while ($product = $stmt->fetch()) {
                $products[]=new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }

        static function getSoldProducts2(PDO $db, int $id){
            $stmt=$db->prepare('SELECT Products.ProductId, ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id, FirstName, LastName, User_rating, Users.UserId
                FROM Products JOIN Purchase ON Products.ProductId = Purchase.ProductId JOIN Users ON Products.Seller_id = Users.UserId
                WHERE Products.Seller_id=? AND Sold=?');
            $stmt->execute(array($id,1));
    
            $products= array();
            while ($product = $stmt->fetch()) {
                $products[]=new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }

        static function getRecommendedProducts(PDO $db) {
            $stmt = $db->prepare('SELECT Products.ProductId, Products.ProductName, Products.Category, Products.Brand, Products.Size, Products.Condition, Products.Sold, Products.Product_description, Products.Price, Products.Seller_id, Users.FirstName, Users.LastName, Users.User_rating
                                  FROM Products 
                                  JOIN Users ON Products.Seller_id = Users.UserID
                                  WHERE Products.Sold = 0
                                  ORDER BY Users.User_rating DESC
                                  LIMIT 10');
            $stmt->execute();
        
            $products = array();
            while ($product = $stmt->fetch()) {
                $products[] = new Product(
                    $product['ProductId'],
                    $product['ProductName'],
                    $product['Category'],
                    $product['Brand'],
                    $product['Size'],
                    $product['Condition'],
                    $product['Sold'],
                    $product['Product_description'],
                    $product['Price'],
                    $product['Seller_id'],
                    $product['FirstName'].' '.$product['LastName'],
                    $product['User_rating']
                );
            }
            return $products;
        }

        static function search(PDO $db, string $search, string $type) : array {

            $querie = '';
            $result = array();
      
            switch ($type) {
              case "Pname":
                  $querie = 'SELECT  Products.ProductId, Products.ProductName, Products.Category, Products.Brand, Products.Size, Products.Condition, Products.Sold, Products.Product_description, Products.Price, Products.Seller_id, Users.FirstName, Users.LastName, Users.User_rating
                            FROM Products JOIN Users ON Products.Seller_id = Users.UserID
                            WHERE ProductName LIKE ?';
                  break;
              case "Cname":
                  $querie = 'SELECT Products.ProductId, Products.ProductName, Products.Category, Products.Brand, Products.Size, Products.Condition, Products.Sold, Products.Product_description, Products.Price, Products.Seller_id, Users.FirstName, Users.LastName, Users.User_rating
                             FROM Products 
                             JOIN Categories ON Products.Category = Categories.CategoryName
                             JOIN Users ON Products.Seller_id = Users.UserID
                             WHERE Categories.CategoryName LIKE ?';
                  break;
              case "Uname":
                  $querie = "SELECT Products.ProductId, Products.ProductName, Products.Category, Products.Brand, Products.Size, Products.Condition, Products.Sold, Products.Product_description, Products.Price, Products.Seller_id, Users.FirstName, Users.LastName, Users.User_rating
                            FROM Products JOIN Users ON Products.Seller_id = Users.UserId
                            WHERE CONCAT(Users.FirstName, ' ', Users.LastName) LIKE ?";
                break;
                  break;
              default:  
                  return $result;
            }
      
            $stmt = $db->prepare($querie);
            $stmt->execute(array('%'.$search.'%'));
      
            while ($product = $stmt->fetch()) {
              $result[] = new Product(
                $product['ProductId'],
                $product['ProductName'],
                $product['Category'],
                $product['Brand'],
                $product['Size'],
                $product['Condition'],
                $product['Sold'],
                $product['Product_description'],
                $product['Price'],
                $product['Seller_id'],
                $product['FirstName'].' '.$product['LastName'],
                $product['User_rating']
              );
            }
            return $result;
          }
       
}


?> 
