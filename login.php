<?php
/*
 * Template Name: Login Page
 *
 */
// Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();}
if (is_user_logged_in()) :
wp_redirect( esc_url(site_url()) ); exit(); 
endif;

global $user_login;
global $bella_options;
$creds = array();
$username = null;
$password = null;
$display_error = null;
if(isset($_POST["username"]) && isset($_POST["password"])){
$username = $_POST["username"];
$password = $_POST["password"];

$creds['user_login'] = $username;
$creds['user_password'] = $password;
$creds['remember'] = true;

$user = wp_signon( $creds, false );
if (is_wp_error($user))
{
    foreach ($user->errors as $error) {
         $display_error=$error[0];
     } 
}
else
{
    wp_redirect( esc_url(site_url()) ); exit(); 
}
}
?>    
<?php get_header(); ?>   

   <section class="page-section color">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="block-title"><span><?php _e('Login','bella')?></span></h3>
                        <?php if($display_error!=null): echo '<div class="alert alert-danger"'.$display_error.'</div><hr>'; endif;?>
                       <form  method="POST" class="form-login">
                            <div class="row">
                                <div class="col-md-12 hello-text-wrap">
                                    <span class="hello-text text-thin"><?php _e('Hello, welcome to your account','bella')?></span>
                                </div>                               
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" name="username" type="text" placeholder="User name or email"></div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Your password"></div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="checkbox">
                                        <label><input type="checkbox"><?php _e(' Remember me','bella')?></label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6 text-right-lg">
                                    <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot-password"><?php _e('forgot password?','bella'); ?></a>                                    
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" value="<?php _e('Login','bella'); ?>" class="btn btn-theme btn-block btn-theme-dark">                                    
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="block-title"><span><?php _e('Create New Account','bella'); ?></span></h3>
                        <form action="#" class="create-account">
                            <div class="row">
                                <div class="col-md-12 hello-text-wrap">
                                    <span class="hello-text text-thin"><?php _e('Create Your Account on Bellashop','bella'); ?></span>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="block-title"><?php echo esc_attr($bella_options['signup_title']); ?></h3>
                                    <ul class="list-check">
                                        <?php echo wp_kses_post($bella_options['signup_text']);?>
                                        
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-block btn-theme btn-theme-dark btn-create" href="<?php echo wp_registration_url(); ?>"><?php _e('Create Account','bella'); ?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

<?php get_footer(); ?>