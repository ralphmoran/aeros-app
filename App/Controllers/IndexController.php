<?php

namespace App\Controllers;

use App\Models\User;
use Aeros\Src\Classes\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        // Each controller can execute multiple actions upon request.
        // The constructor is called on any method/action, therefore, any logic
        // here will be executed.
        //
        // Example:
        //      - Extra request validation
        //      - Logging action call
        //      - Formatting data
        //      - Validating if user is logged in
        //      - Cheking user roles
        //      - Checking if user has access to the current section
        // logger('From inside: ' . __CLASS__, app()->basedir . '/logs/error.log');

        // Call parent::__construct() method if needed
        // parent::__construct();
    }

    public function index()
    {
        //******************************************/
        // Relationships: hasMany and hasOne. See App\Models\User for more information
        // dd(User::find(1)->roles());

        //******************************************/
        // Add new headers to the response
        // This new header will be added to the final response
        // response()->addHeaders(['www-Cache-Control' => 'max-age=3600']);

        // The default headers will not be deleted
        // response()->removeHeaders(['www-Cache-Control', 'Date', 'Expires']); 

        //******************************************/
        // Session. See Aeros\Src\Classes\Session class

        // Starts a new session
        // session()->start();

        // Setting variables into $_SESSION
        // session()->test = 111;

        // isset(session()->test); // Checks if 'test' exists in $_SESSION
        // unset(session()->test2); // Removes a variable from $_SESSION

        // Destroys or renovates session
        // session()->renovate(); // Destroys, unsets and renovates session ID

        //******************************************/
        // Setting a cookie to expire in a minute and be visible in all subdomains
        // If there is no protocol (http or https) and no subdomain (www or any other), by defualt, 
        // the cookie will be available for all subdomains
        // cookie('test_cookie_3', 111, time() + 60, '/', 'aeros.test');

        // dd(cookie('test_cookie_3'));

        // Get a cookie by name
        // dd(cookie('test_cookie'));

        // Delete a cookie by name
        // dd(cookie()->delete('test_cookie'));

        // cookie()->clear();
        // dd(cookie('test_cookie'));

        //******************************************/
        // Calls  directly the worker
        // app()->worker->call(\App\Queues\Workers\NewLogicWorker::class);

        // Same funcionality as above
        // (new \App\Queues\Workers\NewLogicWorker)->handle();

        // Starts an infinite loop for this worker
        // (new \App\Queues\Workers\NewLogicWorker)->start();

        //******************************************/
        // Note: All pipelines are prepended with "env('APP_NAME') . '_'" string
        // queue()->push([
        //     \App\Queues\Jobs\CleanupJob::class,
        //     \App\Queues\Jobs\SendEmailsJob::class,
        //     \App\Queues\Jobs\DatabaseCleanupJob::class,
        //     \App\Queues\Jobs\WebhookCallsJob::class,
        //     \App\Queues\Jobs\ProcessImagesJob::class,
        // ]);

        // dd(queue()->getJobStatus());

        //******************************************/
        // Get all job statuses
        // queue()->getJobStatus();

        //******************************************/
        // Gets only job status from failed state
        // queue()->getJobStatus(Queue::FAILED_STATE);

        //******************************************/
        // Gets only job status from completed state
        // queue()->getJobStatus(Queue::COMPLETED_STATE);

        //******************************************/
        // Clears all job statuses.
        // queue()->clearJobStatus();

        //******************************************/
        // Clears only job status in failed state
        // queue()->clearJobStatus(Queue::FAILED_STATE);

        // Clears only job status in completed state
        // queue()->clearJobStatus(Queue::COMPLETED_STATE);

        //******************************************/
        // Using a specific pipeline name
        // queue()->push(
        //     [
        //         \App\Queues\Jobs\CleanupJob::class,
        //         \App\Queues\Jobs\SendEmailsJob::class,
        //         \App\Queues\Jobs\DatabaseCleanupJob::class,
        //         \App\Queues\Jobs\WebhookCallsJob::class,
        //         \App\Queues\Jobs\ProcessImagesJob::class,
        //     ],
        //     'custom_pipeline'
        // );

        //******************************************/
        // queue()->processPipeline('custom_pipeline');

        //******************************************/
        // Make a GET request
        // request()->get(['https://reqres.in/api/users/2')->send();

        //******************************************/
        // Add event listener for email notification
        // app()->event
            // ->addEventListener('email.reminder', \App\Events\EmailReminderEvent::class)
            // ->addEventListener('email.followup', \App\Events\EmailFollowupEvent::class);

        // app()->event
        //     ->addEventListener('email.notify', \App\Events\EmailNotifierEvent::class);

        // This event is triggered on http://admin.aeros.test. See "AppController::index".

        //******************************************/
        // Create projects table. You must use "exec" method for these type of queries
        // $stm = db()->exec('CREATE TABLE IF NOT EXISTS users (
        //         id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
        //         username TEXT NOT NULL,
        //         fname TEXT NOT NULL,
        //         lname TEXT NOT NULL,
        //         role INT NOT NULL)');

        // dd(get_class($stm));

        //******************************************/
        // Inserting rows
        // $stm = db()->prepare('INSERT INTO projects (project_id, project_name) VALUES(?, ?)')
        //     ->execute([
        //         mt_rand(1, 1000), 
        //         'Rafael'
        //     ]);

        // dd($stm->rowCount()); // Returns the number of inserted records

        //******************************************/
        // Fetching data with named placeholders
        // dd(db()->prepare("SELECT * FROM projects WHERE project_id = :id")
        //     ->execute([
        //         'id' => 439
        //     ])
        //     ->fetchAll()
        // );

        //******************************************/
        // Bring multiple records with placeholders (associative array)
        // dd(db()->prepare("SELECT * FROM users WHERE id = ?")
        //     ->execute([1])
        //     ->fetchAll()
        // );

        //******************************************/
        // NOTE: When working with models, it is IMPERATIVE that related tables have an "id" column
        //       as primary key and auto-increment properties

        // Multiple inserts
        // $users = [
        //     [
        //         'username' => 'username' . rand(1, 10),
        //         'fname' => 'fname' . rand(1, 10),
        //         'lname' => 'lname' . rand(1, 10),
        //     ],
        //     [
        //         'username' => 'username' . rand(1, 10),
        //         'fname' => 'fname' . rand(1, 10),
        //         'lname' => 'lname' . rand(1, 10),
        //     ],
        //     [
        //         'username' => 'username' . rand(1, 10),
        //         'fname' => 'fname' . rand(1, 10),
        //         'lname' => 'lname' . rand(1, 10),
        //     ],
        //     [
        //         'username' => 'username' . rand(1, 10),
        //         'fname' => 'fname' . rand(1, 10),
        //         'lname' => 'lname' . rand(1, 10),
        //     ],
        // ];

        // $stm = db()->prepare("INSERT INTO users (username, fname, lname) VALUES (:username, :fname, :lname)");

        // db()->beginTransaction();
        
        // foreach ($users as $user) {
        //     $stm->execute($user);
        //     // $stm->lastInsertId(); // It gives you the last inserted ID
        // }
        
        // db()->commit();

        //******************************************/
        // Or, use User::createMany($users) instead. 
        // It will return a list of recent inserted records as User objects
        // $newUsers = User::createMany($users);

        // dd('Create action', $newUsers);

        //******************************************/
        // Create a new User model
        // $newUser = User::create([
        //     // 'id' => 12, // Primary key cannot be modified
        //     'date' => 'New user', // It does not exist. It will be ignored
        //     'username' => 'username',
        //     'fname' => 'fname',
        //     'lname' => 'lname', // If this column is guarded, it will be ignored
        //     'role' => 0, // If this column is guarded, it will be ignored
        // ]);

        // dd($newUser);

        //******************************************/
        // Find only one user
        // $user = User::find(1);

        //******************************************/
        // Get a list of users. Pay attention to this format, it will return an array of user objects.
        // $user = User::find([
        //     ['id', '=', 1, 'OR'],
        //     // ['username', '<>', 'Rafael'],
        // ]);

        //******************************************/
        // Delete a user
        // $user->delete()->commit();

        // Delete many at once
        // User::delete([
        //     ['id', '>=', 2],
        //     ['id', '<=', 4],
        // ])->commit();

        // dd('Delete action');

        //******************************************/
        // Update one property
        // $user->username = 'Here was Natalia - ' . rand(1, 99);
        // $user->another = 'aa'; // "another" property does not exist in the users table
        // $user->lname = 'Guarded' . rand(1, 99); // It throws an error. This column is guarded
        // $user->save();

        //******************************************/
        // Update many properties at once
        // $user->update([
        //     'username' => 'Last update',
        //     'fname' => 'Last update',
        //     'lname' => 'Last update',
        // ])->commit();

        // Update many properties on many records at once
        // $stm = User::update([
        //         'username' => '@@@username111',
        //         'fname' => '@@@fname111',
        //         'lname' => '@@@lname111',
        //     ],
        //     [
        //         ['id', '>=', 3],
        //         ['id', '<=', 5],
        //     ]
        // )->commit();

        // dd('Update many', $stm);

        // dd($user);

        //******************************************/
        // Add roles
        // $stm = db()->exec('CREATE TABLE IF NOT EXISTS roles (
        //         id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
        //         role INT NOT NULL,
        //         title TEXT NOT NULL,
        //         description TEXT NOT NULL)');

        // $role = \Aeros\Src\Classes\Role::create([
        //     'role' => 8,
        //     'title' => 'Guest',
        //     'description' => 'Guest user',
        // ]);

        // $user = User::find(1);
        // $super = Role::find(1);
        // $guest = Role::find([
        //     ['role', '=', 16]
        // ]);

        // $user->addRole($super);
        // $user->addRole($guest);
        // $user->removeRole($super);

        // $user->save();

        // dd($user);

        //******************************************/
        // Sending emails
        // app()->email->SMTPDebug = \PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        // app()->email->isSMTP();                                            //Send using SMTP
        // app()->email->Host       = env('SMTP_HOST');                     //Set the SMTP server to send through
        // app()->email->SMTPAuth   = true;                                   //Enable SMTP authentication
        // app()->email->Username   = env('SMTP_USERNAME');                     //SMTP username
        // Setting up an app password for GMail accounts: https://www.youtube.com/watch?v=sCsMfLf1MTg
        // app()->email->Password   = env('SMTP_PASSWORD');                               //SMTP password
        // app()->email->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        // app()->email->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // Recipients
        // app()->email->setFrom('ralphmoran2003@gmail.com', 'Mailer');
        // app()->email->addAddress('ralph@myaero.app', 'Rafael');     //Add a recipient
        // app()->email->addAddress('ralphmoran2003@gmail.com', 'Rafael');     //Add a recipient
        // app()->email->addAddress('ellen@example.com');               //Name is optional
        // app()->email->addReplyTo('info@example.com', 'Information');
        // app()->email->addCC('cc@example.com');
        // app()->email->addBCC('bcc@example.com');

        // Attachments
        // app()->email->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // app()->email->addAttachment(app()->basedir . '/logs/cron.log', 'Cron log');    //Optional name

        // Content
        // app()->email->isHTML(true);                                  //Set email format to HTML
        // app()->email->Subject = 'Here is the subject';
        // app()->email->Body    = 'This is the HTML message body <b>in bold!</b>';
        // app()->email->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // app()->email->send();

        // dd(
        //     request()
        //     ->post('http://advlnx3.adventresources.com/mvc.php/Sale/econtract-validation-history/get-list')
        //     ->cookies(
        //         array(
        //             "PHPSESSID" => $auth['data']['session_id']
        //         )
        //     )
        //     ->setPayload(
        //         array('deal_number' => 163891)
        //     )
        //     ->ssl(false)
        //     ->send()
        // );

        // dd(request()->get('https://reqres.in/api/users/3')->ssl(false)->send());
        // dd(request()->get('https://reqres.in/api/users/3')->send());

        return view('index');
    }

    public function list(int $userid)
    {
        return view('index', ['userid' => $userid]);
    }

    public function showProfile()
    {
        return view('pictures');
    }

    public function anotherProfile()
    {
        return 'Another Profile';
    }

    public function validatedCSRFToken()
    {
        // CSRF token was validated correctly
        return 'All good with CSRF token';
    }
}
