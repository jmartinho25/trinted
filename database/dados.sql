PRAGMA foreign_keys=ON;

DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Purchase;
DROP TABLE IF EXISTS Products;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Conditions;

CREATE TABLE Categories (
  CategoryId INTEGER PRIMARY KEY  AUTOINCREMENT,
  CategoryName VARCHAR UNIQUE
);

CREATE TABLE Conditions (
  ConditionId INTEGER PRIMARY KEY AUTOINCREMENT,
  ConditionName VARCHAR UNIQUE
);

CREATE TABLE Products(
ProductId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
ProductName VARCHAR NOT NULL,
Category VARCHAR NOT NULL,
Brand VARCHAR,
Size VARCHAR,
Condition VARCHAR NOT NULL,
Sold INT NOT NULL DEFAULT 0,
Product_description VARCHAR,
Price FLOAT NOT NULL,
Seller_id INTEGER NOT NULL,
FOREIGN KEY (Seller_id) REFERENCES Users(UserId)
FOREIGN KEY (Category) REFERENCES Categories(CategoryName)
FOREIGN KEY (Condition) REFERENCES Conditions(ConditionName)
ON DELETE CASCADE
);

CREATE TABLE Users (
  UserId INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  UserName VARCHAR NOT NULL UNIQUE ,      -- unique username
  UserPassword VARCHAR ,                  -- password stored in sha-1
  FirstName VARCHAR NOT NULL,                      -- real name
  LastName VARCHAR NOT NULL,
  Email VARCHAR NOT NULL,                     
  UserType INTEGER DEFAULT 0 ,
  User_rating FLOAT DEFAULT 0,
  User_address VARCHAR NOT NULL,
  PhoneNumber VARCHAR NOT NULL                   
);



CREATE TABLE Purchase (
  UserId INTEGER REFERENCES Users ON DELETE CASCADE,
  ProductId INTEGER REFERENCES Products ON DELETE CASCADE,
  Date DATETIME NOT NULL,
  Rating FLOAT NOT NULL DEFAULT 0,
  PRIMARY KEY(UserId, ProductId)
);

CREATE TABLE Cart(
  UserId INTEGER REFERENCES Users ON DELETE CASCADE,
  ProductId INTEGER REFERENCES Products ON DELETE CASCADE,
  PRIMARY KEY(UserId, ProductId)
);

CREATE TABLE Favorites(
  UserId INTEGER REFERENCES Users ON DELETE CASCADE,
  ProductId INTEGER REFERENCES Products ON DELETE CASCADE,
  PRIMARY KEY(UserId, ProductId)
);

/**CATEGORIES**/
INSERT INTO Categories(CategoryName) VALUES ("Moda");
INSERT INTO Categories(CategoryName) VALUES ("Tecnologia");
INSERT INTO Categories(CategoryName) VALUES ("Casa");
INSERT INTO Categories(CategoryName) VALUES ("Automóveis");
INSERT INTO Categories(CategoryName) VALUES ("Geral");


/**Conditions**/
INSERT INTO Conditions(ConditionName) VALUES ("Novo");
INSERT INTO Conditions(ConditionName) VALUES ("Como novo");
INSERT INTO Conditions(ConditionName) VALUES ("Usado");

/******************************************************USERS************************************************/

INSERT INTO Users (UserId, UserName, UserPassword, FirstName, LastName, Email, UserType, User_rating, User_address, PhoneNumber) 
VALUES (1, 'joao123', '$2y$10$OWjS6hzlF7wTFrCGqwm4ke/t.7uLIyoGVZhKWH6wINwxJXOo8Hli6', 'João', 'Silva', 'joao@example.com', 0, 4.50, 'Rua da Liberdade, 123, Lisboa, Portugal', '912345678');

INSERT INTO Users (UserId, UserName, UserPassword, FirstName, LastName, Email, UserType, User_rating, User_address, PhoneNumber) 
VALUES (2, 'ana456', '$2y$10$1pUR2ZplBrLD1LmUTEmkEOkNofqcoxx/Nl/BHdbn4mkWbrqzF.chO', 'Ana', 'Sousa', 'ana@example.com', 1, 3.50, 'Avenida Central, 456, Porto, Portugal', '912345678');

INSERT INTO Users (UserId, UserName, UserPassword, FirstName, LastName, Email, UserType, User_rating, User_address, PhoneNumber) 
VALUES (3, 'carlos789', '$2y$10$1rIJbKtA1LGF2sePsrWoXOyg0gj0vCGcpka6klI3Jn6vY5vFX81y2', 'Carlos', 'Oliveira', 'carlos@example.com', 0, 4.75, 'Travessa das Flores, 789, Coimbra, Portugal', '918765432');
    
