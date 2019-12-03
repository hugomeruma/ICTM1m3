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
  
  
  <strong>27-11-2019 - Add Reviews </strong><br>
  CREATE TABLE `reviews` (
   
CREATE TABLE `reviews` (
  `ReviewID` int(11) NOT NULL,
  `StockItemID` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Rating` int(2) NOT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `reviews` (`ReviewID`, `StockItemID`, `UserID`, `Name`, `Rating`, `Description`) VALUES
(7, '118', 0, 'Alexander T Roos', 10, 'asdfasdfasf');

ALTER TABLE `reviews`
  ADD PRIMARY KEY (`ReviewID`);

ALTER TABLE `reviews`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;


   <strong>29-11-2019 - Special Deals </strong><br>
   drop table if exists `specialdeals`;
   
   
CREATE TABLE `specialdeals` (
  `SpecialDealID` int(11) NOT NULL,
  `StockItemID` int(11) DEFAULT NULL,
  `StockGroupID` int(11) DEFAULT NULL,
  `CustomerCategoryID` int(11) DEFAULT NULL,
  `DealDescription` varchar(30) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `DiscountAmount` decimal(18,2) DEFAULT NULL,
  `DiscountPercentage` int(2) DEFAULT NULL,
  `UnitPrice` int(18) DEFAULT NULL,
  `LastEditedBy` int(11) NOT NULL,
  `LastEditedWhen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `specialdeals` (`SpecialDealID`, `StockItemID`, `StockGroupID`, `CustomerCategoryID`, `DealDescription`, `StartDate`, `EndDate`, `DiscountAmount`, `DiscountPercentage`, `UnitPrice`, `LastEditedBy`, `LastEditedWhen`) VALUES
(1, NULL, 7, NULL, '10% op USB-Novelties', '2019-11-27', '2020-11-27', NULL, 10, NULL, 1, '2019-11-28 00:00:00'),
(2, 220, NULL, NULL, '5% Discount on cooled chocolat', '2019-11-27', '2020-11-27', NULL, 5, NULL, 1, '2019-11-28 00:00:00'),
(3, 221, NULL, NULL, '5% Discount on cooled chocolat', '2019-11-27', '2020-11-27', NULL, 5, NULL, 1, '2019-11-28 00:00:00'),
(4, 222, NULL, NULL, '5% Discount on \" . $_GET[\'view', '2019-11-27', '2020-11-27', NULL, 5, NULL, 1, '2019-11-28 00:00:00');

ALTER TABLE `specialdeals`
  ADD PRIMARY KEY (`SpecialDealID`),
  ADD KEY `FK_Sales_SpecialDeals_StockItemID` (`StockItemID`),
  ADD KEY `FK_Sales_SpecialDeals_CustomerCategoryID` (`CustomerCategoryID`),
  ADD KEY `FK_Sales_SpecialDeals_StockGroupID` (`StockGroupID`),
  ADD KEY `FK_Sales_SpecialDeals_Application_People` (`LastEditedBy`);

ALTER TABLE `specialdeals`
  ADD CONSTRAINT `FK_Sales_SpecialDeals_Application_People` FOREIGN KEY (`LastEditedBy`) REFERENCES `people` (`PersonID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Sales_SpecialDeals_CustomerCategoryID_Sales_CustomerCategor16` FOREIGN KEY (`CustomerCategoryID`) REFERENCES `customercategories` (`CustomerCategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Sales_SpecialDeals_StockGroupID_Warehouse_StockGroups` FOREIGN KEY (`StockGroupID`) REFERENCES `stockgroups` (`StockGroupID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Sales_SpecialDeals_StockItemID_Warehouse_StockItems` FOREIGN KEY (`StockItemID`) REFERENCES `stockitems` (`StockItemID`) ON DELETE NO ACTION ON UPDATE NO ACTION;