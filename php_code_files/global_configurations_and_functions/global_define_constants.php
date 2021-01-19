<?php 
// Turn off all error reporting
//error_reporting(0);



// Reporting E_NOTICE can be good too (to report uninitialized
// variables or catch variable name misspellings ...)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
define("STANDARD_DATE_FORMAT","d/m/Y");



define("USERS_FILE_UPLOAD_PATH","user_uploads/files/");

define("USERS_FILE_UPLOAD_PATH_PICTURE_GALLERY","user_uploads/files/pic_gallery_images/");
define("VIEW_USERS_FILE_UPLOAD_PATH_PICTURE_GALLERY","user_uploads/files/pic_gallery_images/");

define("USERS_FILE_UPLOAD_PATH_FILE_SHARING","user_uploads/files/file_sharing/");
define("VIEW_USERS_FILE_UPLOAD_PATH_FILE_SHARING","user_uploads/files/file_sharing/");


define("USERS_FILE_UPLOAD_PATH_TICKET_ATTACHEMENTS","user_uploads/files/ticket_attachements/");
define("VIEW_USERS_FILE_UPLOAD_PATH_TICKET_ATTACHEMENTS","user_uploads/files/ticket_attachements/");


define("USERS_FILE_UPLOAD_PATH_EMS","user_uploads/files/ems/");
define("VIEW_USERS_FILE_UPLOAD_PATH_EMS","user_uploads/files/ems/");

define("USERS_FILE_UPLOAD_PATH_ERP_CUSTOMERS","/user_uploads/files/erp_customers/");
define("VIEW_USERS_FILE_UPLOAD_PATH_ERP_CUSTOMERS","user_uploads/files/erp_customers/");

define("USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH","user_uploads/profiles/");
define("VIEW_USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH","user_uploads/profiles/");

define("USERS_JOB_SEEKER_RESUME_UPLOAD_PATH","user_uploads/profiles/resumes/");
define("VIEW_USERS_JOB_SEEKER_RESUME_UPLOAD_PATH","user_uploads/profiles/resumes/");

define("USERS_ADS_UPLOAD_PATH","user_uploads/files/ads_images/");
define("VIEW_USERS_ADS_UPLOAD_PATH","user_uploads/files/ads_images/");

define("USERS_CAREERS_UPLOAD_PATH","user_uploads/files/careers/");
define("VIEW_USERS_CAREERS_UPLOAD_PATH","user_uploads/files/careers/");


define("USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH","../user_uploads/files/deals_virtual_store_images/");
define("VIEW_USERS_ITEMS_STORE_AND_DEALS_UPLOAD_PATH","user_uploads/files/deals_virtual_store_images/");

define("USERS_ITEMS_STORE_CATEGORY_UPLOAD_PATH","../user_uploads/files/deals_virtual_store_images/category_icons/");
define("VIEW_USERS_ITEMS_STORE_CATEGORY_UPLOAD_PATH","user_uploads/files/deals_virtual_store_images/category_icons/");

?>