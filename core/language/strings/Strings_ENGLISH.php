<?php
$strings = array(
	//General Strings in English (LOGIN_view, USER_EDIT_model, USER_model, connectDB_model)
	'' => 'Undefined Index',
	'good_insert' => 'Insert sucessfull',
	'user_exists' => 'User already exists in DataBase',
	'database_connection_failure' => 'It is not possible to connect to the database',
	'back' => 'Back',
	'database_consult_errors' => 'Database consult error',
	'deletion' => 'Deletion sucessful',
	'user_doesnt_exists' => 'User not exists',
	'user_modified' => 'User modified',
	'user_modified_error' => 'User\'s modification error',
	'pass' => 'Password',
	'pass_error' => 'Password does not match user entered',
	'users_date_birht' => 'User\'s birth date',
	'username' => 'User',
	'user' => 'User\'s name',
	'usersurname' => 'User\'s surname',
	'useremail' => 'User\'s email',
	'insert' => 'Insert',
	'modify' => 'Modify',
	'delete' => 'Delete',
	'consult' => 'Consult',
	'update' => 'Update',
	'pass_user_error' => 'Incorrect Password',
	'user_search_error' => 'User\'s Search Error',
	'empty_error' => 'Fields must not be empty',
	'user_modify' => 'Modify data about',
	'insert_error' => 'Insert Error',
	'database_access_error' => 'Database Access Error',

	/*USER_ADD_view, MANAGE_USER_view, ADMIN_view, USER_SEARCH_view,
	 USER_SHOW_view, USER_VIEW_view Strings */
	'student' => 'Student',
	'students' => 'Students',
	'list' => 'List',
	'filler' => 'Filler',
	'permissions' => 'Permissions',
	'actions' => 'Actions',
	'management_profiles' => 'Profiles Management',
	'management_permissions' => 'Permissions Management',
	'management_students' => 'Students Permissions',
	'users' => 'Users',
	'create_user' => 'Create User',
	'create_profile' => 'Create Profile',
	'create_controller' => 'Create Controller',
	'create_action' => 'Create Action',
    'create_permission' => 'Crear Permission',
	'management_user' => 'Management User',
	'dni' => 'DNI',
	'name' => 'Name',
	'surname' => 'Surname',
	'birthdate' => 'Birth date',
	'address' => 'Address',
	'email' => 'Email',
	'hour_in' => 'Hour of Entrance',
	'hour_out' => 'Hour of Exit',
	'bank_account' => 'Bank Acount',
	'usertype' => 'User Type',
	'admin' => 'Administrator',
	'instructor' => 'Instructor',
	'secretary' => 'Secretary',
	'other' => 'Other',
	'extra_hours' => 'Extra Hours',
	'contract_type' => 'Contratc Type',
	'employer_profile_photo' => 'Employer Profile Photo',
	'personal_comment' => 'Personal Comment',
	'user_find' => 'User Find',
	'find' => 'Find',
	'profile_type' =>'Profile Type',

	'user_profile' => 'User\'s Profile',
	'settings' => 'Settings',
	'close_session' => 'Close Session',
	'home' => 'Home',
	'calendar' => 'Calendar',
	'assist_control' => 'Assist Control',
	'management_info' => 'Management Info',
	'employer_data' => 'Employer Data',
	'up' => 'Up',
	'users_list' => 'Users List',
	'profile' => 'Profile',
	'rol' => 'Rol',
	'edit' => 'Edit',
	'all_alerts' => 'Show All Alerts',
	'user_info' => 'User Info',
    'action_info' => 'Action Info',
	'profile_info' => 'Profile Info',
	'controller_info' => 'Controller Info',
	//LOGIN_controller, USER_controller, logout Strings
	'error' => 'Error',
	'employer_not_exists' => 'Employer doesn\'t exists',
	'try_again' => 'Try Again',
	'add' => 'Add',
	'edit' => 'Edit',
	'show' => 'Show',
	'view' => 'View',
	'search' => 'Search',
	'action_not_especified' => 'Action not especified',
	'user_insert' => 'User Insert',
	'access_dc' => 'Access Database',
	'error_logout' => 'An error was happened and it is impossible to logout',
	'ACTION' => 'Actions',
	'CONTROLLER' => 'Controllers',
	'PERMISSION'=> 'Permissions',
	'PROFILE' => 'Profiles',
	'USER' => 'Users',
	'ADD' => 'Add',
	'DELETE' => 'Delete',
	'EDIT' => 'Edit',
	'VIEW' => 'View',
	'SHOW' => 'Show',
	'ACTIVITY' => 'Activities',
	'manage' => 'Manage',
	'clean' => 'Clean',
	'white' => 'Blanks in some field',
	'name' => 'Name',
	'edit_good' => 'Changes were succesfull',
	'edit_error' => 'Error á hora  de editar',
	'add_profile' => 'Add a New Profile',
	'edit_error' => 'Error on edit',
	'confirm_message' => 'Are you sure you want to delete  ',
	'deletion_error' => 'Deletion error',
	'controller_exists' => 'The controller exists in the DB',
	'succesfull_changes' => 'Changes in the right place',
	'cannot_delete_user' => 'You cannot delete this user',
	'cannot_modify_user' => 'You cannot modify this user',
	'assigned_action' => 'Assigned actions',
	'own_permis' => 'User\'s own permissions',
    'action_modify' => 'Action_Modify',
	'action_exists' => 'The chosen name already exists in the system',
	'newpass' => 'New_Password',
	'not_edit_perm' => 'Permissions for the selected profile can not be modified',
	'perm_over_controller' => 'Permissions on controller actions',
	'no_user_permissions' => 'This user doesn´t have permissions by himself',
	'no_profile_permissions' => 'This profile perfil doesn´t have permissions',
	'cancel'=>'Cancel',
	'user_data'=>'User data',
	'profile_perms' => 'Profile Permissions',
	'user_perms' => 'User Permissions',
	'controller_data'=>'Controller data',
	'profile_data'=>'Profile data',
	'controller_edit'=>'Edit controller',
	'no_profile' => "Without profile",

	/*NOTIFICACIÓNS*/

		/*SUCCES*/
		'succ_title'=>'Correct',
		'succ_login'=>'You are logged in!',
		'succ_user_add'=>'User properly created',
		'succ_user_delete'=>'User properly deleted',

		/*FAIL*/
		'fail_title'=>'Fail',
		'fail_user_exists'=>"User already exists",

		/*ERROR*/
		'erro_title'=>'Error',

		/*INFO*/
		'info_title'=>'Information'
)
?>
