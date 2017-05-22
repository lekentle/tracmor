TRUNCATE TABLE `shortcut`;
INSERT INTO `shortcut` (`module_id`, `authorization_id`, `transaction_type_id`, `short_description`, `link`, `image_path`, `entity_qtype_id`, `create_flag`) VALUES 
	(2,2,NULL,'Create Asset Model','../assets/asset_model_edit.php','asset_model_create.png',4,1),
	(2,1,NULL,'Asset Models','../assets/asset_model_list.php','asset_model.png',4,0),
	(2,2,NULL,'Import Asset Models','../assets/asset_model_import.php','asset_model_import.png',4,1),
	(2,2,NULL,'Create Asset','../assets/asset_edit.php','asset_create.png',1,1),
	(2,1,NULL,'Assets','../assets/asset_list.php','asset.png',1,0),
	(2,2,NULL,'Import Assets','../assets/asset_import.php','asset_import.png',1,1),
	(2,2,1,'Move Assets','../assets/asset_edit.php?intTransactionTypeId=1', 'asset_move.png',1,0),
	(2,2,3,'Check Out Assets','../assets/asset_edit.php?intTransactionTypeId=3', 'asset_checkout.png',1,0),
	(2,2,2,'Check In Assets','../assets/asset_edit.php?intTransactionTypeId=2', 'asset_checkin.png',1,0),
	(2,2,8,'Reserve Assets','../assets/asset_edit.php?intTransactionTypeId=8', 'asset_reserve.png',1,0),
	(3,2,NULL,'Create Inventory','../inventory/inventory_edit.php','inventory_create.png',2,1),
	(3,1,NULL,'Inventory','../inventory/inventory_model_list.php','inventory.png',2,0),
	(3,2,1,'Move Inventory','../inventory/inventory_edit.php?intTransactionTypeId=1', 'inventory_move.png',2,0),
	(3,2,5,'Take Out Inventory','../inventory/inventory_edit.php?intTransactionTypeId=5', 'inventory_takeout.png',2,0),
	(3,2,4,'Restock Inventory','../inventory/inventory_edit.php?intTransactionTypeId=4', 'inventory_restock.png',2,0),
	(4,2,NULL,'Create Company','../contacts/company_edit.php','company_create.png',7,1),
	(4,1,NULL,'Companies','../contacts/company_list.php','company.png',7,0),
	(4,2,NULL,'Import Companies','../contacts/company_import.php','company_import.png',7,1),
	(4,2,NULL,'Create Contact','../contacts/contact_edit.php','contact_create.png',8,1),
	(4,1,NULL,'Contacts','../contacts/contact_list.php','contact.png',8,0),
	(4,2,NULL,'Import Contacts','../contacts/contact_import.php','contact_import.png',8,1),
	(5,2,NULL,'Schedule Shipment','../shipping/shipment_edit.php','shipment_schedule.png',10,1),
	(5,1,NULL,'Shipments','../shipping/shipment_list.php','shipment.png',10,0),
	(6,2,NULL,'Schedule Receipt','../receiving/receipt_edit.php','receipt_schedule.png',11,1),
	(6,1,NULL,'Receipts','../receiving/receipt_list.php','receipt.png',11,0),
	(7,1,NULL,'Asset Audit Reports','../reports/asset_audit_list.php','receipt.png',1,0),
	(7,1,NULL,'Inventory Audit Reports','../reports/inventory_audit_list.php','receipt.png',2,0),
	(7,1,NULL,'Asset Transaction Report','../reports/asset_transaction_report.php','asset.png',1,0),
	(2,2,10,'Archive Assets','../assets/asset_edit.php?intTransactionTypeId=10','asset_archive.png',1,0),
	(2,2,11,'Unarchive Assets','../assets/asset_edit.php?intTransactionTypeId=11','asset_unarchive.png',1,0);