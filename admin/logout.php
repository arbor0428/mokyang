<?
session_start();

session_unregister("ses_member_id");
session_unregister("ses_member_name");
session_unregister("ses_member_type");
session_unregister("admin_userid");
session_unregister("admin_name");

header("Location:/");
?>

