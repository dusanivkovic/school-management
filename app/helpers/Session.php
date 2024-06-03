<?php
namespace app\helpers;

const FLASH = 'FLASH_MESSAGES';
const FLASH_ERROR = 'danger';
const FLASH_WARNING = 'warning';
const FLASH_INFO = 'info';
const FLASH_SUCCESS = 'success';

class Session 
{
    public static function init():void
    {
        !isset($_SESSION) ? session_start() : '';
    }

    public static function set($key, $val):void
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_destroy();
        session_unset();
    }

    public static function isLoggedIn ()
    {
        return self::get('user') ?? null;
    }

    public static function requireLogin ()
    {
        if (!self::isLoggedIn())
        {
            self::redirect('./error_page.php');
            exit;
        }
    }

    public static function redirect ($location)
    {
        header("location: {$location}");
        // exit();
    }

    public static function create_flash_message(string $name, string $message, string $type): void
    {
        // remove existing message with the name
        if (isset($_SESSION[FLASH][$name])) {
            unset($_SESSION[FLASH][$name]);
        }
        // add the message to the session
        $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];   

    }

    public static function format_flash_message(array $flash_message): string
    {
        return sprintf('<div class="alert alert-%s">%s</div>',
        $flash_message['type'],
        $flash_message['message']
        );
    }


    public static function display_flash_message(string $name): void
    {
        if (!isset($_SESSION[FLASH][$name])) {
            return;
        }

        // get message from the session
        $flash_message = $_SESSION[FLASH][$name];

        // delete the flash message
        unset($_SESSION[FLASH][$name]);

        // display the flash message
        echo self::format_flash_message($flash_message);
    }
    
    public static function display_all_flash_messages(): void
    {
        if (!isset($_SESSION[FLASH])) {
            return;
        }
    
        // get flash messages
        $flash_messages = $_SESSION[FLASH];
    
        // remove all the flash messages
        unset($_SESSION[FLASH]);
    
        // show all flash messages
        foreach ($flash_messages as $flash_message) {
            echo self::format_flash_message($flash_message);
        }
    }

    public static function flash(string $name = '', string $message = '', string $type = ''): void
    {
        if ($name !== '' && $message !== '' && $type !== '') {
            self::create_flash_message($name, $message, $type);
        } elseif ($name !== '' && $message === '' && $type === '') {
            self::display_flash_message($name);
        } elseif ($name === '' && $message === '' && $type === '') {
            self::display_all_flash_messages();
        }
    }

    public static function prntR ($attribute)
    {
        echo '<pre>';
        print_r($attribute) ;
        echo '</pre>';
    }
}