INSERT INTO Users (UserId, UserName, UserPassword, FirstName, LastName, Email, UserType, User_rating, User_address, PhoneNumber) 
VALUES (4, 'maria101', '$2y$10$LxrG.pYSGemtRGfkYd1MSuu5PnTxVCABgRERyDFcQdmlj1RJfAn6a', 'Maria', 'Fernandes', 'maria@example.com', 0, 5.00, 'Rua Direita, 101, Braga, Portugal', '927654321');
    
INSERT INTO Users (UserId, UserName, UserPassword, FirstName, LastName, Email, UserType, User_rating, User_address, PhoneNumber) 
VALUES (5, 'pedro2022', '$2y$10$O/AhS0R3k8V4tm2WLtqQneRotC.XoQbbDm2ZftFhfU7YYY29FuQOO', 'Pedro', 'Ribeiro', 'pedro@example.com', 0, 3.90, 'Praça da República, 222, Faro, Portugal', '933214567');


/************************************PRODUCTS*************************************************************/

/**CATEGORIA 1: MODA**/

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id)
VALUES ('T-Shirt', 'Moda', 'Adidas', 'M', 'Novo', 0, 'T-shirt Adidas de cor Preta em excelente condição, sem qualquer utilização', 29.99 , 1);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Camisola com Capuz', 'Moda', 'Nike', 'L', 'Novo', 1, 'Camisola com Capuz Nike na cor Azul, tamanho L, nunca usada.', 44.99 , 2);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Sapatilhas', 'Moda', 'Reebok', '42', 'Novo', 0, 'Sapatilhas Reebok na cor Branca, tamanho 42, novas na caixa.', 59.99, 3);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Casaco', 'Moda', 'Puma', 'XL', 'Usado', 0, 'Casaco Puma na cor Vermelha, tamanho XL, em bom estado.', 34.99 , 4);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Calças', 'Moda', 'Adidas', 'S', 'Novo', 0, 'Calças Adidas na cor Preta, tamanho S, nunca usadas.', 24.99 , 5);

/**CATEGORIA 2: TECNOLOGIA**/

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Smartphone', 'Tecnologia', 'Samsung', NULL, 'Novo', 0, 'Smartphone Samsung de última geração, com câmera de alta resolução e tela AMOLED.', 699.99, 1);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Portátil', 'Tecnologia', 'HP', '15.6"', 'Novo', 0, 'Portátil HP com processador Intel Core i5, memória RAM de 8GB e SSD de 512GB.', 849.99, 2);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Smartwatch', 'Tecnologia', 'Apple', NULL, 'Novo', 1, 'Smartwatch Apple com monitor de frequência cardíaca, GPS integrado e resistência à água.', 299.99, 3);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Tablet', 'Tecnologia', 'Lenovo', '10.1"', 'Usado', 0, 'Tablet Lenovo com ecrã Full HD, processador octa-core e suporte para cartão de memória.', 199.99, 4);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Câmara DSLR', 'Tecnologia', 'Canon', NULL, 'Usado', 0, 'Câmara Canon DSLR com sensor de imagem de alta resolução e gravação de vídeo Full HD.', 599.99, 5);

/**CATEGORIA 3: CASA**/

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Sofá de Canto', 'Casa', 'IKEA', '200x150 cm', 'Novo', 1, 'Sofá de canto IKEA em tecido cinzento, ideal para espaços amplos.', 799.99, 1);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Cama de Casal', 'Casa', 'Móveis Europa', '160x200 cm', 'Usado', 0, 'Cama de casal Móveis Europa em madeira maciça de carvalho, inclui estrado e colchão.', 499.99, 2);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Mesa de Jantar', 'Casa', 'Conforama', '180x90 cm', 'Novo', 0, 'Mesa de jantar Conforama em madeira de pinho, ideal para refeições em família.', 299.99, 3);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Candeeiro de Pé', 'Casa', 'Leroy Merlin', '180 cm', 'Novo', 0, 'Candeeiro de pé Leroy Merlin em metal preto, proporciona iluminação suave para o ambiente.', 89.99, 4);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Tapete', 'Casa', 'Habitex', '200x300 cm', 'Novo', 0, 'Tapete Habitex em tecido macio e resistente, na cor bege com padrão geométrico.', 149.99, 5);

