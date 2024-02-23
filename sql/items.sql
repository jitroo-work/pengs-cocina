CREATE TABLE IF NOT EXISTS Items (
    ItemID INT AUTO_INCREMENT PRIMARY KEY,
    ProductName VARCHAR(255) NOT NULL,
    Description VARCHAR(255),
    DateAcquired DATE,
    IsPerishable BOOLEAN,
    DateExpiration DATE,
    VendorName VARCHAR(255),
    Quantity INT UNSIGNED,
    Price FLOAT
);

ALTER TABLE `items`
MODIFY COLUMN DateAcquired datetime default CURRENT_TIMESTAMP;

ALTER TABLE `items`
    ADD UNIQUE KEY `ProductName` (`ProductName`);
