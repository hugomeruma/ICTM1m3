<strong>29-11-2019 - Add rights</strong> <br>

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL ,
  `password` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postalCode` varchar(50) NOT NULL,
  `houseNumber` varchar(20) NOT NULL,
  `streetName` varchar(50) NOT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL
)
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;


<strong>25-11-2019 - Add rights</strong> <br>
ALTER TABLE `accounts` ADD `isAdmin` BOOLEAN NOT NULL AFTER `phoneNumber`;

<strong>27-11-2019 - Add images</strong><br>
Verwijder Photo kolom uit stockitems <br> <br>

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `ImageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `AltText` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`);
COMMIT;

CREATE TABLE `stockitem_images` (
  `StockitemImageID` int(11) NOT NULL,
  `StockitemID` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `stockitem_images`
  ADD PRIMARY KEY (`StockitemImageID`),
  ADD KEY `StockitemID` (`StockitemID`,`ImageID`);

ALTER TABLE `stockitem_images`
  ADD CONSTRAINT `stockitemImages_images` FOREIGN KEY (`StockitemImageID`) REFERENCES `images` (`ImageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stockitemImages_stockitem` FOREIGN KEY (`StockitemID`) REFERENCES `stockitems` (`StockItemID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

CREATE TABLE `stock_group_images` (
  `StockitemGroupImageID` int(11) NOT NULL,
  `StockitemGroupID` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `stock_group_images`
  ADD PRIMARY KEY (`StockitemGroupImageID`),
  ADD KEY `StockitemGroupID` (`StockitemGroupID`),
  ADD KEY `ImageID` (`ImageID`);
  
  ALTER TABLE `stock_group_images`
    ADD CONSTRAINT `StockGroupImages_Image` FOREIGN KEY (`StockitemGroupImageID`) REFERENCES `images` (`ImageID`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `StockGroupImages_StockGroup` FOREIGN KEY (`StockitemGroupID`) REFERENCES `stockgroups` (`StockGroupID`) ON DELETE CASCADE ON UPDATE CASCADE;
  COMMIT;
  
  <strong>27-11-2019 - Add Reviews </strong><br>
  CREATE TABLE `reviews` (
    `ReviewID` int(11) NOT NULL,
    `Name` varchar(255) DEFAULT NULL,
    `Rating` float NOT NULL,
    `Title` varchar(255) NOT NULL,
    `Description` text DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  COMMIT;
