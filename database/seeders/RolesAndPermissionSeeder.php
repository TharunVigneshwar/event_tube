<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\User;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Videos
        Permission::create(['name' => PermissionEnum::VIEW_ANY_VIDEOS]);
        Permission::create(['name' => PermissionEnum::VIEW_VIDEOS]);
        Permission::create(['name' => PermissionEnum::CREATE_VIDEOS]);
        Permission::create(['name' => PermissionEnum::UPDATE_VIDEOS]);
        Permission::create(['name' => PermissionEnum::DELETE_VIDEOS]);
        Permission::create(['name' => PermissionEnum::RESTORE_VIDEOS]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_VIDEOS]);
        // likes
        Permission::create(['name' => PermissionEnum::VIEW_ANY_LIKES]);
        Permission::create(['name' => PermissionEnum::VIEW_LIKES]);
        Permission::create(['name' => PermissionEnum::CREATE_LIKES]);
        Permission::create(['name' => PermissionEnum::UPDATE_LIKES]);
        Permission::create(['name' => PermissionEnum::DELETE_LIKES]);
        Permission::create(['name' => PermissionEnum::RESTORE_LIKES]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_LIKES]);

        // views
        Permission::create(['name' => PermissionEnum::VIEW_ANY_VIEWS]);
        Permission::create(['name' => PermissionEnum::VIEW_VIEWS]);
        Permission::create(['name' => PermissionEnum::CREATE_VIEWS]);
        Permission::create(['name' => PermissionEnum::UPDATE_VIEWS]);
        Permission::create(['name' => PermissionEnum::DELETE_VIEWS]);
        Permission::create(['name' => PermissionEnum::RESTORE_VIEWS]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_VIEWS]);

        // events
        Permission::create(['name' => PermissionEnum::VIEW_ANY_EVENTS]);
        Permission::create(['name' => PermissionEnum::VIEW_EVENTS]);
        Permission::create(['name' => PermissionEnum::CREATE_EVENTS]);
        Permission::create(['name' => PermissionEnum::UPDATE_EVENTS]);
        Permission::create(['name' => PermissionEnum::DELETE_EVENTS]);
        Permission::create(['name' => PermissionEnum::RESTORE_EVENTS]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_EVENTS]);
        // users
        Permission::create(['name' => PermissionEnum::VIEW_ANY_USERS]);
        Permission::create(['name' => PermissionEnum::VIEW_USERS]);
        Permission::create(['name' => PermissionEnum::CREATE_USERS]);
        Permission::create(['name' => PermissionEnum::UPDATE_USERS]);
        Permission::create(['name' => PermissionEnum::DELETE_USERS]);
        Permission::create(['name' => PermissionEnum::RESTORE_USERS]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_USERS]);
        // roles
        Permission::create(['name' => PermissionEnum::VIEW_ANY_ROLES]);
        Permission::create(['name' => PermissionEnum::VIEW_ROLES]);
        Permission::create(['name' => PermissionEnum::CREATE_ROLES]);
        Permission::create(['name' => PermissionEnum::UPDATE_ROLES]);
        Permission::create(['name' => PermissionEnum::DELETE_ROLES]);
        Permission::create(['name' => PermissionEnum::RESTORE_ROLES]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_ROLES]);
        // permissions
        Permission::create(['name' => PermissionEnum::VIEW_ANY_PERMISSIONS]);
        Permission::create(['name' => PermissionEnum::VIEW_PERMISSIONS]);
        Permission::create(['name' => PermissionEnum::CREATE_PERMISSIONS]);
        Permission::create(['name' => PermissionEnum::UPDATE_PERMISSIONS]);
        Permission::create(['name' => PermissionEnum::DELETE_PERMISSIONS]);
        Permission::create(['name' => PermissionEnum::RESTORE_PERMISSIONS]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_PERMISSIONS]);

        //Event Subscription
        Permission::create(['name' => PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS]);
        Permission::create(['name' => PermissionEnum::VIEW_EVENT_SUBSCRIPTIONS]);
        Permission::create(['name' => PermissionEnum::CREATE_EVENT_SUBSCRIPTIONS]);
        Permission::create(['name' => PermissionEnum::UPDATE_EVENT_SUBSCRIPTIONS]);
        Permission::create(['name' => PermissionEnum::DELETE_EVENT_SUBSCRIPTIONS]);
        Permission::create(['name' => PermissionEnum::RESTORE_EVENT_SUBSCRIPTIONS]);
        Permission::create(['name' => PermissionEnum::FORCE_DELETE_EVENT_SUBSCRIPTIONS]);

        $this->command->info('Permissions created successfully.');

        // User role

        $user_user_role = Role::create(['name' => RolesEnum::USER_USER]);
        $user_user_role->givePermissionTo([
            PermissionEnum::VIEW_ANY_USERS,
            PermissionEnum::VIEW_USERS,
            PermissionEnum::CREATE_USERS,
        ]);

        $this->command->info('User User Role created successfully.');

        $user_managr_role = Role::create(['name' => RolesEnum::USER_MANAGER]);
        $user_managr_role->givePermissionTo([
            PermissionEnum::VIEW_ANY_USERS,
            PermissionEnum::VIEW_USERS,
            PermissionEnum::CREATE_USERS,
            PermissionEnum::UPDATE_USERS,
        ]);

        $this->command->info('User Manager created successfully.');

        $user_admin_role = Role::create(['name' => RolesEnum::USER_ADMIN]);
        $user_admin_role->givePermissionTo([
            PermissionEnum::VIEW_ANY_USERS,
            PermissionEnum::VIEW_USERS,
            PermissionEnum::CREATE_USERS,
            PermissionEnum::UPDATE_USERS,
            PermissionEnum::DELETE_USERS,
        ]);

        $this->command->info('User Adamin created successfully.');

        // Role role

        $role_user = Role::create(['name' => RolesEnum::ROLE_USER]);
        $role_user->givePermissionTo([
            PermissionEnum::VIEW_ANY_ROLES,
            PermissionEnum::VIEW_ROLES,
            PermissionEnum::CREATE_ROLES,
        ]);

        $this->command->info('Role Manager Role created successfully.');

        $role_manager = Role::create(['name' => RolesEnum::ROLE_MANAGER]);
        $role_manager->givePermissionTo([
            PermissionEnum::VIEW_ANY_ROLES,
            PermissionEnum::VIEW_ROLES,
            PermissionEnum::CREATE_ROLES,
            PermissionEnum::UPDATE_ROLES,
        ]);

        $this->command->info('Role Manager Role created successfully.');

        $role_admin = Role::create(['name' => RolesEnum::ROLE_ADMIN]);
        $role_admin->givePermissionTo([
            PermissionEnum::VIEW_ANY_ROLES,
            PermissionEnum::VIEW_ROLES,
            PermissionEnum::CREATE_ROLES,
            PermissionEnum::UPDATE_ROLES,
            PermissionEnum::DELETE_ROLES,
        ]);

        $this->command->info('Role Admin Role created successfully.');

        // Permission role

        $permission_user = Role::create(['name' => RolesEnum::PERMISSION_USER]);
        $permission_user->givePermissionTo([
            PermissionEnum::VIEW_ANY_PERMISSIONS,
            PermissionEnum::VIEW_PERMISSIONS,
            PermissionEnum::CREATE_PERMISSIONS,
        ]);

        $this->command->info('Permission User Role created successfully.');

        $permission_manager = Role::create(['name' => RolesEnum::PERMISSION_MANAGER]);
        $permission_manager->givePermissionTo([
            PermissionEnum::VIEW_ANY_PERMISSIONS,
            PermissionEnum::VIEW_PERMISSIONS,
            PermissionEnum::CREATE_PERMISSIONS,
            PermissionEnum::UPDATE_PERMISSIONS,
        ]);

        $this->command->info('Permission Manager Role created successfully.');

        $permission_admin = Role::create(['name' => RolesEnum::PERMISSION_ADMIN]);
        $permission_admin->givePermissionTo([
            PermissionEnum::VIEW_ANY_PERMISSIONS,
            PermissionEnum::VIEW_PERMISSIONS,
            PermissionEnum::CREATE_PERMISSIONS,
            PermissionEnum::UPDATE_PERMISSIONS,
            PermissionEnum::DELETE_PERMISSIONS,
        ]);

        $this->command->info('Permission Admin Role created successfully.');

        // Video role

        $video_user = Role::create(['name' => RolesEnum::VIDEO_USER]);
        $video_user->givePermissionTo([
            PermissionEnum::VIEW_ANY_VIDEOS,
            PermissionEnum::VIEW_VIDEOS,
            PermissionEnum::CREATE_VIDEOS,
        ]);

        $this->command->info('Video User Role created successfully.');

        $video_manager = Role::create(['name' => RolesEnum::VIDEO_MANAGER]);
        $video_manager->givePermissionTo([
            PermissionEnum::VIEW_ANY_VIDEOS,
            PermissionEnum::VIEW_VIDEOS,
            PermissionEnum::CREATE_VIDEOS,
            PermissionEnum::UPDATE_VIDEOS,
        ]);

        $this->command->info('Video Manager Role created successfully.');

        $video_admin = Role::create(['name' => RolesEnum::VIDEO_ADMIN]);
        $video_admin->givePermissionTo([
            PermissionEnum::VIEW_ANY_VIDEOS,
            PermissionEnum::VIEW_VIDEOS,
            PermissionEnum::CREATE_VIDEOS,
            PermissionEnum::UPDATE_VIDEOS,
            PermissionEnum::DELETE_VIDEOS,
        ]);

        $this->command->info('Video Admin Role created successfully.');

        // Like role

        $like_user = Role::create(['name' => RolesEnum::LIKE_USER]);
        $like_user->givePermissionTo([
            PermissionEnum::VIEW_ANY_LIKES,
            PermissionEnum::VIEW_LIKES,
            PermissionEnum::CREATE_LIKES,
        ]);

        $this->command->info('Like User Role created successfully.');

        $like_manager = Role::create(['name' => RolesEnum::LIKE_MANAGER]);
        $like_manager->givePermissionTo([
            PermissionEnum::VIEW_ANY_LIKES,
            PermissionEnum::VIEW_LIKES,
            PermissionEnum::CREATE_LIKES,
            PermissionEnum::UPDATE_LIKES,
        ]);

        $this->command->info('Like Manager Role created successfully.');

        $like_admin = Role::create(['name' => RolesEnum::LIKE_ADMIN]);
        $like_admin->givePermissionTo([
            PermissionEnum::VIEW_ANY_LIKES,
            PermissionEnum::VIEW_LIKES,
            PermissionEnum::CREATE_LIKES,
            PermissionEnum::UPDATE_LIKES,
            PermissionEnum::DELETE_LIKES,
        ]);

        $this->command->info('Like Admin Role created successfully.');

        // View role

        $view_user = Role::create(['name' => RolesEnum::VIEW_USER]);
        $view_user->givePermissionTo([
            PermissionEnum::VIEW_ANY_VIEWS,
            PermissionEnum::VIEW_VIEWS,
            PermissionEnum::CREATE_VIEWS,
        ]);

        $this->command->info('View User Role created successfully.');

        $view_manager = Role::create(['name' => RolesEnum::VIEW_MANAGER]);
        $view_manager->givePermissionTo([
            PermissionEnum::VIEW_ANY_VIEWS,
            PermissionEnum::VIEW_VIEWS,
            PermissionEnum::CREATE_VIEWS,
            PermissionEnum::UPDATE_VIEWS,
        ]);

        $this->command->info('View Manager Role created successfully.');

        $view_admin = Role::create(['name' => RolesEnum::VIEW_ADMIN]);
        $view_admin->givePermissionTo([
            PermissionEnum::VIEW_ANY_VIEWS,
            PermissionEnum::VIEW_VIEWS,
            PermissionEnum::CREATE_VIEWS,
            PermissionEnum::UPDATE_VIEWS,
            PermissionEnum::DELETE_VIEWS,
        ]);

        $this->command->info('View Admin Role created successfully.');

        // Event role

        $event_user = Role::create(['name' => RolesEnum::EVENT_USER]);
        $event_user->givePermissionTo([
            PermissionEnum::VIEW_ANY_EVENTS,
            PermissionEnum::VIEW_EVENTS,
            PermissionEnum::CREATE_EVENTS,
        ]);

        $this->command->info('Event User Role created successfully.');

        $event_manager = Role::create(['name' => RolesEnum::EVENT_MANAGER]);
        $event_manager->givePermissionTo([
            PermissionEnum::VIEW_ANY_EVENTS,
            PermissionEnum::VIEW_EVENTS,
            PermissionEnum::CREATE_EVENTS,
            PermissionEnum::UPDATE_EVENTS,
        ]);

        $this->command->info('Event Manager Role created successfully.');

        $event_admin = Role::create(['name' => RolesEnum::EVENT_ADMIN]);
        $event_admin->givePermissionTo([
            PermissionEnum::VIEW_ANY_EVENTS,
            PermissionEnum::VIEW_EVENTS,
            PermissionEnum::CREATE_EVENTS,
            PermissionEnum::UPDATE_EVENTS,
            PermissionEnum::DELETE_EVENTS,
        ]);

        $this->command->info('Event Admin Role created successfully.');

        // Event_subscription

        $Event_subscription_user = Role::create(['name' => RolesEnum::EVENT_SUBSCRIPTION_USER]);
        $Event_subscription_user->givePermissionTo([
            PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS,
            PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS,
            PermissionEnum::CREATE_EVENT_SUBSCRIPTIONS,
        ]);

        $this->command->info('Event_subscription User Role created successfully.');

        $Event_subscription_manager = Role::create(['name' => RolesEnum::EVENT_SUBSCRIPTION_MANAGER]);
        $Event_subscription_manager->givePermissionTo([
            PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS,
            PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS,
            PermissionEnum::CREATE_EVENT_SUBSCRIPTIONS,
            PermissionEnum::UPDATE_EVENT_SUBSCRIPTIONS,
        ]);

        $this->command->info('Event_subscription Manager Role created successfully.');

        $Event_subscription_admin = Role::create(['name' => RolesEnum::EVENT_SUBSCRIPTION_ADMIN]);
        $Event_subscription_admin->givePermissionTo([
            PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS,
            PermissionEnum::VIEW_ANY_EVENT_SUBSCRIPTIONS,
            PermissionEnum::CREATE_EVENT_SUBSCRIPTIONS,
            PermissionEnum::UPDATE_EVENT_SUBSCRIPTIONS,
            PermissionEnum::DELETE_EVENT_SUBSCRIPTIONS,
        ]);

        $this->command->info('Event_subscription Admin Role created successfully.');

        // Super Admin role
        Role::create(['name' => RolesEnum::SUPER_ADMIN]);
        $this->command->info('Super Admin Role created successfully.');

        // Student role
        $student = Role::create(['name' => RolesEnum::STUDENT]);
        $student->givePermissionTo([
            PermissionEnum::VIEW_ANY_VIDEOS,
            PermissionEnum::VIEW_VIDEOS,
            PermissionEnum::CREATE_VIDEOS,
            PermissionEnum::VIEW_ANY_EVENTS,
            PermissionEnum::VIEW_EVENTS,
        ]);
        $this->command->info('Student Role created successfully.');

        // Faculty role
        $faculty = Role::create(['name' => RolesEnum::FACULTY]);
        $faculty->givePermissionTo([
            PermissionEnum::VIEW_ANY_EVENTS,
            PermissionEnum::VIEW_EVENTS,
        ]);
        $this->command->info('Faculty Role created successfully.');

	$super_admin_user = User::create([
		'name' => RolesEnum::SUPER_ADMIN,
		'email' => 'tharunoffical99@gmail.com',
		'password' => bcrypt('Tharun@123'),
	]);

	$super_admin_user->assignRole(RolesEnum::SUPER_ADMIN);


    }
}
