#
# Table structure for table 'tx_itmedia2_domain_model_company'
#
CREATE TABLE tx_itmedia2_domain_model_company (
	company varchar(255) DEFAULT '' NOT NULL,
	path_segment varchar(2048) DEFAULT '' NOT NULL,
	logo int(11) unsigned DEFAULT '0' NOT NULL,
	images int(11) unsigned DEFAULT '0' NOT NULL,
	image_maps int(11) unsigned DEFAULT '0' NOT NULL,
	street varchar(255) DEFAULT '' NOT NULL,
	house_number varchar(255) DEFAULT '' NOT NULL,
	zip varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	telephone varchar(255) DEFAULT '' NOT NULL,
	fax varchar(255) DEFAULT '' NOT NULL,
	contact_person varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	website varchar(255) DEFAULT '' NOT NULL,
	opening_times text NOT NULL,
	barrier_free tinyint(1) unsigned DEFAULT '0' NOT NULL,
	description text NOT NULL,
	district int(11) unsigned DEFAULT '0',
	floors text,
	position int(11) unsigned DEFAULT '0' NOT NULL,
	main_trade int(11) unsigned DEFAULT '0' NOT NULL,
	trades int(11) unsigned DEFAULT '0' NOT NULL,
	facebook varchar(255) DEFAULT '' NOT NULL,
	twitter varchar(255) DEFAULT '' NOT NULL,
	google varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tx_itmedia2_domain_model_position'
#
CREATE TABLE tx_itmedia2_domain_model_position (
	title varchar(60) DEFAULT '' NOT NULL
);

#
# Table structure for table 'tx_itmedia2_domain_model_floor'
#
CREATE TABLE tx_itmedia2_domain_model_floor
(
	name varchar(255) DEFAULT ''  NOT NULL
);
