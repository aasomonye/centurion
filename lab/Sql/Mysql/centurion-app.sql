CREATE TABLE IF NOT EXISTS `Zema_assets` (
	assetid BIGINT(20) auto_increment primary key, 
	path VARCHAR(255) , 
	tag VARCHAR(255) default 'css', 
	visible TINYINT default 1, 
	position INT default 1, 
	siteid VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS `Zema_config` (
	configid BIGINT(20) auto_increment primary key, 
	sitename VARCHAR(255) , 
	default_controller VARCHAR(255) , 
	default_view VARCHAR(255) , 
	favicon VARCHAR(255) , 
	keywords TEXT , 
	description TEXT , 
	developer VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_containers` (
	containerid BIGINT(20) auto_increment primary key, 
	container_name VARCHAR(255) , 
	container_body TEXT , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_directives` (
	directiveid BIGINT(20) auto_increment primary key, 
	directive VARCHAR(255) , 
	directive_class VARCHAR(255) , 
	directive_method VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_images` (
	imageid BIGINT(20) auto_increment primary key, 
	image_path VARCHAR(255) , 
	alt VARCHAR(255) , 
	title VARCHAR(255) , 
	image_name VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_installations` (
	installationid BIGINT(20) auto_increment primary key, 
	installation_type VARCHAR(255) , 
	installation_path VARCHAR(255) , 
	installation_title VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_navigation` (
	navigationid BIGINT(20) auto_increment primary key, 
	page_name VARCHAR(255) , 
	page_link VARCHAR(255) , 
	navigationtypeid INT , 
	visible TINYINT default 1, 
	position INT default 1, 
	parentid BIGINT default 0, 
	keyword VARCHAR(255) , 
	description TEXT , 
	page_title VARCHAR(255) , 
	breadcum_title VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_navigationtypes` (
	navigationtypeid BIGINT(20) auto_increment primary key, 
	navigationtype VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_permission` (
	permissionid BIGINT(20) auto_increment primary key, 
	permission VARCHAR(255) , 
	permission_group TEXT , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_slides` (
	slideid BIGINT(20) auto_increment primary key, 
	slide_title VARCHAR(255) , 
	slide_group VARCHAR(255) default 'homescreen', 
	slide_image VARCHAR(255) , 
	slide_btn VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_slidesAnimation` (
	slidesAnimationid BIGINT(20) auto_increment primary key, 
	slideid BIGINT , 
	content VARCHAR(255) , 
	contentWrapper VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_tables` (
	tableid BIGINT(20) auto_increment primary key, 
	table_identifier VARCHAR(255) , 
	table_linker VARCHAR(255) , 
	table_json TEXT , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_users` (
	userid BIGINT(20) auto_increment primary key, 
	permissionid BIGINT default 1, 
	username VARCHAR(255) , 
	password VARCHAR(255) , 
	fullname VARCHAR(255) , 
	createdby BIGINT default 0, 
	dateadded DATETIME default CURRENT_TIMESTAMP, 
	loggedinToken VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_Events` (
	eventid BIGINT(20) auto_increment primary key, 
	event_title VARCHAR(255) , 
	event_body TEXT , 
	event_date VARCHAR(255) , 
	date_created DATETIME default CURRENT_TIMESTAMP, 
	event_image VARCHAR(255) , 
	event_button VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Zema_PhotoBoot` (
	imageid BIGINT(20) auto_increment primary key, 
	image_name VARCHAR(255) , 
	image_caption TEXT , 
	image VARCHAR(255) , 
	date_created DATETIME default CURRENT_TIMESTAMP, 
	publish VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Centurion_Events` (
	eventid BIGINT(20) auto_increment primary key, 
	event_title VARCHAR(255) , 
	event_body TEXT , 
	event_date VARCHAR(255) , 
	date_created DATETIME default CURRENT_TIMESTAMP, 
	event_image VARCHAR(255) , 
	event_button VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Centurion_PhotoBoot` (
	imageid BIGINT(20) auto_increment primary key, 
	image_name VARCHAR(255) , 
	image_caption TEXT , 
	image VARCHAR(255) , 
	date_created DATETIME default CURRENT_TIMESTAMP, 
	publish VARCHAR(255) , 
	siteid VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Centurion_accountNavigation` (
	accountNavigationid BIGINT(20) auto_increment primary key, 
	accountid INT , 
	page_title VARCHAR(255) , 
	page_link VARCHAR(255) , 
	parentid INT default 0, 
	pageicon VARCHAR(255) , 
	visible TINYINT default 1
);
ALTER TABLE `Centurion_accountNavigation` CHANGE COLUMN pageicon page_icon VARCHAR(255);

ALTER TABLE `Centurion_accountNavigation` CHANGE COLUMN pageicon page_icon VARCHAR(255);
CREATE TABLE IF NOT EXISTS `Centurion_accountNavigation` (
	accountNavigationid BIGINT(20) auto_increment primary key, 
	accountid INT , 
	page_title VARCHAR(255) , 
	page_link VARCHAR(255) , 
	parentid INT default 0, 
	page_icon VARCHAR(255) , 
	visible TINYINT default 1
);
CREATE TABLE IF NOT EXISTS `Centurion_business_information` (
	business_informationid BIGINT(20) auto_increment primary key, 
	business_name VARCHAR(255) , 
	contact_phone VARCHAR(255) , 
	contact_email VARCHAR(255) , 
	contact_address VARCHAR(300) , 
	cac_certificate VARCHAR(300) , 
	userid BIGINT
);
ALTER TABLE `Centurion_business_information` ADD about_business TEXT AFTER userid;
CREATE TABLE IF NOT EXISTS `Centurion_business_information` (
	business_informationid BIGINT(20) auto_increment primary key, 
	business_name VARCHAR(255) , 
	contact_phone VARCHAR(255) , 
	contact_email VARCHAR(255) , 
	contact_address VARCHAR(300) , 
	cac_certificate VARCHAR(300) , 
	userid BIGINT , 
	about_business TEXT
);
ALTER TABLE `Centurion_business_information` ADD verified TINYINT default 0 AFTER about_business;
CREATE TABLE IF NOT EXISTS `Centurion_business_information` (
	business_informationid BIGINT(20) auto_increment primary key, 
	business_name VARCHAR(255) , 
	contact_phone VARCHAR(255) , 
	contact_email VARCHAR(255) , 
	contact_address VARCHAR(300) , 
	cac_certificate VARCHAR(300) , 
	userid BIGINT , 
	about_business TEXT , 
	verified TINYINT default 0
);
ALTER TABLE `Centurion_business_information` ADD tin_number VARCHAR(255) AFTER verified;
CREATE TABLE IF NOT EXISTS `Centurion_business_information` (
	business_informationid BIGINT(20) auto_increment primary key, 
	business_name VARCHAR(255) , 
	contact_phone VARCHAR(255) , 
	contact_email VARCHAR(255) , 
	contact_address VARCHAR(300) , 
	cac_certificate VARCHAR(300) , 
	userid BIGINT , 
	about_business TEXT , 
	verified TINYINT default 0, 
	tin_number VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Centurion_property_facilities` (
	property_facilityid BIGINT(20) auto_increment primary key, 
	facility VARCHAR(255) , 
	facility_icon VARCHAR(255) , 
	visible TINYINT default 1, 
	parentid INT default 0
);
CREATE TABLE IF NOT EXISTS `Centurion_property_types` (
	property_typeid BIGINT(20) auto_increment primary key, 
	propertytype VARCHAR(255) , 
	typeicon VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Centurion_property_rules` (
	property_ruleid BIGINT(20) auto_increment primary key, 
	property_rule_title VARCHAR(255) , 
	property_rule VARCHAR(255) , 
	rule_icon VARCHAR(255) , 
	parentid INT
);
CREATE TABLE IF NOT EXISTS `Centurion_property_rooms` (
	property_roomid BIGINT(20) auto_increment primary key, 
	propertylistingid BIGINT , 
	property_room_title VARCHAR(255) , 
	sleeps INT default 2, 
	property_room_info TEXT , 
	room_price FLOAT , 
	isavaliable TINYINT
);
CREATE TABLE IF NOT EXISTS `Centurion_property_images` (
	property_imageid BIGINT(20) auto_increment primary key, 
	propertylistingid BIGINT , 
	propertyimage VARCHAR(255) , 
	cover_image TINYINT default 0, 
	visible TINYINT default 1
);
ALTER TABLE `Centurion_property_rooms` ADD total_rooms INT default 1 AFTER isavaliable;
CREATE TABLE IF NOT EXISTS `Centurion_property_rooms` (
	property_roomid BIGINT(20) auto_increment primary key, 
	propertylistingid BIGINT , 
	property_room_title VARCHAR(255) , 
	sleeps INT default 2, 
	property_room_info TEXT , 
	room_price FLOAT , 
	isavaliable TINYINT , 
	total_rooms INT default 1
);
ALTER TABLE `Centurion_property_rules` CHANGE COLUMN parentid parentid INT default 0;
CREATE TABLE IF NOT EXISTS `Centurion_property_rules` (
	property_ruleid BIGINT(20) auto_increment primary key, 
	property_rule_title VARCHAR(255) , 
	property_rule VARCHAR(255) , 
	rule_icon VARCHAR(255) , 
	parentid INT default 0
);
ALTER TABLE `Centurion_property_rules` ADD applytoroom TINYINT default 0 AFTER parentid;
CREATE TABLE IF NOT EXISTS `Centurion_property_rules` (
	property_ruleid BIGINT(20) auto_increment primary key, 
	property_rule_title VARCHAR(255) , 
	property_rule VARCHAR(255) , 
	rule_icon VARCHAR(255) , 
	parentid INT default 0, 
	applytoroom TINYINT default 0
);
ALTER TABLE `Centurion_property_facilities` ADD applytoroom TINYINT default 0 AFTER parentid;
CREATE TABLE IF NOT EXISTS `Centurion_property_facilities` (
	property_facilityid BIGINT(20) auto_increment primary key, 
	facility VARCHAR(255) , 
	facility_icon VARCHAR(255) , 
	visible TINYINT default 1, 
	parentid INT default 0, 
	applytoroom TINYINT default 0
);
ALTER TABLE `Centurion_property_rules` ADD input_type VARCHAR(255) default 'checkbox' AFTER applytoroom;
CREATE TABLE IF NOT EXISTS `Centurion_property_rules` (
	property_ruleid BIGINT(20) auto_increment primary key, 
	property_rule_title VARCHAR(255) , 
	property_rule VARCHAR(255) , 
	rule_icon VARCHAR(255) , 
	parentid INT default 0, 
	applytoroom TINYINT default 0, 
	input_type VARCHAR(255) default 'checkbox'
);
ALTER TABLE `Centurion_property_facilities` ADD input_type VARCHAR(255) default 'checkbox' AFTER applytoroom;
CREATE TABLE IF NOT EXISTS `Centurion_property_facilities` (
	property_facilityid BIGINT(20) auto_increment primary key, 
	facility VARCHAR(255) , 
	facility_icon VARCHAR(255) , 
	visible TINYINT default 1, 
	parentid INT default 0, 
	applytoroom TINYINT default 0, 
	input_type VARCHAR(255) default 'checkbox'
);
CREATE TABLE IF NOT EXISTS `Centurion_property_listing` (
	property_listingid BIGINT(20) auto_increment primary key
);
ALTER TABLE `Centurion_property_listing` ADD listing_information LONGTEXT AFTER property_listingid;
ALTER TABLE `Centurion_property_listing` ADD property_images LONGTEXT AFTER listing_information;
ALTER TABLE `Centurion_property_listing` ADD room_images LONGTEXT AFTER property_images;
ALTER TABLE `Centurion_property_listing` ADD userid BIGINT AFTER room_images;
ALTER TABLE `Centurion_property_listing` ADD dateadded TIMESTAMP default CURRENT_TIMESTAMP AFTER userid;
CREATE TABLE IF NOT EXISTS `Centurion_property_listing` (
	property_listingid BIGINT(20) auto_increment primary key, 
	listing_information LONGTEXT , 
	property_images LONGTEXT , 
	room_images LONGTEXT , 
	userid BIGINT , 
	dateadded TIMESTAMP default CURRENT_TIMESTAMP
);
ALTER TABLE `Centurion_property_listing` CHANGE COLUMN dateadded dateadded DATETIME default CURRENT_TIMESTAMP;
CREATE TABLE IF NOT EXISTS `Centurion_property_listing` (
	property_listingid BIGINT(20) auto_increment primary key, 
	listing_information LONGTEXT , 
	property_images LONGTEXT , 
	room_images LONGTEXT , 
	userid BIGINT , 
	dateadded DATETIME default CURRENT_TIMESTAMP
);
ALTER TABLE `Centurion_property_listing` CHANGE COLUMN listing_information listing_type VARCHAR(255) default 'property';
ALTER TABLE `Centurion_property_listing` CHANGE COLUMN property_images listing_information LONGTEXT;
ALTER TABLE `Centurion_property_listing` CHANGE COLUMN room_images listing_images LONGTEXT;
ALTER TABLE `Centurion_property_listing` CHANGE COLUMN userid room_images LONGTEXT;
ALTER TABLE `Centurion_property_listing` CHANGE COLUMN dateadded userid BIGINT;
ALTER TABLE `Centurion_property_listing` ADD dateadded DATETIME default CURRENT_TIMESTAMP AFTER userid;
CREATE TABLE IF NOT EXISTS `Centurion_property_listing` (
	property_listingid BIGINT(20) auto_increment primary key, 
	listing_type VARCHAR(255) default 'property', 
	listing_information LONGTEXT , 
	listing_images LONGTEXT , 
	room_images LONGTEXT , 
	userid BIGINT , 
	dateadded DATETIME default CURRENT_TIMESTAMP
);
CREATE TABLE IF NOT EXISTS `Centurion_partner_listing` (
	listingid BIGINT(20) auto_increment primary key, 
	listing_type VARCHAR(255) default 'property', 
	listing_information LONGTEXT , 
	listing_images LONGTEXT , 
	room_images LONGTEXT , 
	userid BIGINT , 
	dateadded DATETIME default CURRENT_TIMESTAMP
);
ALTER TABLE `Centurion_partner_listing` ADD approved TINYINT default 0 AFTER dateadded;
ALTER TABLE `Centurion_partner_listing` ADD action_note TEXT AFTER approved;
CREATE TABLE IF NOT EXISTS `Centurion_partner_listing` (
	listingid BIGINT(20) auto_increment primary key, 
	listing_type VARCHAR(255) default 'property', 
	listing_information LONGTEXT , 
	listing_images LONGTEXT , 
	room_images LONGTEXT , 
	userid BIGINT , 
	dateadded DATETIME default CURRENT_TIMESTAMP, 
	approved TINYINT default 0, 
	action_note TEXT
);
CREATE TABLE IF NOT EXISTS `Centurion_partner_bookings` (
	bookingid BIGINT(20) auto_increment primary key, 
	listingid BIGINT
);
ALTER TABLE `Centurion_partner_bookings` ADD views BIGINT default 0 AFTER listingid;
ALTER TABLE `Centurion_partner_bookings` ADD ratings DOUBLE default 0 AFTER views;
CREATE TABLE IF NOT EXISTS `Centurion_partner_bookings` (
	bookingid BIGINT(20) auto_increment primary key, 
	listingid BIGINT , 
	views BIGINT default 0, 
	ratings DOUBLE default 0
);
ALTER TABLE `Centurion_partner_bookings` ADD reviews BIGINT default 0 AFTER ratings;
CREATE TABLE IF NOT EXISTS `Centurion_partner_bookings` (
	bookingid BIGINT(20) auto_increment primary key, 
	listingid BIGINT , 
	views BIGINT default 0, 
	ratings DOUBLE default 0, 
	reviews BIGINT default 0
);
ALTER TABLE `Centurion_partner_listing` ADD cover_image VARCHAR(255) AFTER action_note;
CREATE TABLE IF NOT EXISTS `Centurion_partner_listing` (
	listingid BIGINT(20) auto_increment primary key, 
	listing_type VARCHAR(255) default 'property', 
	listing_information LONGTEXT , 
	listing_images LONGTEXT , 
	room_images LONGTEXT , 
	userid BIGINT , 
	dateadded DATETIME default CURRENT_TIMESTAMP, 
	approved TINYINT default 0, 
	action_note TEXT , 
	cover_image VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS `Centurion_userpermission` (
	userpermissionid BIGINT(20) auto_increment primary key, 
	userpermission VARCHAR(255) , 
	permission_info VARCHAR(255) , 
	executable_instruction TEXT
);
CREATE TABLE IF NOT EXISTS `Centurion_userroles` (
	userroleid BIGINT(20) auto_increment primary key, 
	userid BIGINT , 
	userrole VARCHAR(255) , 
	can_read INT default 1, 
	can_write INT default 0, 
	can_update INT default 0, 
	can_delete INT default 0, 
	generic_url VARCHAR(255) , 
	navigation_config LONGTEXT
);
ALTER TABLE `Centurion_userroles` CHANGE COLUMN userid userid BIGINT comment 'User ID of role creator. Should be partner id';
CREATE TABLE IF NOT EXISTS `Centurion_userroles` (
	userroleid BIGINT(20) auto_increment primary key, 
	userid BIGINT comment 'User ID of role creator. Should be partner id', 
	userrole VARCHAR(255) , 
	can_read INT default 1, 
	can_write INT default 0, 
	can_update INT default 0, 
	can_delete INT default 0, 
	generic_url VARCHAR(255) , 
	navigation_config LONGTEXT
);
ALTER TABLE `Centurion_userroles` ADD accountid INT default 0 AFTER navigation_config;
CREATE TABLE IF NOT EXISTS `Centurion_userroles` (
	userroleid BIGINT(20) auto_increment primary key, 
	userid BIGINT comment 'User ID of role creator. Should be partner id', 
	userrole VARCHAR(255) , 
	can_read INT default 1, 
	can_write INT default 0, 
	can_update INT default 0, 
	can_delete INT default 0, 
	generic_url VARCHAR(255) , 
	navigation_config LONGTEXT , 
	accountid INT default 0
);
ALTER TABLE `Centurion_userroles` CHANGE COLUMN navigation_config navigation_config LONGTEXT AFTER generic_url;
ALTER TABLE `Centurion_userroles` CHANGE COLUMN accountid accountid INT default 0 AFTER navigation_config;
ALTER TABLE `Centurion_userroles` DROP accountid;
CREATE TABLE IF NOT EXISTS `Centurion_userroles` (
	userroleid BIGINT(20) auto_increment primary key, 
	userid BIGINT comment 'User ID of role creator. Should be partner id', 
	userrole VARCHAR(255) , 
	can_read INT default 1, 
	can_write INT default 0, 
	can_update INT default 0, 
	can_delete INT default 0, 
	navigation_config LONGTEXT , 
	accountid INT default 0
);