/**CATEGORIA 4: AUTOMÓVEIS**/

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Volkswagen Golf', 'Automóveis', 'Volkswagen', NULL, 'Usado', 0, 'Volkswagen Golf praticamente completo, passa por novo.', 1000.00, 1);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Renault Clio', 'Automóveis', 'Renault', NULL, 'Usado', 0, 'Renault Clio de 2018, único dono e em perfeito estado de conservação.', 9000.00, 2);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('BMW Série 3', 'Automóveis', 'BMW', NULL, 'Novo', 0, 'BMW Série 3 último modelo, com motorização potente e acabamentos de luxo.', 45000.00, 3);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Ford Fiesta', 'Automóveis', 'Ford', NULL, 'Usado', 1, 'Ford Fiesta económico e fiável, ideal para condução na cidade.', 6000.00, 4);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Audi A4', 'Automóveis', 'Audi', NULL, 'Usado', 1, 'Audi A4 em excelente estado, com motor diesel e muitos extras.', 18000.00, 5);

/**CATEGORIA 0: GERAL**/

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Máquina de Café Expresso', 'Geral', 'Nespresso', NULL, 'Novo', 0, 'Máquina de café expresso Nespresso, com sistema de cápsulas e diversas opções de bebidas.', 149.99, 1);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Conjunto de Facas', 'Geral', 'Wüsthof', NULL, 'Novo', 0, 'Conjunto de facas Wüsthof em aço inoxidável de alta qualidade, inclui faca de chef, faca de pão, faca de legumes e afiador.', 199.99, 2);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Kit de Ferramentas', 'Geral', 'Bosch', NULL, 'Novo', 0, 'Kit de ferramentas Bosch com furadeira, chave de fendas, martelo, alicate e diversos acessórios, ideal para uso doméstico.', 99.99, 3);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Grill Elétrico', 'Geral', 'George Foreman', NULL, 'Novo', 0, 'Grill elétrico George Foreman para grelhados saudáveis, com placa antiaderente e bandeja de gordura removível.', 79.99, 4);

INSERT INTO Products (ProductName, Category, Brand, Size, Condition, Sold, Product_description, Price, Seller_id) 
VALUES ('Jogo de Toalhas', 'Geral', 'Zara Home', NULL, 'Novo', 0, 'Jogo de toalhas Zara Home em algodão macio e absorvente, inclui toalhas de banho, rosto e mãos.', 29.99, 5);

/************************************PURCHASE*************************************************************/
INSERT INTO Purchase (UserId, ProductId, Date, Rating) 
VALUES (3, 11, '2024-04-15 10:30',4.50);

INSERT INTO Purchase (UserId, ProductId, Date, Rating) 
VALUES (1, 19, '2024-05-20 14:45',5.00);

INSERT INTO Purchase (UserId, ProductId, Date, Rating) 
VALUES (4, 2, '2024-06-10 09:00',3.50);

INSERT INTO Purchase (UserId, ProductId, Date, Rating) 
VALUES (2, 8, '2024-07-01 16:20',4.75);

INSERT INTO Purchase (UserId, ProductId, Date, Rating) 
VALUES (5, 20, '2024-05-25 10:00',3.90);


/************************************SHOPPING CART*************************************************************/
INSERT INTO Cart(UserId, ProductId) 
VALUES (1, 7);

INSERT INTO Cart(UserId, ProductId) 
VALUES (1, 15);

INSERT INTO Cart(UserId, ProductId) 
VALUES (1, 3);


INSERT INTO Cart(UserId, ProductId) 
VALUES (2, 18);

INSERT INTO Cart(UserId, ProductId) 
VALUES (3, 3);

INSERT INTO Cart(UserId, ProductId) 
VALUES (3, 21);

INSERT INTO Cart(UserId, ProductId) 
VALUES (4, 7);

INSERT INTO Cart(UserId, ProductId) 
VALUES (4, 12);

INSERT INTO Cart(UserId, ProductId) 
VALUES (4, 23);

INSERT INTO Cart(UserId, ProductId) 
VALUES (5, 2);

INSERT INTO Cart(UserId, ProductId) 
VALUES (5, 14);

INSERT INTO Cart(UserId, ProductId) 
VALUES (5, 21);

/************************************FAVORITES*************************************************************/

INSERT INTO Favorites(UserId, ProductId) 
VALUES (1, 8);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (1, 16);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (1, 4);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (2, 10);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (2, 18);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (2, 6);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (3, 5);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (3, 15);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (3, 22);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (4, 8);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (4, 16);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (4, 23);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (5, 3);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (5, 12);

INSERT INTO Favorites(UserId, ProductId) 
VALUES (5, 19);





